<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class DataAkunController extends Controller
{
    public function index()
    {
        // $users = DB::table('users')->select('name', 'email', 'created_at')->get();
        // $users = User::all();
        $count = User::count();

        return view('masterAkun/index', compact('count'));
    }

    public function tableAkun()
    {
        $users = User::all();
        return DataTables::of($users)->make(true);
    }

    public function createAkun(Request $request)
    {
        // $created_at = date('Y-m-d H:i:s');

        // dd($request->all());
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => $request->password,
            'password' => Hash::make($request->password),
            'tipe_akun' => $request->tipe_akun,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/akun')->with('success', 'Akun berhasil ditambahkan!');
    }

    public function getIdAkun($id)
    {
        // dd($id);
        $users = User::where('id', $id)->first();
        // dd($users);
        // $flight = Flight::where('number', 'FR 900')->first();

        return json_encode($users);
    }

    public function updateAkun(Request $request)
    {
        // $created_at = date('Y-m-d H:i:s');
        $id =  $request->id;
        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => $request->password,
            // 'password' => Hash::make($request->password),
            'tipe_akun' => $request->tipe_akun,
            // 'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/akun')->with('success', 'Akun berhasil ditambahkan!');
    }

    public function deleteAkun(Request $request)
    {
        $id =  $request->id;
        $data = DB::table('users')->where('id', $id)->delete();
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
