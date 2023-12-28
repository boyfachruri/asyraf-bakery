<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $success = 'Success';
        $jumlahTransaksi = DB::table('tb_penjualan')
        ->whereDate('tanggal_transaksi', today()) 
        ->count('total_transaksi');

        $jumlahPendapatan = DB::table('tb_penjualan')
        ->where('status', $success) 
        ->whereDate('tanggal_transaksi', today()) 
        ->sum('total_transaksi');

        $orderCancel = DB::table('tb_penjualan')
        ->whereDate('tanggal_transaksi', today())
        ->where('status', 'cancelled')
        ->count('total_transaksi');

        $orderSukses = DB::table('tb_penjualan')
        ->whereDate('tanggal_transaksi', today())
        ->where('status', 'Success')
        ->count('total_transaksi');

        $produkTerlaris = DB::table('tb_penjualan')
        ->join('tb_penjualan_detail', 'tb_penjualan.no_transaksi', '=', 'tb_penjualan_detail.no_transaksi')
        ->join('tb_produk', 'tb_penjualan_detail.kode_produk', '=', 'tb_produk.kode_produk')
        ->where('tb_penjualan.status', $success) 
        ->where('tb_penjualan.tanggal_transaksi', '>=', DB::raw('CURDATE() - INTERVAL 30 DAY'))
        ->groupBy('tb_produk.nama_produk')
        ->groupBy('tb_produk.harga')
        ->select(
            'tb_produk.nama_produk',
            DB::raw('SUM(tb_penjualan_detail.total_harga) AS total_harga'),
            DB::raw('SUM(tb_penjualan_detail.quantity) AS total_quantity'),
            'tb_produk.harga'
        )
        ->orderBy('total_quantity', 'desc')
        ->take(5)
        ->get();

        return view('dash', compact('jumlahTransaksi', 'jumlahPendapatan', 'orderCancel', 'orderSukses', 'produkTerlaris'));
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
