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
                    <div class="w-52 h-52 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200">
                        <img src="/images/karsa.svg"
                            alt="Foto Profil"
                            class="w-full h-full object-cover" />
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $detailTerapis['nama'] }}</h2>
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
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis['id'] }}</span>
                        </div>
                        
                        <div class="flex justify-between py-2 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Status Akun</span>
                            <span class="py-1 text-medium font-medium {{ $detailTerapis['status_akun'] == 'Tidak dalam Penangguhan' ? 'text-[#85B804]' : 'text-red-600' }}">
                                {{ $detailTerapis['status_akun'] }}
                            </span>
                        </div>
                        
                        <div class="flex justify-between py-2 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Alamat Email</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis['email'] }}</span>
                        </div>
                        
                        <div class="flex justify-between py-2 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Ponsel</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis['ponsel'] }}</span>
                        </div>
                        
                        <div class="flex justify-between py-2 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Area Kerja</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis['area_kerja'] }}</span>
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
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis['nik'] }}</span>
                        </div>
                        
                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Nama Lengkap</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis['nama'] }}</span>
                        </div>
                        
                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Tempat Lahir</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis['tempat_lahir'] }}</span>
                        </div>
                        
                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Tanggal Lahir</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis['tanggal_lahir'] }}</span>
                        </div>
                        
                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Jenis Kelamin</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis['jenis_kelamin'] }}</span>
                        </div>
                        
                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Alamat</span>
                            <span class="py-1 text-gray-700 font-semibold text-right max-w">{{ $detailTerapis['alamat'] }}</span>
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
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis['tanggal_bergabung'] }}</span>
                        </div>
                        
                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Total layanan diselesaikan</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis['total_layanan'] }} Layanan</span>
                        </div>
                        
                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Total Layanan Ditolak</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis['layanan_ditolak'] }} Layanan</span>
                        </div>

                        <div class="flex justify-between py-1 border-b border-gray-400">
                            <span class="text-gray-400 font-medium">Total Peringatan Diterima</span>
                            <span class="py-1 text-gray-700 font-semibold">{{ $detailTerapis['total_peringatan'] }}x Peringatan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Konfirmasi Peringatan -->
<div id="warningModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Peringatan</h3>
        <p class="text-gray-600 mb-6">Apakah Anda yakin ingin mengirim peringatan kepada {{ $detailTerapis['nama'] }}?</p>
        <div class="flex justify-end gap-3">
            <button onclick="closeWarningModal()" class="px-4 py-2 text-gray-600 border border-gray-300 rounded hover:bg-gray-50">
                Batal
            </button>
            <button onclick="confirmWarning()" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                Kirim Peringatan
            </button>
        </div>
    </div>
</div>

<!-- Modal untuk Konfirmasi Penangguhan -->
<div id="suspendModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Penangguhan</h3>
        <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menangguhkan akun {{ $detailTerapis['nama'] }}?</p>
        <div class="flex justify-end gap-3">
            <button onclick="closeSuspendModal()" class="px-4 py-2 text-gray-600 border border-gray-300 rounded hover:bg-gray-50">
                Batal
            </button>
            <button onclick="confirmSuspend()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                Tangguhkan Akun
            </button>
        </div>
    </div>
</div>

<!-- Modal KTP dengan Carousel -->
<div id="ktpModal" class="fixed inset-0 bg-black bg-opacity-30 z-50 hidden flex items-center justify-center">
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
<div id="skckModal" class="fixed inset-0 hidden bg-black bg-opacity-30 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg relative max-w-3xl w-full mx-4">
        <div class="flex justify-between items-center mb-4">
            <h4 class="text-lg font-semibold text-gray-700 text-center w-full">Foto SKCK</h4>
        </div>
        <div class="text-center">
            <img id="skckImage" src="{{ asset('images/skck.jpg') }}" alt="SKCK" class="rounded w-full h-auto object-contain max-h-96">
        </div>
    </div>
</div>

<script>
// Warning Modal functions
function sendWarning() {
    document.getElementById('warningModal').classList.remove('hidden');
    document.getElementById('warningModal').classList.add('flex');
}

function closeWarningModal() {
    document.getElementById('warningModal').classList.add('hidden');
    document.getElementById('warningModal').classList.remove('flex');
}

function confirmWarning() {
    // Logic untuk mengirim peringatan
    alert('Peringatan berhasil dikirim kepada {{ $detailTerapis['nama'] }}!');
    closeWarningModal();
}

// Suspend Modal functions
function openSuspendModal() {
    document.getElementById('suspendModal').classList.remove('hidden');
    document.getElementById('suspendModal').classList.add('flex');
}

function closeSuspendModal() {
    document.getElementById('suspendModal').classList.add('hidden');
    document.getElementById('suspendModal').classList.remove('flex');
}

function confirmSuspend() {
    // Logic untuk menangguhkan akun
    alert('Akun {{ $detailTerapis['nama'] }} berhasil ditangguhkan!');
    closeSuspendModal();
}

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
document.getElementById('warningModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeWarningModal();
    }
});

document.getElementById('suspendModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeSuspendModal();
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
        closeWarningModal();
        closeSuspendModal();
        closeSKCKModal();
        closeKTPModal();
    }
});
</script>

@endsection