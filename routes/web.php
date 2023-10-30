<?php

use Inertia\Inertia;
use App\Models\barang;
use App\Models\lokasi_penyimpanan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\singleBarang;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\emailController;
use App\Http\Controllers\barangController;
use App\Http\Controllers\peminjamController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\laboratoriumController;
use App\Http\Controllers\DashboardBarangController;
use App\Http\Controllers\dashboardPeminjamController;
use App\Http\Controllers\lokasi_penyimpananController;

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
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

route::post('/dashboard/daftar-barang/konfirmasi-rusak', [DashboardBarangController::class, 'konfirmasiRusak'])->middleware(['auth', 'verified']);

Route::get('/kirim-email', [emailController::class, 'index']);

Route::post('/dashboard/check-konfirmasi/hasil', [dashboardPeminjamController::class, 'checkNim'])->middleware(['auth', 'verified'])->name('checkNim');

route::resource('/dashboard/barang', singleBarang::class)->middleware(['auth', 'verified']);

route::post('/dashboard/barang-rusak/add-barang-rusak/add', [DashboardBarangController::class, 'mutiCheckIn'])->middleware(['auth', 'verified'])->name('mutiCheckInRusak');

route::get('/dashboard/barang-rusak/add-barang-rusak', [DashboardBarangController::class, 'addRusak'])->middleware(['auth', 'verified'])->name('addBarangRusak');

route::post('/dashboard/daftar-barang/muti-check-out', [DashboardBarangController::class, 'mutiCheckOut'])->middleware(['auth', 'verified']);

Route::get('/dashboard/daftar-barang/check-out', [DashboardBarangController::class, 'checkOut'])->middleware(['auth', 'verified']);

Route::get('/dashboard/daftar-barang/check-in', [DashboardBarangController::class, 'checkInRusak'])->middleware(['auth', 'verified']);

Route::get('/dashboard/daftar-barang/CreatekodeBarang', [DashboardBarangController::class, 'CreatekodeBarang'])->middleware(['auth', 'verified']);


route::delete('/dashboard/daftar-client/delete-tanggungan', [dashboardPeminjamController::class, 'deleteTanggunan'])->middleware(['auth', 'verified'])->name('deleteTanggunan');

route::delete('/dashboard/daftar-client/delete', [dashboardPeminjamController::class, 'delete'])->middleware(['auth', 'verified'])->name('deletePermohonan');

route::get('/peminjam/file', [peminjamController::class, 'pdfStream']);

route::get('/dashboard/daftar-client/file', [dashboardPeminjamController::class, 'pdfStream'])->middleware(['auth', 'verified'])->name('filePermohonan');

Route::get('/dashboard/daftar-permohonan', [dashboardPeminjamController::class, 'permohonan'])->middleware(['auth', 'verified'])->name('permohonan');

Route::post('/dashboard/daftar-client/tolak', [dashboardPeminjamController::class, 'tolak'])->middleware(['auth', 'verified'])->name('tolak');

Route::post('/dashboard/daftar-client/konfirmasi', [dashboardPeminjamController::class, 'konfirmasi'])->middleware(['auth', 'verified'])->name('konfirmasi');

Route::resource('/dashboard/daftar-client', dashboardPeminjamController::class)->middleware(['auth', 'verified']);



Route::post('/peminjam/daftar-client/check-in-konfirmasi', [dashboardPeminjamController::class, 'checkInKonfirmasi'])->middleware(['auth', 'verified']);

Route::get('/peminjam/daftar-client/check-in', [dashboardPeminjamController::class, 'checkIn'])->middleware(['auth', 'verified'])->name('checkIn');

Route::get('/peminjam/daftar-client/check-out', [dashboardPeminjamController::class, 'checkOut'])->middleware(['auth', 'verified'])->name('checkOut');

Route::get('/dashboard/scan', [dashboardPeminjamController::class, 'scan'])->middleware(['auth', 'verified'])->name('scan');

Route::get('/cek-peminjaman', [peminjamController::class, 'cek'])->name('cek-peminjaman');

require __DIR__ . '/auth.php';

Route::get('/pinjam-barang', [barangController::class, 'pinjam'])->name('pinjam-barang');

route::post('/dashboard/daftar-barang/print', [DashboardBarangController::class, 'printMulti'])->middleware(['auth', 'verified'])->name('printMulti');

route::post('/dashboard/daftar-barang/print-barang', [singleBarang::class, 'cetak_pdf'])->middleware(['auth', 'verified'])->name('print');

route::delete('/dashboard/daftar-barang/delete-all', [DashboardBarangController::class, 'deleteAll'])->middleware(['auth', 'verified'])->name('daftar-barang.deleteAll');

route::post('/dashboard/daftar-barang/migrate-all', [DashboardBarangController::class, 'migrateMultiLabor'])->middleware(['auth', 'verified'])->name('daftar-barang.migrateMultiLabor');

route::post('/dashboard/daftar-barang/migrateRuang-all', [DashboardBarangController::class, 'migrateMultiLokasi'])->middleware(['auth', 'verified'])->name('daftar-barang.migrateMultiLokasi');

Route::get('/dashboard/daftar-barang/duplikat', [DashboardBarangController::class, 'duplikat'])->middleware(['auth', 'verified']);

Route::get('/dashboard/daftar-barang/kodeBarang', [DashboardBarangController::class, 'kodeBarang'])->middleware(['auth', 'verified']);


Route::get('/dashboard/daftar-barang/kodeLabor', [DashboardBarangController::class, 'kodeLabor'])->middleware(['auth', 'verified']);

Route::get('/dashboard/daftar-barang/checkSlug', [DashboardBarangController::class, 'checkSlug'])->middleware(['auth', 'verified']);

Route::get('/peminjam/checkSlug', [peminjamController::class, 'checkSlug']);

Route::resource('/dashboard/daftar-barang', DashboardBarangController::class)->middleware(['auth', 'verified']);

Route::resource('/dashboard/daftar-user', UserController::class)->middleware(['auth', 'verified']);

route::resource('/peminjam', peminjamController::class);

Route::get('/dashboard', [dashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/check-konfirmasi', [dashboardController::class, 'checkView'])->middleware(['auth', 'verified'])->name('checkView');



Route::get('/', [barangController::class, 'index']);

Route::get('/pinjambarang', [barangController::class, 'pinjamBarang'])->name('pinjamBarang');

Route::get('/{barang:kode_barang}', [barangController::class, 'show']);


Route::get('/dashboard/barang-rusak', [dashboardController::class, 'barangRusak'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/daftar-dipinjam', [dashboardController::class, 'barangDipinjam'])->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/dashboard/daftar-laboratorium/migrate', [DashboardBarangController::class, 'migrateLabor'])->middleware(['auth', 'verified'])->name('daftar-laboratorium.migrateLabor');

Route::post('/dashboard/daftar-laboratorium/migrate-lokasi', [DashboardBarangController::class, 'migrateLokasi'])->middleware(['auth', 'verified'])->name('daftar-laboratorium.migrateLokasi');

Route::resource('/dashboard/daftar-laboratorium', laboratoriumController::class)->middleware(['auth', 'verified']);

route::resource('/dashboard/lokasi-penyimpanan', lokasi_penyimpananController::class)->middleware(['auth', 'verified']);
