<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KasirController extends Controller
{
    //
    public function index()
    {
        $produk = DB::select('SELECT * FROM tb_produk');
        return view('kasir.index', compact('produk'));
    }

    public function processOrder(Request $request)
    {
        $selectedProducts = $request->input('selected_products');
        $totalHarga = $request->input('total_harga');

        $tanggal = Carbon::now('Asia/Jakarta')->format('Ymd');

        // Dapatkan nomor transaksi terakhir
        $nomorTransaksiTerakhir = DB::table('tb_penjualan')
            ->whereDate('tanggal_transaksi', today())
            ->max('no_transaksi');

        // Jika tidak ada nomor transaksi terakhir, atur menjadi 1, jika ada, tambahkan 1
        $nomorUrut = $nomorTransaksiTerakhir ? (int)substr($nomorTransaksiTerakhir, -5) + 1 : 1;

        // Format nomor transaksi dengan menggunakan tanggal dan 5 digit belakang
        $nomorTransaksi = $tanggal . sprintf('%05d', $nomorUrut);

        // Simpan pesanan ke database
        $orderId = DB::table('tb_penjualan')->insert([
            'no_transaksi' => $nomorTransaksi,
            'total_transaksi' => $totalHarga,
            'tanggal_transaksi' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ]);

        // Simpan detail pesanan ke database
        foreach ($selectedProducts as $product) {
            
            $productData = DB::table('tb_produk')->where('id_produk', $product['id'])->first();
            $harga = $productData->harga * $product['quantity'];
            if($productData){
                DB::table('tb_penjualan_detail')->insert([
                    'no_transaksi' => $nomorTransaksi,
                    'kode_produk' => $productData->kode_produk,
                    'total_harga' => $harga,
                    'quantity' => $product['quantity'],
                ]);
            }
            
        }

        return response()->json(['message' => 'Pesanan diproses dengan sukses']);
    }
}
