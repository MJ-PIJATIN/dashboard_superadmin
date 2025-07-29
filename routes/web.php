<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuspendedAccountController;
use App\Http\Controllers\AduanController;


// Routing Sidebar Super Admin
Route::get('/', function () {
    return view('pages.SuperAdminDashboard');
})->name('dashboard');

// Page Layanan
Route::get('/layanan', function () {
    return view('pages.SuperAdminLayanan');
})->name('layanan');

// Page Pesanan
Route::get('/pesanan', function () {
    return view('pages.SuperAdminPesanan');
})->name('pesanan');

// Page Cabang
// Halaman Tambah Cabang
Route::get('/cabang', function () {
    return view('pages.SuperAdminCabang');
})->name('cabang');

Route::get('/cabang/tambah', function () {
    return view('pages.SuperAdminTambahCabang');
})->name('cabang.tambah');

// Halaman Detail Cabang
Route::get('/cabang/{id}', function ($id) {
    return view('pages.SuperAdminDetailCabang', ['id' => $id]);
})->where('id', '[0-9]+')->name('cabang.detail');

// Halaman Edit Cabang
Route::get('/cabang/{id}/edit', function ($id) {
    return view('pages.SuperAdminEditCabang', ['id' => $id]);
})->where('id', '[0-9]+')->name('cabang.edit');

//Halaman Karyawan
Route::get('/karyawan', function () {
    return view('pages.SuperAdminKaryawan');
})->name('karyawan');


//Halaman Pelanggan
Route::get('/pelanggan', function () {
    return view('pages.SuperAdminPelanggan');
})->name('pelanggan');


// Halaman Terapis
Route::get('/terapis', function () {
    return view('pages.SuperAdminTerapis');
})->name('terapis');

//Halaman Penangguhan
Route::get('/penangguhan', [SuspendedAccountController::class, 'index'])->name('penangguhan');
Route::prefix('admin')->group(function () {
    
    // Routes untuk akun ditangguhkan
    Route::prefix('akun-ditangguhkan')->name('suspended-account.')->group(function () {

        // Halaman detail akun ditangguhkan
        Route::get('/{id}/detail', [SuspendedAccountController::class, 'detail'])
            ->name('detail')
            ->where('id', '[0-9]+'); // Hanya menerima ID berupa angka
        
        // API untuk memulihkan akun (AJAX)
        Route::post('/{id}/restore', [SuspendedAccountController::class, 'restore'])
            ->name('restore')
            ->where('id', '[0-9]+');
        
        // API untuk pencarian akun
        Route::get('/search', [SuspendedAccountController::class, 'search'])
            ->name('search');
    });
});

Route::get('/aduan-pelanggan', [App\Http\Controllers\AduanController::class, 'index'])->name('aduan-pelanggan');
Route::get('/detail-aduan/{id}', [App\Http\Controllers\AduanController::class, 'show'])->name('detiladuan');
Route::post('/suspended-accounts/{id}/restore', [SuspendedAccountController::class, 'restore'])->name('suspended-account.restore');
Route::get('/aduan/search', [App\Http\Controllers\AduanController::class, 'search'])->name('aduan.search');

Route::get('/faq', function () {
    return view('pages.SuperAdminFAQ');
})->name('faq');
