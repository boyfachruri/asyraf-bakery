<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class JenisController extends Controller
{
    public function index()
    {
        // Kode untuk menampilkan halaman index
        // $jenis = DB::table('tb_jenis')->select('name', 'email', 'created_at')->get();
        $count = DB::select('SELECT COUNT(id_jenis)* FROM tb_jenis');
        // $count = $jenis::count();
        return view('masterJenis/index', compact('count'));
    }

    public function tableJenis()
    {
        // Kode untuk menampilkan halaman index
        // $jenis = DB::table('tb_jenis')->select('name', 'email', 'created_at')->get();
        $jenis = DB::select('SELECT * FROM tb_jenis');
        return DataTables::of($jenis)->make(true);
    }

    // public function create()
    // {
    //     // Kode untuk menampilkan halaman create
    // }

    public function createJenis(Request $request)
    {
        // Kode untuk menyimpan data jenis baru
        DB::table('tb_jenis')->insert([
            'nama_jenis' => $request->nama_jenis,
            'kode_jenis' => strtoupper($request->kode_jenis),
            'tgl_buat' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/jenis')->with('success', 'Jenis berhasil ditambahkan!');
    }

    public function show($id)
    {
        // Kode untuk menampilkan halaman detail jenis
    }

    public function getIdJenis($id)
    {
        // dd($id);
        $jenis = DB::table('tb_jenis')->where('id_jenis', $id)->first();
        // $users = User::where('id', $id)->first();
        // $flight = Flight::where('number', 'FR 900')->first();

        return json_encode($jenis);
    }

    public function updateJenis(Request $request)
    {
        // $created_at = date('Y-m-d H:i:s');
        $id =  $request->id;
        DB::table('tb_jenis')->where('id_jenis', $id)->update([
            'nama_jenis' => $request->nama_jenis,
            'kode_jenis' => strtoupper($request->kode_jenis),
            // 'tgl_buat' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/jenis')->with('success', 'Jenis berhasil ditambahkan!');
    }

    public function deleteJenis(Request $request)
    {
        $id =  $request->id;
        $data = DB::table('tb_jenis')->where('id_jenis', $id)->delete();
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
