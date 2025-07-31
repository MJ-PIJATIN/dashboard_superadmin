@extends('layouts.app')

@section('title', 'Detail Akun Admin')
@section('page-title', 'Detail Akun Administrasi')

@section('navtitle')    
    <div class="text-medium text-gray-600 mb-4">
        <a href="#" class="text-gray-800 hover:underline">Karyawan</a>
        <span class="mx-2">></span>
        <a href="#" class="text-emerald-600 hover:underline">Detail Akun Admin</a>
    </div> 
@endsection


@section('content')
<div class="px-6 py-20">
    <!-- Back -->
    <div class="text-s text-gray-400 mb-4">
        <a href="{{ route('karyawan') }}" title="Kembali ke Data Karyawan" class="hover:text-gray-800">
            <span class="text-2x2 font-semibold mr-4">&larr;</span>
            <span class="text-s font-semibold text-gray-600">Detail Akun Administrasi</span>
        </a>
    </div>


    <!-- Kontainer 2 Kartu Horizontal -->
    <div class="flex flex-wrap justify-between">
        <!-- Kartu Kiri: Informasi Akun -->
        <div class="bg-white rounded-[10px] shadow p-8 w-[530px]">
            <div class="flex flex-col items-center text-center mb-10 h-60">
                <img src="https://i.pinimg.com/736x/d7/a7/41/d7a7415761424c539418cb2ff2725842.jpg" alt="Foto Profil"
                    class="w-40 h-40 rounded-full object-cover shadow mb-2">
                <h2 class="text-sm font-semibold text-gray-800">Nabila Usamah</h2>
                <p class="text-xs text-gray-500">Admin</p>
            </div>

            <h3 class="text-normal font-bold text-gray-800 mb-5 text-left w-full">Informasi Akun</h3>
            <div class="space-y-2 text-xs text-gray-700">
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Nomor ID</span>
                    <span class="font-semibold text-gray-800">ADM129</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Peran Akun</span>
                    <span class="font-semibold text-gray-800">Administrasi</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Alamat Email</span>
                    <span class="font-semibold text-gray-800">nabilausamah@gmail.com</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Ponsel</span>
                    <span class="font-semibold text-gray-800">087989373368</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Area Penempatan</span>
                    <span class="font-semibold text-gray-800">Lembang, Bandung</span>
                </div>
            </div>

            <div class="mt-4 text-end">
                <button class="text-red-600 border border-red-500 hover:bg-red-50 font-semibold px-3 py-1.5 rounded text-xs">
                    Hapus Akun
                </button>
            </div>
        </div>

        <!-- Kartu Kanan: Identitas Diri -->
        <div class="bg-white rounded-[10px] shadow p-4 w-[530px] h-60">
            <h3 class="text-normal font-bold text-gray-800 mb-10">Identitas Diri</h3>
            <div class="space-y-2 text-xs text-gray-700">
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Nama Lengkap</span>
                    <span class="font-semibold text-gray-800">Nabila Usamah</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Tempat Lahir</span>
                    <span class="font-semibold text-gray-800">Jakarta Barat</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Tanggal Lahir</span>
                    <span class="font-semibold text-gray-800">12 Februari 2000</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Jenis Kelamin</span>
                    <span class="font-semibold text-gray-800">Perempuan</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Alamat</span>
                    <span class="font-semibold text-gray-800">Kapuk, Cengkareng, Jakarta Barat</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
