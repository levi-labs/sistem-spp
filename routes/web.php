<?php

use App\Http\Controllers\BendaharaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\BiayaLainController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Models\Siswa;

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

Route::get('/', function () {
    return view('pages.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/daftar-belum-dibayar', [PembayaranController::class, 'index']);
    Route::get('/daftar-sudah-dibayar', [PembayaranController::class, 'index2']);
    Route::get('/detail-belum-dibayar/{siswa_id}', [PembayaranController::class, 'detailPembayaran']);
    Route::get('/detail-sudah-dibayar/{siswa_id}/{invoice}', [PembayaranController::class, 'sudahDibayar']);
    Route::get('/daftar-pembayaran-print', [PembayaranController::class, 'index']);

    Route::get('/tambah-pembayaran/{id}', [PembayaranController::class, 'tambahPembayaran']);
    Route::get('/cek-pembayaran', [PembayaranController::class, 'cartPembayaran']);
    Route::get('/print-cart/{invoice}', [PembayaranController::class, 'printCart']);
    Route::get('/print-index-unpaid', [PembayaranController::class, 'printUnpaid']);
    Route::get('/print-index-paid', [PembayaranController::class, 'printPaid']);

    Route::get('/delete-checkout/{id}', [PembayaranController::class, 'deleteCheckout']);

    Route::get('/cek-invoice', [PembayaranController::class, 'cekInvoice']);
    Route::post('/post-invoice', [PembayaranController::class, 'cekInvoice']);
    Route::get('/print-invoice/{invoice}', [PembayaranController::class, 'pageInvoice']);

    Route::get('/daftar-kelas', [KelasController::class, 'index']);
    Route::get('/tambah-kelas', [KelasController::class, 'create']);
    Route::post('/post-kelas', [KelasController::class, 'store']);
    Route::get('/edit-kelas/{id}', [KelasController::class, 'edit']);
    Route::post('/update-kelas/{id}', [KelasController::class, 'update']);
    Route::get('/delete-kelas/{id}', [KelasController::class, 'destroy']);
    // Route::get('/tambah-ke-siswa/{id}', [KelasController::class, 'addBiayakeSiswa']);

    Route::get('/daftar-biaya-lain', [BiayaLainController::class, 'index']);
    Route::get('/tambah-biaya-lain', [BiayaLainController::class, 'create']);
    Route::post('/post-biaya-lain', [BiayaLainController::class, 'store']);
    Route::get('/edit-biaya-lain/{id}', [BiayaLainController::class, 'edit']);
    Route::post('/update-biaya-lain/{id}', [BiayaLainController::class, 'update']);
    Route::get('/delete-biaya-lain/{id}', [BiayaLainController::class, 'destroy']);
    Route::get('/tambah-ke-siswa/{id}', [BiayaLainController::class, 'addBiayakeSiswa']);
    Route::post('/store-biaya-siswa/{id}', [BiayaLainController::class, 'storeBiayakeSIswa']);

    //siswa
    Route::get('/daftar-siswa', [SiswaController::class, 'index']);
    Route::get('/tambah-siswa', [SiswaController::class, 'create']);
    Route::post('/post-siswa', [SiswaController::class, 'store']);
    Route::get('/edit-siswa/{id}', [SiswaController::class, 'edit']);
    Route::post('/update-siswa/{id}', [SiswaController::class, 'update']);
    Route::get('/detail-siswa/{id}', [SiswaController::class, 'show']);
    Route::get('delete-siswa/{id}', [SiswaController::class, 'destroy']);
    Route::get('/print-siswa', [SiswaController::class, 'printSiswa']);
    Route::get('daftar-pembayaran-siswa', [SiswaController::class, 'daftarBayar']);

    //Bendahara
    Route::get('/daftar-bendahara', [BendaharaController::class, 'index']);
    Route::get('/tambah-bendahara', [BendaharaController::class, 'create']);
    Route::post('/post-bendahara', [BendaharaController::class, 'store']);
    Route::get('/edit-bendahara/{id}', [BendaharaController::class, 'edit']);
    Route::post('/update-bendahara{id}', [BendaharaController::class, 'update']);
    Route::get('/delete-bendahara/{id}', [BendaharaController::class, 'destroy']);

    //user
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/tambah-user', [UserController::class, 'create']);
    Route::post('/post-user', [UserController::class, 'store']);
    Route::get('/edit-user/{id}', [UserController::class, 'edit']);
    Route::post('/update-user{id}', [UserController::class, 'update']);
    Route::get('/detail-user/{id}', [UserController::class, 'show']);
    Route::get('hapus-user/{id}', [UserController::class, 'destroy']);

    //profile 

    Route::get('/profile/{id}', [ProfileController::class, 'index']);
    Route::get('/edit-profile/{id}', [ProfileController::class, 'edit']);
    Route::post('/update-profile-siswa/{id}', [ProfileController::class, 'updateProfileSiswa']);
    Route::post('/update-profile-bendahara/{id}', [ProfileController::class, 'updateProfileBendahara']);
    Route::get('/change-password', [ProfileController::class, 'editPassword']);
    Route::post('/update-password/{id}', [ProfileController::class, 'updatePassword']);

    //users

    Route::get('/daftar-users', [UserController::class, 'index']);
    Route::get('/reset-password-user/{id}', [UserController::class, 'resetPassword']);

    //report

    Route::get('/report', [ReportController::class, 'index']);
    Route::post('/report-print', [ReportController::class, 'index']);
});
Route::post('/callback-pembayaran', [PembayaranController::class, 'callbackCheckout']);
Route::get('/logout', function () {
    Auth::logout();

    return redirect('/');
});






Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
