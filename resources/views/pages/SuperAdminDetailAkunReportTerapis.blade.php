@extends('layouts.aduan_pelanggan')
@section('navtitle')
    <div class="text-base text-gray-700 flex items-center gap-2">
        <span>Aduan Pelanggan</span>
        <span class="text-gray-700 font-semibold">&gt;</span>
        <span class="text-green-600 font-semibold">Detail Report Akun Terapis</span>
    </div>
@endsection

@section('navsubtitle', 'Detail Akun dari Aduan')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="" style="margin-left: 50px; padding-top: 100px; padding-bottom: 100px; padding-right: 22px; margin-right: 26px;">
        <!-- Header dengan tombol kembali -->
        <div class="flex items-center mb-6">
            <a href="{{ route('aduan-pelanggan') }}" title="Kembali ke daftar aduan" class="flex items-center text-gray-600 hover:text-gray-800 transition-colors mr-4">
                <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                    <path
                        d="M9.47915 16.9798C9.0833 16.98 8.70301 16.8257 8.41915 16.5498L1.41915 9.54983C0.834242 8.96419 0.834242 8.01546 1.41915 7.42983L8.41915 0.429828C8.79964 0.0511261 9.35326 -0.0958207 9.87147 0.0443407C10.3897 0.184502 10.7937 0.590478 10.9315 1.10934C11.0692 1.6282 10.9196 2.18113 10.5391 2.55983L6.1067 6.99976H17.519C18.3475 6.99976 19.019 7.67133 19.019 8.49976C19.019 9.32818 18.3475 9.99976 17.519 9.99976H6.11161L10.5391 14.4198C10.9676 14.8488 11.0957 15.4935 10.8637 16.0537C10.6318 16.6138 10.0854 16.9793 9.47915 16.9798Z"
                        fill="#454545" />
                </svg>
            </a>
            <h2 class="text-xl font-bold text-gray-700">Detail Akun Terapis</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Card Kiri - Informasi Profil -->
            <div class="bg-white rounded-lg shadow-sm p-8">
                
                <!-- Profile Photo & Basic Info -->
                <div class="text-center mb-8">
                    <div class="w-52 h-52 mx-auto mb-4 rounded-full overflow-hidden flex items-center justify-center {{ ($detailTerapis->profile_photo ?? null) ? '' : 'bg-gray-200' }}">
                        @if (($detailTerapis->profile_photo ?? null))
                            <img src="{{ $detailTerapis->profile_photo }}" alt="Foto Profil" class="w-full h-full object-cover">
                        @else
                            @php
                                $name = $detailTerapis->name ?? '';
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
                            <span class="text-gray-600 font-bold text-5xl">{{ $initials }}</span>
                        @endif
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $detailTerapis->name ?? '-' }}</h2>
                    <div class="flex justify-center">
                        <p class="bg-[#469d89]/30 text-[#469d89] font-semibold text-sm px-2 py-1 rounded-md w-fit">Terapis</p>
                    </div>
                </div>

                <!-- Informasi Akun -->
                <div class="space-y-6">
                    <h3 class="text-2xl font-semibold text-gray-800 border-gray-200 pb-2">Informasi Akun</h3>
                    
                    <div class="grid grid-cols-1 gap-5">
                        <div class="flex justify-between py-2 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Nomor ID</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis->id ?? '-' }}</span>
                        </div>
                        
                       <div class="flex justify-between py-2 border-b border-gray-400">
                        <span class="text-gray-400 font-medium">Status Akun</span>
                        @if(empty($detailTerapis->suspended_duration))
                            <span class="py-1 text-medium font-medium text-[#85B804]">
                                Tidak dalam penangguhan
                            </span>
                        @else
                            <span class="py-1 text-medium font-medium text-red-600">
                                Akun dalam penangguhan ({{ $detailTerapis->suspended_duration }})
                            </span>
                        @endif
                    </div>
                        
                        <div class="flex justify-between py-2 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Alamat Email</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis->email ?? '-' }}</span>
                        </div>
                        
                        <div class="flex justify-between py-2 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Ponsel</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis->phone ?? '-' }}</span>
                        </div>
                        
                        <div class="flex justify-between py-2 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Area Kerja</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis->work_area ?? '-' }}</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-2 pt-16">
                        <button onclick="sendWarning()" 
                                class="px-3 py-1 text-sm border border-[#FF9900] text-[#FF9900] rounded hover:bg-[#FFF4E5] transition-colors font-medium">
                            Kirim Peringatan
                        </button>

                        <button onclick="openSuspendModal()" 
                                class="px-3 py-1 text-sm border border-[#ED5554] text-[#ED5554] rounded hover:bg-[#FFECEC] transition-colors font-medium">
                            Tangguhkan Akun
                        </button>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                
                <!-- Identitas Diri -->
                <div class="bg-white rounded-lg shadow-sm p-6 min-h-[400px] flex flex-col justify-between">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-semibold text-gray-800 border-gray-200 pb-2">Identitas Diri</h3>
                        <div class="flex gap-2">
                            <button onclick="showKTPModal()"  
                                class="px-3 py-1 bg-white border border-blue-500 text-blue-500 text-sm font-semibold rounded-md hover:bg-blue-500 hover:text-white transition-colors">
                                Lihat KTP
                            </button>

                            <button onclick="showSKCKModal()"  
                                class="px-3 py-1 bg-white border border-blue-500 text-blue-500 text-sm font-semibold rounded-md hover:bg-blue-500 hover:text-white transition-colors">
                                Lihat SKCK
                            </button>
                        </div>
                    </div>
                    
                    <div class="space-y-5">
                        <div class="flex justify-between py-1 border-b border-gray-400 mt-4">
                            <span class="text-gray-400">NIK</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis->NIK ?? '-' }}</span>
                        </div>
                        
                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Nama Lengkap</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis->name ?? '-' }}</span>
                        </div>
                        
                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Tempat Lahir</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis->addres ?? '-' }}</span>
                        </div>
                        
                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Tanggal Lahir</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis->formatted_birth_date ?? '-' }}</span>
                        </div>
                        
                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Jenis Kelamin</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis->formatted_gender ?? '-' }}</span>
                        </div>
                        
                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Alamat</span>
                            <span class="py-1 text-gray-700 font-semibold text-right max-w">{{ $detailTerapis->addres ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Informasi Lainnya -->
                <div class="bg-white rounded-lg shadow-sm p-6 min-h-[400px] flex flex-col justify-between">
                    <h2 class="text-2xl font-semibold text-gray-800 border-gray-200 pb-2">Informasi Lainnya</h2>
                    
                    <div class="space-y-5">
                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Tipe Pengguna</span>
                            <span class="py-1 text-gray-700 font-semibold">Terapis</span>
                        </div>
                        
                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Tanggal Bergabung</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis->formatted_joining_date ?? '-' }}</span>
                        </div>
                        
                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Total layanan diselesaikan</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis->total_layanan ?? 0 }} Layanan</span>
                        </div>
                        
                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Total Layanan Ditolak</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis->layanan_ditolak ?? 0 }} Layanan</span>
                        </div>

                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Total Peringatan Diterima</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis->total_peringatan ?? 0 }}x Peringatan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pop-up untuk Peringatan Pelanggan -->
<div id="warningDrawer" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl w-full mx-4" id="warningDrawerContent" style="max-width:500px;">
        <div class="p-6 max-h-[90vh] overflow-y-auto">
            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-700">Peringatan Pelanggan</h3>
                <button onclick="closeWarningDrawer()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="space-y-4">
                <p class="text-gray-600 text-sm">Berikan alasan peringatan kepada akun yang berkaitan.</p>
                
                <!-- Textarea -->
                <div>
                    <textarea 
                        id="warningReason" 
                        placeholder="Penulisan dibatasi hingga 500 karakter." 
                        class="w-full h-32 px-3 py-2 border border-gray-300 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                        maxlength="500"></textarea>
                    <div class="text-xs text-gray-400 mt-1">
                        <span id="warningCharCount">0</span>/500 karakter
                    </div>
                </div>

                <!-- Duration Selection -->
                <div>
                <div class="flex items-center mb-6">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="suspendDuration" class="sr-only">
                    <div class="checkbox-visual w-4 h-4 rounded bg-white border border-gray-300 flex items-center justify-center transition-colors duration-200">
                        <svg class="checkbox-icon w-3 h-3 text-white opacity-0 transition-opacity duration-200"
                            fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="ml-3 text-sm text-gray-700">Pilih durasi penangguhan</span>
                </label>
            </div>
                <div class="flex flex-wrap gap-6" id="durationOptions">
                <style>
                input[type="radio"] {
                    accent-color: #0d9488; /* teal-600 */
                }
                </style>

                <label class="flex items-center">
                    <input type="radio" name="warning_duration" value="1" class="mr-2">
                    <span class="text-sm text-gray-700">7 Hari</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="warning_duration" value="7" class="mr-2">
                    <span class="text-sm text-gray-700">14 Hari</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="warning_duration" value="14" class="mr-2">
                    <span class="text-sm text-gray-700">30 Hari</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="warning_duration" value="30" class="mr-2">
                    <span class="text-sm text-gray-700">Permanen</span>
                </label>
            </div>

            </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button onclick="submitWarning()" class="w-full bg-teal-500 text-white py-3 rounded-lg font-medium hover:bg-teal-600 transition-colors">
                        Kirim
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pop-up untuk Penangguhan Akun -->
<div id="suspendDrawer" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4" id="suspendDrawerContent" style="max-width: 500px">
        <div class="p-6 max-h-[90vh] overflow-y-auto">
            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-700">Penangguhan Akun</h3>
                <button onclick="closeSuspendDrawer()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Warning Notice -->
            <div class="bg-yellow-100 border border-yellow-300 rounded-lg p-3 mb-4 flex items-start gap-3">
                <div>
                    <p class="text-sm text-yellow-800">Pastikan anda telah melakukan pertimbangan yang matang sebelum melakukan penangguhan pada akun ini!</p>
                </div>
                <div class="text-yellow-600 mt-0.5">
                    <img src="/images/peringatan.svg" alt="ikon" class="w-18 h-18" />
                </div>
            </div>

            <!-- Content -->
            <div class="space-y-4">
                <p class="text-gray-700 font-medium">Pilih alasan penangguhan</p>
                
                <!-- Reason Selection -->
                <div class="space-y-3">
                    <label class="flex items-start gap-3">
                        <input type="radio" name="suspendReason" value="sexual" class="mt-1 text-blue-600">
                        <div>
                            <div class="text-sm font-medium text-gray-900">Pelecehan Seksual</div>
                            <div class="text-xs text-gray-500">Tindakan tidak pantas terkait seksualitas.</div>
                        </div>
                    </label>
                    
                    <label class="flex items-start gap-3">
                        <input type="radio" name="suspendReason" value="threats" class="mt-1 text-blue-600">
                        <div>
                            <div class="text-sm font-medium text-gray-900">Penghinaan</div>
                            <div class="text-xs text-gray-500">Ujaran kasar yang melukai atau mencemarkan nama baik.</div>
                        </div>
                    </label>
                    
                    <label class="flex items-start gap-3">
                        <input type="radio" name="suspendReason" value="inappropriate" class="mt-1 text-blue-600">
                        <div>
                            <div class="text-sm font-medium text-gray-900">Perilaku Tidak Sopan</div>
                            <div class="text-xs text-gray-500">Tindakan tidak mengikuti etika sosial dan sopan santun.</div>
                        </div>
                    </label>
                    
                    <label class="flex items-start gap-3">
                        <input type="radio" name="suspendReason" value="violence" class="mt-1 text-blue-600">
                        <div>
                            <div class="text-sm font-medium text-gray-900">Tindak Kekerasan</div>
                            <div class="text-xs text-gray-500">Ancaman, intimidasi, atau agresi yang mengancang keamanan dan kenyamanan.</div>
                        </div>
                    </label>
                    
                    <label class="flex items-start gap-3">
                        <input type="radio" name="suspendReason" value="warning" class="mt-1 text-blue-600">
                        <div>
                            <div class="text-sm font-medium text-gray-900">Mengabaikan Peringatan</div>
                            <div class="text-xs text-gray-500">Mengulang perilaku yang telah diingatkan atau diberikan peringatan sebelumnya.</div>
                        </div>
                    </label>
                </div>

                <!-- Description -->
                <div>
                    <p class="text-gray-700 font-medium mb-2">Berikan penjelasan penangguhan pada pengguna yang ditangguhkan.</p>
                    <textarea 
                        id="suspendDescription" 
                        placeholder="Penulisan dibatasi hingga 500 karakter." 
                        class="w-full h-20 px-3 py-2 border border-gray-300 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                        maxlength="500"></textarea>
                    <div class="text-xs text-gray-400 mt-1">
                        <span id="suspendCharCount">0</span>/500 karakter
                    </div>
                </div>

                <!-- Duration Selection -->
                <div>
            <p class="text-gray-700 font-medium mb-4">Pilih durasi penangguhan</p>
            <div id="durationOptions" class="flex flex-wrap gap-4">
                <label class="inline-flex items-center gap-2">
                <input type="radio" name="suspend_duration" value="1" class="text-blue-600">
                <span class="text-sm text-gray-700">7 Hari</span>
                </label>
                <label class="inline-flex items-center gap-2">
                <input type="radio" name="suspend_duration" value="7" class="text-blue-600">
                <span class="text-sm text-gray-700">14 Hari</span>
                </label>
                <label class="inline-flex items-center gap-2">
                <input type="radio" name="suspend_duration" value="14" class="text-blue-600">
                <span class="text-sm text-gray-700">30 Hari</span>
                </label>
                <label class="inline-flex items-center gap-2">
                <input type="radio" name="suspend_duration" value="30" class="text-blue-600">
                <span class="text-sm text-gray-700">Permanen</span>
                </label>
            </div>
            </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button onclick="submitSuspension()" 
        data-terapis-id="{{ $detailTerapis->id ?? '' }}"
        data-suspend-url="{{ route('terapis.suspend', ['id' => $detailTerapis->id ?? '']) }}"
        class="w-full bg-red-500 text-white py-3 rounded-lg font-medium hover:bg-red-600 transition-colors">
    Tangguhkan
</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal KTP dengan Carousel -->
<div id="ktpModal" class="fixed inset-0 bg-black bg-opacity-30 z-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded-md shadow-lg relative max-w-2xl w-full mx-2">
        <div class="mb-2 relative">
            <h2 id="ktpModalTitle" class="text-lg font-semibold text-gray-700 text-center w-full">Foto KTP</h2>
        </div>
        <div class="relative w-full bg-white rounded-lg overflow-hidden">
            <div class="relative h-96">
                <!-- Slide 1 -->
                <div id="modalSlide1" class="absolute inset-0 transition-transform duration-300 ease-in-out transform translate-x-0">
                    <img src="{{ asset('images/ktp.JPG') }}" alt="Foto KTP" class="w-full h-full object-contain bg-white rounded-md">
                    <button id="arrowNext" onclick="nextModalSlide()" class="absolute right-0 top-1/2 transform -translate-y-1/2 transition-all">
                        <img src="{{ asset('images/kanan.svg') }}" alt="Next" class="w-6 h-6" />
                    </button>
                </div>

                <!-- Slide 2 -->
                <div id="modalSlide2" class="absolute inset-0 transition-transform duration-300 ease-in-out transform translate-x-full">
                    <img src="{{ asset('images/selfiektp.svg') }}" alt="Selfie KTP" class="w-full h-full object-contain bg-white">
                    <button id="arrowPrev" onclick="previousModalSlide()" class="absolute left-0 top-1/2 transform -translate-y-1/2 transition-all hidden">
                        <img src="{{ asset('images/kiri.svg') }}" alt="Previous" class="w-6 h-6" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal SKCK -->
<div id="skckModal" class="fixed inset-0 hidden bg-black bg-opacity-30 items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg relative max-w-3xl w-full mx-4">
        <div class="flex justify-between items-center mb-4">
            <h4 class="text-lg font-semibold text-gray-700 text-center w-full">Foto SKCK</h4>
        </div>
        <div class="text-center">
            <img id="skckImage" src="{{ asset('images/skck.jpg') }}" alt="SKCK" class="rounded w-full h-auto object-contain max-h-96">
        </div>
    </div>
</div>

<!-- Loading Spinner Drawer -->
<div id="loading-drawer" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white rounded-lg shadow-lg" style="width: 400px; padding: 70.5px;">
            <div class="flex flex-col items-center mb-4">
                <img src="{{ asset('images/loading.svg') }}" alt="Loading" class="h-30 w-30 animate-spin" />
            </div>
        </div>
    </div>
</div>

<!-- Success Drawer -->
<div id="success-drawer" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
    <div id="success-drawer-overlay" class="flex items-center justify-center h-full">
        <div id="success-drawer-content" class="bg-white rounded-lg shadow-lg" style="width: 400px; padding: 24px; min-height: 280px;">
            <div class="flex flex-col items-center mb-4">
                <h2 class="text-2xl font-bold mb-6" style="color: #469D89;">Berhasil!</h2>
                <img src="{{ asset('images/succed.svg') }}" alt="Success" class="h-30 w-30">
                <p id="success-message" class="text-gray-700 text-center mt-4">Operasi berhasil dilakukan!</p>
            </div>
        </div>
    </div>
</div>

<script>
// Helper function to truncate string
function truncateString(str, num) {
  if (str.length <= num) {
    return str;
  }
  return str.slice(0, num) + '...';
}

// Warning Drawer functions
function sendWarning() {
    const drawer = document.getElementById('warningDrawer');
    drawer.classList.remove('hidden');
    drawer.classList.add('flex');
    
    // Reset form
    drawer.querySelector('#warningReason').value = '';
    drawer.querySelector('#warningCharCount').textContent = '0';
    drawer.querySelector('#suspendDuration').checked = false;
    drawer.querySelectorAll('input[name="warning_duration"]').forEach(radio => {
        radio.checked = false;
        radio.disabled = true;
    });
}

function closeWarningDrawer() {
    const drawer = document.getElementById('warningDrawer');
    drawer.classList.add('hidden');
    drawer.classList.remove('flex');
}

function submitWarning() {
    const drawer = document.getElementById('warningDrawer');
    const reason = drawer.querySelector('#warningReason').value;
    const hasSuspension = drawer.querySelector('#suspendDuration').checked;
    let duration = null;
    
    if (!reason.trim()) {
        alert('Mohon isi alasan peringatan!');
        return;
    }
    
    if (hasSuspension) {
        const selectedDuration = drawer.querySelector('input[name="warning_duration"]:checked');
        if (!selectedDuration) {
            alert('Mohon pilih durasi penangguhan!');
            return;
        }
        duration = selectedDuration.value;
    }
    
    closeWarningDrawer();
    showLoadingDrawer();

    const formData = new FormData();
    formData.append('reason', reason);
    if (duration) {
        formData.append('duration', duration);
    }
    formData.append('_token', '{{ csrf_token() }}');

    fetch(`{{ route('terapis.warn', ['id' => $detailTerapis->id ?? '']) }}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        hideLoadingDrawer();
        if (data.success) {
            showSuccessDrawer(data.message || 'Peringatan berhasil dikirim.');
        } else {
            alert(data.message || 'Gagal mengirim peringatan.');
        }
    })
    .catch(error => {
        hideLoadingDrawer();
        console.error('Error:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
    });
}

// Suspend Drawer functions
function openSuspendModal() {
    const drawer = document.getElementById('suspendDrawer');
    drawer.classList.remove('hidden');
    drawer.classList.add('flex');
    
    // Reset form
    drawer.querySelector('#suspendDescription').value = '';
    drawer.querySelector('#suspendCharCount').textContent = '0';
    drawer.querySelectorAll('input[name="suspendReason"]').forEach(radio => radio.checked = false);
    drawer.querySelectorAll('input[name="suspend_duration"]').forEach(radio => radio.checked = false);
}

function closeSuspendDrawer() {
    const drawer = document.getElementById('suspendDrawer');
    drawer.classList.add('hidden');
    drawer.classList.remove('flex');
}

<!-- Tambahkan data attribute pada button atau container -->

function submitSuspension() {
    const drawer = document.getElementById('suspendDrawer');
    const reason = drawer.querySelector('input[name="suspendReason"]:checked');
    const description = drawer.querySelector('#suspendDescription').value;
    const duration = drawer.querySelector('input[name="suspend_duration"]:checked');
    
    if (!reason) {
        alert('Mohon pilih alasan penangguhan!');
        return;
    }
    if (!description.trim()) {
        alert('Mohon isi penjelasan penangguhan!');
        return;
    }
    if (!duration) {
        alert('Mohon pilih durasi penangguhan!');
        return;
    }

    const reasonValue = reason.value;
    const durationValue = duration.value;
    
    console.log('Data yang akan dikirim:', {
        reason: reasonValue,
        description: description,
        duration: durationValue,
        terapisId: '{{ $detailTerapis->id ?? "" }}'
    });

    const formData = new FormData();
    formData.append('reason', reasonValue);
    formData.append('description', description);
    formData.append('duration', durationValue);
    formData.append('_token', '{{ csrf_token() }}');

    closeSuspendDrawer();
    showLoadingDrawer();

    const suspendUrl = '{{ route("terapis.suspend", ["id" => $detailTerapis->id ?? ""]) }}';
    console.log('URL yang digunakan:', suspendUrl);

    fetch(suspendUrl, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        console.log('Response headers:', [...response.headers.entries()]);
        
        // Langsung return response.json() untuk response yang berhasil
        if (response.ok) {
            return response.json();
        }
        
        // Untuk response error, coba parse sebagai JSON dulu
        return response.text().then(text => {
            console.log('Error response text:', text);
            try {
                const jsonData = JSON.parse(text);
                return Promise.reject({
                    status: response.status,
                    message: jsonData.message || `HTTP ${response.status} Error`,
                    data: jsonData
                });
            } catch (e) {
                // Jika tidak bisa di-parse sebagai JSON, anggap sebagai HTML error
                return Promise.reject({
                    status: response.status,
                    message: `HTTP ${response.status}: Server Error`,
                    isHtml: text.includes('<html') || text.includes('<!DOCTYPE'),
                    text: text.substring(0, 500) // Ambil 500 karakter pertama untuk debugging
                });
            }
        });
    })
    .then(data => {
        hideLoadingDrawer();
        console.log('Success response:', data);
        
        if (data.success) {
            showSuccessDrawer(data.message || 'Akun berhasil ditangguhkan.');
            
            // Redirect ke halaman penangguhan setelah 3 detik
            setTimeout(() => {
                // Gunakan POST request untuk mengirim success message
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('penangguhan') }}";
                form.style.display = 'none';
                
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                const messageInput = document.createElement('input');
                messageInput.type = 'hidden';
                messageInput.name = 'success_message';
                messageInput.value = data.message || 'Akun berhasil ditangguhkan.';
                form.appendChild(messageInput);

                document.body.appendChild(form);
                form.submit();
            }, 3000);
        } else {
            alert(data.message || 'Gagal menangguhkan akun.');
        }
    })
    .catch(error => {
        hideLoadingDrawer();
        console.error('Error details:', error);
        
        if (error.status === 500) {
            if (error.isHtml) {
                console.error('Server returned HTML error page:', error.text);
                alert('Server error (500). Silakan cek Laravel log untuk detail. Error mungkin terkait database atau konfigurasi.');
            } else {
                alert(`Error 500: ${error.message}`);
            }
        } else if (error.status === 422) {
            // Validation error
            alert(`Validation Error: ${error.message}`);
            if (error.data && error.data.errors) {
                console.error('Validation errors:', error.data.errors);
            }
        } else if (error.status) {
            alert(`HTTP ${error.status}: ${error.message}`);
        } else {
            // Network error atau error lainnya
            alert(`Network error: ${error.message || 'Terjadi kesalahan jaringan'}`);
        }
    });
}

function showLoadingDrawer() {
    document.getElementById('loading-drawer').classList.remove('hidden');
}

function hideLoadingDrawer() {
    document.getElementById('loading-drawer').classList.add('hidden');
}

function showSuccessDrawer(message) {
    document.getElementById('success-message').textContent = message;
    document.getElementById('success-drawer').classList.remove('hidden');
    
    setTimeout(() => {
        hideSuccessDrawer();
    }, 3000);
}

function hideSuccessDrawer() {
    document.getElementById('success-drawer').classList.add('hidden');
}

// Character count for textareas
document.getElementById('warningReason')?.addEventListener('input', function() {
    const count = this.value.length;
    document.getElementById('warningCharCount').textContent = count;
});

document.getElementById('suspendDescription')?.addEventListener('input', function() {
    const count = this.value.length;
    document.getElementById('suspendCharCount').textContent = count;
});

// KTP Modal functions
let currentModalSlide = 1;
const totalModalSlides = 2;

function showKTPModal() {
    document.getElementById('ktpModal').classList.remove('hidden');
    document.getElementById('ktpModal').classList.add('flex');
    currentModalSlide = 1;
    updateModalSlides();
}

function closeKTPModal() {
    document.getElementById('ktpModal').classList.add('hidden');
    document.getElementById('ktpModal').classList.remove('flex');
}

function nextModalSlide() {
    if (currentModalSlide < totalModalSlides) {
        currentModalSlide++;
    } else {
        currentModalSlide = 1;
    }
    updateModalSlides();
}

function previousModalSlide() {
    if (currentModalSlide > 1) {
        currentModalSlide--;
    } else {
        currentModalSlide = totalModalSlides;
    }
    updateModalSlides();
}

function updateModalSlides() {
    const slide1 = document.getElementById('modalSlide1');
    const slide2 = document.getElementById('modalSlide2');
    const title = document.getElementById('ktpModalTitle');
    const arrowNext = document.getElementById('arrowNext');
    const arrowPrev = document.getElementById('arrowPrev');

    if (currentModalSlide === 1) {
        slide1.style.transform = 'translateX(0)';
        slide2.style.transform = 'translateX(100%)';
        title.innerText = 'Foto KTP';
        arrowNext.classList.remove('hidden');
        arrowPrev.classList.add('hidden');
    } else {
        slide1.style.transform = 'translateX(-100%)';
        slide2.style.transform = 'translateX(0)';
        title.innerText = 'Selfie KTP';
        arrowNext.classList.add('hidden');
        arrowPrev.classList.remove('hidden');
    }
}

// SKCK Modal functions
function showSKCKModal() {
    document.getElementById('skckModal').classList.remove('hidden');
    document.getElementById('skckModal').classList.add('flex');
}

function closeSKCKModal() {
    document.getElementById('skckModal').classList.add('hidden');
    document.getElementById('skckModal').classList.remove('flex');
}

// Close modal when clicking outside
document.getElementById('warningDrawer')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeWarningDrawer();
    }
});

document.getElementById('suspendDrawer')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeSuspendDrawer();
    }
});

document.getElementById('skckModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeSKCKModal();
    }
});

document.getElementById('ktpModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeKTPModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeWarningDrawer();
        closeSuspendDrawer();
        closeSKCKModal();
        closeKTPModal();
        hideSuccessDrawer();
    }
});

// Checkbox untuk durasi penangguhan di warning modal
const checkbox = document.getElementById('suspendDuration');
const radios = document.querySelectorAll('input[name="warning_duration"]');

checkbox.addEventListener('change', () => {
    radios.forEach(radio => {
        radio.disabled = !checkbox.checked;
        if (!checkbox.checked) {
            radio.checked = false; // Reset pilihan jika checkbox dimatikan
        }
    });
});

// JavaScript untuk solusi 2
        const checkbox2 = document.getElementById('suspendDuration');
        const visual2 = checkbox2.nextElementSibling;
        const icon2 = visual2.querySelector('.checkbox-icon');

        checkbox2.addEventListener('change', function() {
            if (this.checked) {
                visual2.classList.add('bg-[#3FC1C0]', 'border-[#3FC1C0]');
                visual2.classList.remove('border-gray-300');
                icon2.classList.remove('opacity-0');
                icon2.classList.add('opacity-100');
            } else {
                visual2.classList.remove('bg-[#3FC1C0]', 'border-[#3FC1C0]');
                visual2.classList.add('border-gray-300');
                icon2.classList.add('opacity-0');
                icon2.classList.remove('opacity-100');
            }
        });
</script>

@endsection