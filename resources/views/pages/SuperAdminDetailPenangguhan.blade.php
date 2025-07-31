@extends('layouts.app')

@section('title', 'Detail Akun Ditangguhkan')
@section('page-title', 'Detail Akun Ditangguhkan')
@section('page-description', 'Informasi lengkap akun yang ditangguhkan')
@section('navtitle')
    <div class="text-base text-gray-700 flex items-center gap-2">
        <span>Penangguhan</span>
        <span class="text-gray-700 font-semibold">&gt;</span>
        <span class="text-green-600 font-semibold">Detail Akun</span>
    </div>
@endsection

@section('navsubtitle', 'Detail Akun Ditangguhkan')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="wfull" style="margin-left: 50px; padding-top: 100px; padding-bottom: 100px; padding-right: 22px;">
        <!-- Header dengan tombol kembali -->
        <div class="flex items-center mb-6">
  <a href="{{ route('penangguhan') }}" title="Kembali ke daftar cabang" class="flex items-center text-gray-600 hover:text-gray-800 transition-colors mr-4">
    <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
      <path
        d="M9.47915 16.9798C9.0833 16.98 8.70301 16.8257 8.41915 16.5498L1.41915 9.54983C0.834242 8.96419 0.834242 8.01546 1.41915 7.42983L8.41915 0.429828C8.79964 0.0511261 9.35326 -0.0958207 9.87147 0.0443407C10.3897 0.184502 10.7937 0.590478 10.9315 1.10934C11.0692 1.6282 10.9196 2.18113 10.5391 2.55983L6.1067 6.99976H17.519C18.3475 6.99976 19.019 7.67133 19.019 8.49976C19.019 9.32818 18.3475 9.99976 17.519 9.99976H6.11161L10.5391 14.4198C10.9676 14.8488 11.0957 15.4935 10.8637 16.0537C10.6318 16.6138 10.0854 16.9793 9.47915 16.9798Z"
        fill="#454545" />
    </svg>
  </a>
  <h2 class="text-xl font-bold text-gray-700">Detail akun ditangguhkan</h2>
</div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Card Kiri - Informasi Profil -->
            <div class="bg-white rounded-lg shadow-sm p-8">
                
                <!-- Profile Photo & Basic Info -->
                <div class="text-center mb-8">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200">
                <img src="/images/orang.svg"
                    alt="Foto Profil"
                    class="w-full h-full object-cover" />
                </div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">Kamarina Mandasari</h2>
                    <p class="text-gray-600">Pelanggan</p>
                </div>

                <!-- Informasi Akun -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2">Informasi Akun</h3>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex justify-between py-2">
                            <span class="text-gray-600 font-medium">Status Akun</span>
                            <span class="px-3 py-1 text-[#FF9900] text-sm font-medium">Penangguhan Sementara</span>
                        </div>
                        
                        <div class="flex justify-between py-2">
                            <span class="text-gray-600 font-medium">Alamat Email</span>
                            <span class="text-gray-800">kamarinda23@gmail.com</span>
                        </div>
                        
                        <div class="flex justify-between py-2">
                            <span class="text-gray-600 font-medium">Ponsel</span>
                            <span class="text-gray-800">082954627818</span>
                        </div>
                        
                        <div class="flex justify-between py-2">
                            <span class="text-gray-600 font-medium">Area Kerja</span>
                            <span class="text-gray-800">Jebres, Surakarta</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-2 pt-4">
                    <a href="{{ route('aduan-pelanggan') }}"
                    class="px-3 py-1 text-sm border border-[#3FC1C0] text-[#3FC1C0] rounded hover:bg-[#E6FAFA] transition-colors font-medium">
                    Lihat Aduan
                    </a>
                    <button onclick="openRestoreModal()" class="px-3 py-1 text-sm bg-lime-600 text-white rounded hover:bg-lime-700 transition-colors font-medium">
                        Pulihkan Akun
                    </button>
                </div>
                </div>
            </div>

            <!-- Card Kanan - Identitas & Informasi Penangguhan -->
            <div class="space-y-6">
                
                <!-- Identitas Diri -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Identitas Diri</h3>
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
                    
                    <div class="space-y-3">
                        <div class="flex justify-between py-1">
                            <span class="text-gray-600">NIK</span>
                            <span class="text-gray-800 font-medium">3171895833200123</span>
                        </div>
                        
                        <div class="flex justify-between py-1">
                            <span class="text-gray-600">Nama Lengkap</span>
                            <span class="text-gray-800 font-medium">Kamarina Mandasari</span>
                        </div>
                        
                        <div class="flex justify-between py-1">
                            <span class="text-gray-600">Tempat Lahir</span>
                            <span class="text-gray-800 font-medium">Surakarta</span>
                        </div>
                        
                        <div class="flex justify-between py-1">
                            <span class="text-gray-600">Tanggal Lahir</span>
                            <span class="text-gray-800 font-medium">20 Mei 1998</span>
                        </div>
                        
                        <div class="flex justify-between py-1">
                            <span class="text-gray-600">Jenis Kelamin</span>
                            <span class="text-gray-800 font-medium">Perempuan</span>
                        </div>
                        
                        <div class="flex justify-between py-1">
                            <span class="text-gray-600">Alamat</span>
                            <span class="text-gray-800 font-medium text-right max-w-xs">Jl Guntur, Ngasrinon, Jebres, Surakarta, Jawa Tengah</span>
                        </div>
                    </div>
                </div>

                <!-- Informasi Penangguhan -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-3 mb-4">Informasi Penangguhan</h3>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between py-1">
                            <span class="text-gray-600">Tanggal Ditangguhkan</span>
                            <span class="text-gray-800 font-medium">20 Oktober 2023</span>
                        </div>
                        
                        <div class="flex justify-between py-1">
                            <span class="text-gray-600">Tanggal Selesai Penangguhan</span>
                            <span class="text-gray-800 font-medium">03 November 2023</span>
                        </div>
                        
                        <div class="flex justify-between py-1">
                            <span class="text-gray-600">Durasi Penangguhan</span>
                            <span class="px-3 py-1 text-gray-800 text-sm font-medium">14 Hari</span>
                        </div>
                        
                        <div class="flex justify-between py-1">
                            <span class="text-gray-600">Sisa Durasi Penangguhan</span>
                            <span class="text-[#FF9900] font-semibold">8 Hari, 16 Jam</span>
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

<!-- Modal Pulihkan Akun -->
<div id="restoreModal" class="fixed inset-0 bg-black bg-opacity-30 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-2xl p-8 max-w-md w-mx mx-4 text-center shadow-2xl">
        
        <!-- Title -->
        <h3 class="text-xl font-semibold text-gray-800 mb-6">Pemulihan Akun</h3>

        <!-- Icon -->
        <div class="mb-6">
            <div class="w-20 h-20 mx-auto rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <img src="{{ asset('images/iconpersonrestore.svg') }}" alt="User Icon" class="w-18 h-18" />
                </svg>
            </div>
        </div>
        
        <!-- Message -->
        <p class="text-gray-600 mb-8">Apakah anda yakin ingin memulihkan akun Kamarina Mandasari?</p>
        
        <!-- Buttons -->
        <div class="flex gap-4 justify-center">
            <button onclick="closeRestoreModal()" 
                    class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors font-medium">
                Batal
            </button>
            <button onclick="confirmRestore()" 
                    class="px-6 py-2 bg-[#3FC1C0] text-white rounded-lg hover:bg-[#3AB3B2] transition-colors font-medium">
                Pulihkan
            </button>
        </div>
    </div>
</div>

<script>
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

function goToModalSlide(slideNumber) {
    currentModalSlide = slideNumber;
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

// Carousel functionality - Removed since we're using pop-ups now

// Fungsi untuk kembali ke halaman sebelumnya
function goBack() {
    // Option 1: Kembali ke halaman sebelumnya
    window.history.back();
    
    // Option 2: Redirect ke halaman daftar akun ditangguhkan
    // window.location.href = '/akun-ditangguhkan';
}

// Modal functions
function openRestoreModal() {
    document.getElementById('restoreModal').classList.remove('hidden');
}

function closeRestoreModal() {
    document.getElementById('restoreModal').classList.add('hidden');
}

function confirmRestore() {
    // Logic untuk memulihkan akun
    console.log('Memulihkan akun Kamarina Mandasari');
    
    // Contoh AJAX request
    // fetch('/restore-account/10', {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/json',
    //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //     }
    // }).then(response => {
    //     if (response.ok) {
    //         alert('Akun berhasil dipulihkan!');
    //         window.location.href = '/akun-ditangguhkan';
    //     }
    // });
    
    alert('Akun Kamarina Mandasari berhasil dipulihkan!');
    closeRestoreModal();
    
    // Redirect kembali ke daftar setelah berhasil
    setTimeout(() => {
        window.location.href = '/akun-ditangguhkan';
    }, 1000);
}

// Close modal when clicking outside
document.getElementById('restoreModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeRestoreModal();
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
        closeRestoreModal();
        closeSKCKModal();
        closeKTPModal();
    }
});

// Dynamic data loading (untuk sinkronisasi dengan data dari tabel)
function loadAccountDetail(accountData) {
    if (accountData) {
        // Update data di halaman berdasarkan parameter yang diterima
        console.log('Loading account detail for:', accountData);
        
        // Contoh update DOM elements
        // document.querySelector('.profile-name').textContent = accountData.nama;
        // document.querySelector('.profile-gender').textContent = accountData.kelamin;
        // document.querySelector('.profile-city').textContent = accountData.kota;
        // dst...
    }
}

// Check if data passed via URL parameters
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('data')) {
        try {
            const accountData = JSON.parse(decodeURIComponent(urlParams.get('data')));
            loadAccountDetail(accountData);
        } catch (e) {
            console.error('Error parsing account data:', e);
        }
    }
});

function showImageModal(imageUrl) {
    document.getElementById('modalImage').src = imageUrl;
    document.getElementById('imageModal').classList.remove('hidden');
}

function closeImageModal() {
    document.getElementById('modalImage').src = '';
    document.getElementById('imageModal').classList.add('hidden');
}

document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});

// Optional: klik luar untuk tutup
document.getElementById('imageModal').addEventListener('click', function (e) {
    if (e.target === this) {
        closeImageModal();
    }
});
</script>

@endsection