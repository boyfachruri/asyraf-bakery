<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PenjualanExport;
use App\Imports\PenjualanImport;

use Illuminate\Support\Facades\Hash;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function tablePenjualan()
    {
        # code...
        // $penjualan = DB::select('SELECT * FROM tb_penjualan inner join tb_penjualan_detail on tb_penjualan.no_transaksi = tb_penjualan_detail.no_transaksi');
        $penjualan = DB::select('SELECT * FROM tb_penjualan order by tanggal_transaksi DESC');
        return DataTables::of($penjualan)->make(true);
    }

    public function tableDetailPenjualan($id)
    {
        # code...ph
        // $penjualan = DB::select('SELECT * FROM tb_penjualan inner join tb_penjualan_detail on tb_penjualan.no_transaksi = tb_penjualan_detail.no_transaksi');
        $penjualan = DB::select("SELECT * FROM tb_penjualan_detail inner join tb_produk on tb_penjualan_detail.kode_produk = tb_produk.kode_produk where no_transaksi = '$id'");
        // $penjualan = DB::select("SELECT * FROM tb_penjualan_detail where no_transaksi = '$id'");
        echo json_encode($penjualan, JSON_PRETTY_PRINT);
    }

    public function cancelPenjualan(Request $request)
    {
        // $created_at = date('Y-m-d H:i:s');
        $id =  $request->id;
        // dd($request->all());
        $cancel = "Cancelled";
        $data = DB::table('tb_penjualan')->where('id_penjualan', $id)->update([
            'status' => $cancel
            // 'tgl_buat' => date('Y-m-d H:i:s'),
        ]);

        if (!$data) {
            $msg = "Transaksi Gagal Dibatalkan: " . $data;
            $st  = 'Fail';
        } else {
            $msg = "Transaksi Berhasil Dibatalkan";
            $st  = 'OK';
        }
        $msg1 = array(
            "Pesan" => $msg,
            "St" => $st
        );
        echo json_encode($msg1);

        // return redirect('/penjualan')->with('success', 'Transaksi berhasil dibatalkan');
    }

}
