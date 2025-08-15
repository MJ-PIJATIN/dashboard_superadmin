@extends('layouts.aduan_pelanggan')
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
    <div class="" style="margin-left: 50px; padding-top: 100px; padding-bottom: 100px; padding-right: 22px; margin-right: 26px;">
        
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
                    <div class="w-16 h-16 rounded-full overflow-hidden mr-4 flex items-center justify-center">
                    <img src="{{ asset('images/orang.svg') }}" 
                        alt="Profile Photo" 
                        class="w-full h-full object-cover" />
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-700">{{ $detailAduan->customer->name ?? 'Pelanggan tidak ditemukan' }}</h2>
                        <p class="text-gray-600 mt-2">Pelanggan</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500 font-semibold">{{ $detailAduan->created_at->format('H:i, d M Y') }}</p>
                    <p class="text-sm text-gray-500 font-semibold mb-2">{{ $detailAduan->customer->addres ?? 'Alamat tidak tersedia' }}</p>
                    @if($detailAduan->booking && ($detailAduan->booking->status === 'Selesai' || $detailAduan->booking->status === 'Dibatalkan'))
                    <a href="{{ route('pesanan.detail', ['tipe' => $detailAduan->booking->payment, 'id' => $detailAduan->booking->id]) }}"
                       class="text-blue-600 hover:underline">
                        <svg width="18" height="18" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.9103 8.94769C10.633 10.6704 10.8132 13.3515 9.45099 15.2747L9.30957 15.4644L13.5277 19.6835L13.6025 19.7702C13.8272 20.0731 13.8023 20.5026 13.5277 20.7772C13.2532 21.0517 12.8235 21.0767 12.5207 20.8521L12.434 20.7772L8.17677 16.52C6.26097 17.8118 3.63804 17.6101 1.94298 15.915C0.0190071 13.9911 0.0190071 10.8717 1.94298 8.94769C3.86695 7.02376 6.98633 7.02376 8.9103 8.94769ZM10.6307 0C11.2273 0 11.7996 0.236932 12.2216 0.658707L15.034 3.46961L17.8421 6.28199C18.2634 6.70392 18.5 7.2758 18.5 7.87206V17.7532C18.5 18.996 17.4925 20.0036 16.2496 20.0036L14.74 20.0042C14.7026 19.7111 14.5917 19.4249 14.4058 19.1743L14.2848 19.03L13.758 18.5023L16.2496 18.5033C16.6639 18.5033 16.9997 18.1674 16.9997 17.7532L16.9989 8.00442L12.7522 8.00532C11.5611 8.00532 10.5862 7.07999 10.507 5.90899L10.5018 5.75491V1.50027H4.75076C4.33647 1.50027 4.00062 1.83612 4.00062 2.2504L4.00029 6.67236C3.48132 6.79549 2.97573 6.98942 2.49892 7.25417L2.50036 2.2504C2.50036 1.00754 3.5079 0 4.75076 0H10.6307ZM3.03667 10.0414C1.71674 11.3613 1.71674 13.5014 3.03667 14.8213C4.35662 16.1413 6.49666 16.1413 7.8166 14.8213C9.13654 13.5014 9.13654 11.3613 7.8166 10.0414C6.49666 8.72145 4.35662 8.72145 3.03667 10.0414ZM12.002 2.56045V5.75491C12.002 6.13468 12.2843 6.44852 12.6504 6.49819L12.7522 6.50505L15.9437 6.50416L12.002 2.56045Z" fill="#2196F3"/>
                        </svg>
                    </a>
                    @endif
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
                        <span class="text-gray-700 font-bold">{{ $detailAduan->customer->name ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="flex justify-between py-2 border-b border-gray-300">
                        <span class="text-gray-500 font-medium mb-2">Status Aduan</span>
                        <span class="text-gray-700 font-bold">{{ Str::ucfirst($detailAduan->reason) }}</span>
                    </div>
                    
                    <div class="pt-4">
                        <h4 class="text-gray-500 font-medium mb-3 mt-1">Detail Aduan</h4>
                        <p class="text-gray-700 text-justify leading-relaxed mb-3">
                            {{ $detailAduan->descript }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Data Terlapor -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-6">Data Terlapor</h3>
                
                @if($detailAduan->target)
                    {{-- Case 1: The reported person is a THERAPIST --}}
                    @if($detailAduan->target_type === 'therapist')
                        <div class="space-y-4">
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-500 font-semibold">Tipe</span>
                                <span class="text-gray-700 font-medium">Terapis</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-500 font-semibold">Nama Lengkap</span>
                                <span class="text-gray-700 font-medium">{{ $detailAduan->target->name ?? 'Data tidak tersedia' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-500 font-semibold">Area Kerja</span>
                                <span class="text-gray-700 font-medium">{{ $detailAduan->target->work_area ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-500 font-semibold">Jenis Kelamin</span>
                                <span class="text-gray-700 font-medium">
                                    {{ $detailAduan->target->gender === 'L' ? 'Laki-laki' : ($detailAduan->target->gender === 'P' ? 'Perempuan' : '-') }}
                                </span>
                            </div>
                        </div>
                    {{-- Case 2: The reported person is a CUSTOMER --}}
                    @elseif($detailAduan->target_type === 'customer')
                        <div class="space-y-4">
                             <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-500 font-semibold">Tipe</span>
                                <span class="text-gray-700 font-medium">Pelanggan</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-500 font-semibold">Nama Lengkap</span>
                                <span class="text-gray-700 font-medium">{{ $detailAduan->target->name ?? 'Data tidak tersedia' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-500 font-semibold">Jenis Kelamin</span>
                                <span class="text-gray-700 font-medium">{{ $detailAduan->target->gender ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-500 font-semibold">Alamat</span>
                                <span class="text-gray-700 font-medium text-right max-w-xs">{{ $detailAduan->target->addres ?? '-' }}</span>
                            </div>
                        </div>
                    @endif
                @else
                    <p class="text-gray-500">Data teradu tidak dapat ditemukan.</p>
                @endif
            </div>
        </div>
<script>
    
@endsection