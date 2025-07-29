@extends('layouts.app')

@section('title', 'Detail Aduan Pengguna')
@section('page-title', 'Detail Aduan Pengguna')
@section('page-description', 'Informasi lengkap aduan dari pengguna')
@section('navtitle')
    <div class="text-base text-gray-700 flex items-center gap-2">
        <span>Aduan</span>
        <span class="text-gray-700 font-semibold">&gt;</span>
        <span class="text-green-600 font-semibold">Detail Aduan</span>
    </div>
@endsection

@section('navsubtitle', 'Detail Aduan Pengguna')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="max-w-screen-xl" style="margin-left: 50px; padding-top: 100px; padding-bottom: 100px; padding-right: 22px;">
        
        <!-- Header dengan tombol kembali -->
        <div class="flex items-center mb-6">
            <a href="{{ route('aduan-pelanggan') }}" title="Kembali ke daftar aduan" class="flex items-center text-gray-600 hover:text-gray-700 transition-colors mr-4">
                <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                    <path d="M9.47915 16.9798C9.0833 16.98 8.70301 16.8257 8.41915 16.5498L1.41915 9.54983C0.834242 8.96419 0.834242 8.01546 1.41915 7.42983L8.41915 0.429828C8.79964 0.0511261 9.35326 -0.0958207 9.87147 0.0443407C10.3897 0.184502 10.7937 0.590478 10.9315 1.10934C11.0692 1.6282 10.9196 2.18113 10.5391 2.55983L6.1067 6.99976H17.519C18.3475 6.99976 19.019 7.67133 19.019 8.49976C19.019 9.32818 18.3475 9.99976 17.519 9.99976H6.11161L10.5391 14.4198C10.9676 14.8488 11.0957 15.4935 10.8637 16.0537C10.6318 16.6138 10.0854 16.9793 9.47915 16.9798Z" fill="#454545" />
                </svg>
            </a>
            <h1 class="text-xl font-bold text-gray-700">Detail Aduan Pengguna</h1>
        </div>

        <!-- Header Profile -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex justify-center items-center">
                    <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-200 mr-4 flex items-center justify-center">
                    <img src="{{ asset('images/bel.svg') }}" 
                        alt="Profile Photo" 
                        class="w-5 h-5 object-cover" />
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-700">{{ $detailAduan['nama_pelapor'] }}</h2>
                        <p class="text-gray-600 mt-2">{{ $detailAduan['status_pelapor'] }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500 font-semibold">{{ $detailAduan['waktu'] }}</p>
                    <p class="text-sm text-gray-500 font-semibold">{{ $detailAduan['lokasi'] }}</p>
                    <button class="px-4 py-[5px] text-sm font-semibold text-[#2196F3] ring-1 ring-[#2196F3] rounded-md transition-colors mt-2
                    hover:text-white hover:bg-[#2196F3] mt-2">
                        Detail Pesanan
                    </button>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Isi Aduan Pengguna -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-6">Isi Aduan Pengguna</h3>
                
                <div class="space-y-4">
                    <div class="flex justify-between py-2 border-b border-gray-300">
                        <span class="text-gray-500 font-medium mb-2">Pelapor</span>
                        <span class="text-gray-700 font-bold">{{ $detailAduan['nama_pelapor'] }}</span>
                    </div>
                    
                    <div class="flex justify-between py-2 border-b border-gray-300">
                        <span class="text-gray-500 font-medium mb-2">Alasan Aduan</span>
                        <span class="text-gray-700 font-bold">{{ $detailAduan['jenis_aduan'] }}</span>
                    </div>
                    
                    <div class="pt-4">
                        <h4 class="text-gray-500 font-medium mb-3 mt-1">Detail Aduan</h4>
                        <p class="text-gray-700 text-justify leading-relaxed mb-3">
                            {{ $detailAduan['deskripsi'] }}
                        </p>
                        
                        @if(!empty($detailAduan['detail_aduan']))
                        <ul class="space-y-2 text-gray-700 mb-3">
                            @foreach($detailAduan['detail_aduan'] as $detail)
                            <li class="flex items-start">
                                <span class="text-gray-600 mr-2">•</span>
                                <span>{{ $detail }}</span>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                        
                        @if(!empty($detailAduan['penutup_aduan']))
                        <p class="text-gray-700 text-justify leading-relaxed">
                            {{ $detailAduan['penutup_aduan'] }}
                        </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Data Terlapor -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-6">Data Terlapor</h3>
                
                <div class="space-y-4">
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 font-semibold">Nama Lengkap</span>
                        <span class="text-gray-700 font-medium">{{ $detailAduan['nama_terlapor'] }}</span>
                    </div>
                    
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 font-semibold">Area Kerja</span>
                        <span class="text-gray-700 font-medium">{{ $detailAduan['area_kerja'] }}</span>
                    </div>
                    
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 font-semibold">Jenis Kelamin</span>
                        <span class="text-gray-700 font-medium">{{ $detailAduan['jenis_kelamin'] }}</span>
                    </div>
                    
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 font-semibold">Alamat</span>
                        <span class="text-gray-700 font-medium text-right max-w-xs">{{ $detailAduan['alamat_terlapor'] }}</span>
                    </div>
                </div>
            </div>
        </div>
<script>
    
@endsection