<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProdukController extends Controller
{
    public function index()
    {
        // Kode untuk menampilkan halaman index
        // $jenis = DB::table('tb_produk')->select('name', 'email', 'created_at')->get();
        $count = DB::select('SELECT COUNT(id_produk)* FROM tb_produk');
        // $count = $jenis::count();
        return view('masterProduk/index', compact('count'));
    }

    public function tableProduk()
    {
        // Kode untuk menampilkan halaman index
        // $jenis = DB::table('tb_produk')->select('name', 'email', 'created_at')->get();
        $produk = DB::select('SELECT * FROM tb_produk inner join tb_jenis on tb_produk.kode_jenis = tb_jenis.kode_jenis');
        return DataTables::of($produk)->make(true);
    }

    public function viewProduk()
    {
        // Kode untuk menampilkan halaman index
        // $jenis = DB::table('tb_produk')->select('name', 'email', 'created_at')->get();

        // $count = DB::select('SELECT COUNT(id_produk)* FROM tb_produk');
        $dropdown = DB::table('tb_jenis')->select('kode_jenis', 'nama_jenis')->get();
        // $count = $jenis::count();
        return view('masterProduk/viewproduk', compact('dropdown'));
    }
    

    // public function create()
    // {
    //     // Kode untuk menampilkan halaman create
    // }

    public function createProduk(Request $request)
    {

        // dd($request->all());
        // Kode untuk menyimpan data jenis baru
        DB::table('tb_produk')->insert([
            'nama_produk' => $request->nama_produk,
            'kode_produk' => strtoupper($request->kode_produk),
            'kode_jenis' => strtoupper($request->kode_jenis),
            'harga' => $request->harga,
            'tgl_buat' => date('Y-m-d H:i:s'),
        ]);
        

        return redirect('/produk')->with('success', 'produk berhasil ditambahkan!');
    }

    public function show($id)
    {
        // Kode untuk menampilkan halaman detail jenis
    }

    public function viewProdukUpdate()
    {
        $dropdown = DB::table('tb_jenis')->select('kode_jenis', 'nama_jenis')->get();
        return view('masterProduk/viewprodukupdate', compact('dropdown'));
    }

    public function getIdProduk($id)
    {
        // $dropdown = DB::table('tb_jenis')->select('kode_jenis', 'nama_jenis')->get();
        $produk = DB::select("SELECT * FROM tb_produk inner join tb_jenis on tb_produk.kode_jenis = tb_jenis.kode_jenis where id_produk ='$id'");
        // $produk = DB::table('tb_produk')->where('id_produk', $id)->first();
        // $users = User::where('id', $id)->first();
        // $flight = Flight::where('number', 'FR 900')->first();

        return json_encode($produk);
    }

    public function updateProduk(Request $request)
    {
        // $created_at = date('Y-m-d H:i:s');
        $id =  $request->id;
        DB::table('tb_produk')->where('id_produk', $id)->update([
            'nama_produk' => $request->nama_produk,
            'kode_produk' => strtoupper($request->kode_produk),
            'kode_jenis' => strtoupper($request->kode_jenis),
            'harga' => $request->harga,
            // 'tgl_buat' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/produk')->with('success', 'Jenis berhasil ditambahkan!');
    }

    public function deleteProduk(Request $request)
    {
        $id =  $request->id;
        $data = DB::table('tb_produk')->where('id_produk', $id)->delete();
        if (!$data) {
            $msg = "Delete failed: " . $data;
            $st  = 'Fail';
        } else {
            $msg = "Data has been deleted successfully";
            $st  = 'OK';
        }
        $msg1 = array(
            "Pesan" => $msg,
            "St" => $st
        );
        echo json_encode($msg1);
    }
    
}
