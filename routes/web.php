<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataAkunController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\KasirController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('dash');
// })->name('dash');

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth.check'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dash');
    // Route::view('akun', 'masterAkun/index')->name('akun');

    // Master Akun
    Route::get('/akun', [DataAkunController::class, 'index']);
    Route::get('/getTableAkun', [DataAkunController::class, 'tableAkun']);
    Route::view('/viewakun', 'masterAkun/viewakun');
    Route::view('/viewakunupdate', 'masterAkun/viewakunupdate');
    Route::get('/getIdAkun/{id}', [DataAkunController::class, 'getIdAkun']);
    Route::post('/tambahakun', [DataAkunController::class, 'createAkun']);
    Route::post('/updateakun', [DataAkunController::class, 'updateAkun']);
    Route::post('/deleteAkun', [DataAkunController::class, 'deleteAkun']);

    // Master Jenis
    Route::view('jenis', 'masterJenis/index');
    Route::get('/getTableJenis', [JenisController::class, 'tableJenis']);
    Route::view('/viewjenis', 'masterJenis/viewjenis');
    Route::post('/tambahjenis', [JenisController::class, 'createJenis']);
    Route::view('/viewjenisupdate', 'masterJenis/viewjenisupdate');
    Route::get('/getIdJenis/{id}', [JenisController::class, 'getIdJenis']);
    Route::post('/updatejenis', [JenisController::class, 'updateJenis']);
    Route::post('/deleteJenis', [JenisController::class, 'deleteJenis']);

    //Master Produk
    Route::view('produk', 'masterProduk/index');
    Route::get('/getTableProduk', [ProdukController::class, 'tableProduk']);
    Route::get('/viewproduk', [ProdukController::class, 'viewProduk']);
    Route::post('/tambahproduk', [ProdukController::class, 'createProduk']);
    Route::get('/viewprodukupdate', [ProdukController::class, 'viewProdukUpdate']);
    Route::get('/getIdProduk/{id}', [ProdukController::class, 'getIdProduk']);
    Route::post('/updateproduk', [ProdukController::class, 'updateProduk']);
    Route::post('/deleteProduk', [ProdukController::class, 'deleteProduk']);

    //Penjualan
    Route::view('penjualan', 'transaksiPenjualan/index');
    Route::get('/getTablePenjualan', [PenjualanController::class, 'tablePenjualan']);
    Route::get('/getTablePenjualanDetail/{id}', [PenjualanController::class, 'tableDetailPenjualan']);
    Route::get('/viewpenjualan', [PenjualanController::class, 'listProduk']);
    Route::post('/cancelPenjualan', [PenjualanController::class, 'cancelPenjualan']);

    //Transaksi Penjualan
    Route::get('/transaksi-penjualan', [KasirController::class, 'index']);
    Route::post('/process-order', [KasirController::class, 'processOrder'])->name('process.order');

});




// Rute untuk mengunggah file Excel dan mengimpor datanya
// Route::post('/import-excel', [PenjualanController::class, 'importPenjualan']);

// // Rute untuk mengekspor data ke file Excel
// Route::get('/export-excel', [PenjualanController::class, 'exportPenjualan']);

// Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
