<?php

use Illuminate\Support\Facades\Route;

// Routing Sidebar Super Admin
Route::get('/', function () {
    return view('pages.SuperAdminDashboard');
})->name('dashboard');

Route::get('/layanan', function () {
    return view('pages.SuperAdminLayanan');
})->name('layanan');

Route::get('/pesanan', function () {
    return view('pages.SuperAdminPesanan');
})->name('pesanan');

Route::get('/cabang', function () {
    return view('pages.SuperAdminCabang');
})->name('cabang');

Route::get('/karyawan', function () {
    return view('pages.SuperAdminKaryawan');
})->name('karyawan');

Route::get('/pelanggan', function () {
    return view('pages.SuperAdminPelanggan');
})->name('pelanggan');

Route::get('/terapis', function () {
    return view('pages.SuperAdminTerapis');
})->name('terapis');

Route::get('/penangguhan', function () {
    return view('pages.SuperAdminPenangguhan');
})->name('penangguhan');

Route::get('/aduan-pelanggan', function () {
    return view('pages.SuperAdminAduanPelanggan');
})->name('aduan-pelanggan');

Route::get('/faq', function () {
    return view('pages.SuperAdminFAQ');
})->name('faq');

// Page Cabang
// Halaman Tambah Cabang
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