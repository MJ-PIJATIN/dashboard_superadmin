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
                    <div class="w-16 h-16 rounded-full overflow-hidden mr-4 flex items-center justify-center {{ ($detailAduan->customer->profile_photo ?? null) ? '' : 'bg-gray-200' }}">
                        @if (($detailAduan->customer->profile_photo ?? null))
                            <img src="{{ $detailAduan->customer->profile_photo }}" alt="Foto Profil" class="w-full h-full object-cover">
                        @else
                            @php
                                $name = $detailAduan->customer->name ?? '';
                                $initials = '';
                                if ($name) {
                                    $parts = explode(' ', $name);
                                    if (count($parts) >= 2) {
                                        $initials = strtoupper(substr($parts[0], 0, 1) . substr(end($parts), 0, 1));
                                    } elseif (!empty($parts[0])) {
                                        $initials = strtoupper(substr($parts[0], 0, 2));
                                    }
                                }
                            @endphp
                            <span class="text-gray-600 font-bold text-xl">{{ $initials }}</span>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-700">{{ $detailAduan->customer->name ?? 'Pelanggan tidak ditemukan' }}</h2>
                        <p class="text-gray-600 mt-2">Pelanggan</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500 font-semibold">{{ $detailAduan->created_at->format('H:i, d M Y') }}</p>
                    <p class="text-sm text-gray-500 font-semibold mb-2">{{ $detailAduan->customer->addres ?? 'Alamat tidak tersedia' }}</p>
                    
                    {{-- Buttons Container --}}
                    <div class="flex gap-2 justify-end">
                        @if($detailAduan->booking)
                            <a href="{{ route('pesanan.detail', [
                                'tipe' => strtolower($detailAduan->booking->payment ?? 'transfer'), 
                                'id' => $detailAduan->booking->id,
                                'return' => base64_encode(route('detiladuan', $detailAduan->id))
                            ]) }}" 
                            class="px-4 py-[5px] text-sm font-semibold text-white bg-blue-500 rounded-md transition-colors hover:bg-blue-600">
                                Detail Pesanan
                            </a>
                        @endif
                    </div>
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
                    
                    {{-- Show booking status if booking exists --}}
                    @if($detailAduan->booking)
                        <div class="flex justify-between py-2 border-b border-gray-300">
                            <span class="text-gray-500 font-medium mb-2">Status Pesanan</span>
                            <span class="text-gray-700 font-bold 
                                @if($detailAduan->booking->status === 'Selesai') text-teal-500
                                @elseif($detailAduan->booking->status === 'Dibatalkan') text-red-500
                                @elseif($detailAduan->booking->status === 'Berlangsung') text-green-600
                                @elseif($detailAduan->booking->status === 'Dijadwalkan') text-cyan-400
                                @elseif($detailAduan->booking->status === 'Pending') text-amber-500
                                @elseif($detailAduan->booking->status === 'Menunggu') text-yellow-400
                                @else text-gray-700 @endif">
                                {{ $detailAduan->booking->status }}
                            </span>
                        </div>
                    @endif
                    
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
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-500 font-semibold">Alamat</span>
                                <span class="text-gray-700 font-medium text-right max-w-xs">{{ $detailAduan->target->addres ?? '-' }}</span>
                        </div>
                    {{-- Case 2: The reported person is a CUSTOMER --}}
                    @elseif($detailAduan->target_type === 'customer')
                        <div class="space-y-4">
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
    // Additional JavaScript if needed
    console.log('Detail Aduan page loaded');
</script>
    
@endsection