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
        $penjualan = DB::select('SELECT * FROM tb_penjualan');
        return DataTables::of($penjualan)->make(true);
    }

    public function tableDetailPenjualan($id)
    {
        # code...
        // $penjualan = DB::select('SELECT * FROM tb_penjualan inner join tb_penjualan_detail on tb_penjualan.no_transaksi = tb_penjualan_detail.no_transaksi');
        $penjualan = DB::select("SELECT * FROM tb_penjualan_detail inner join tb_produk on tb_penjualan_detail.kode_produk = tb_produk.kode_produk where no_transaksi = '$id'");
        // $penjualan = DB::select("SELECT * FROM tb_penjualan_detail where no_transaksi = '$id'");
        echo json_encode($penjualan, JSON_PRETTY_PRINT);
    }

    public function exportPenjualan()
    {
        return Excel::download(new PenjualanExport(), 'penjualan.xlsx');
    }

    public function importPenjualan(Request $request)
    {
        # code...
        $file = $request->file('file');

        Excel::import(new PenjualanImport(), $file);

        return redirect()->back()->with('success', 'Data imported successfully.');
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
