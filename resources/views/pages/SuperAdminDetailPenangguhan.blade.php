@extends('layouts.app')

@section('title', 'Detail Akun Ditangguhkan')
@section('page-title', 'Detail Akun Ditangguhkan')
@section('page-description', 'Informasi lengkap akun yang ditangguhkan')
@section('navtitle')
    <div class="text-base text-gray-700 flex items-center gap-2">
        <span>Penangguhan</span>
        <span class="text-green-600 font-semibold">&gt;</span>
        <span class="text-green-600 font-semibold">Detail Akun</span>
    </div>
@endsection

@section('navsubtitle', 'Detail Akun Ditangguhkan')

@section('content')
<!-- Modal Gambar -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-60 z-50 hidden items-center justify-center">
    <div class="bg-white p-4 rounded-lg shadow-lg relative max-w-sm w-full">
        <button onclick="closeImageModal()" class="absolute top-2 right-2 text-gray-600 hover:text-red-500">
            ✕
        </button>
        <img id="modalImage" src="" alt="Dokumen" class="rounded w-full h-auto object-contain">
    </div>
</div>
<div class="bg-gray-100 min-h-screen">
    <div class="max-w-screen-xl" style="margin-left: 50px; padding-top: 100px; padding-bottom: 100px; padding-right: 22px;">
        
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
                        <img src="data:image/jpeg;base64,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" 
                             alt="Profile Photo" 
                             class="w-full h-full object-cover" />
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">Mas Amba S.Eks</h2>
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
                        <button onclick="showImageModal('{{ asset('images/ktp.JPG') }}')" 
                            class="px-3 py-1 border border-blue-500 text-blue-500 text-sm font-semibold rounded-md hover:bg-blue-50 transition-colors">
                            Lihat Foto KTP
                        </button>
                        <button onclick="showImageModal('{{ asset('images/ktp.JPG') }}')" 
                            class="px-3 py-1 border border-blue-500 text-blue-500 text-sm font-semibold rounded-md hover:bg-blue-50 transition-colors">
                            Lihat SKCK
                        </button>
                    </div>

                    <!-- Modal Gambar -->
                    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-60 z-50 hidden items-center justify-center">
                        <div id="draggableModal" class="bg-white p-4 rounded-lg shadow-lg relative max-w-sm w-full transform transition-transform scale-95 hover:scale-100 duration-300">
                            <button onclick="closeImageModal()" class="absolute top-2 right-2 text-gray-600 hover:text-red-500">
                                ✕
                            </button>
                            <img id="modalImage" src="" alt="Dokumen" class="rounded w-full h-auto object-contain">
                        </div>
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

<!-- Modal Pulihkan Akun -->
<div id="restoreModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-2xl p-8 max-w-md w-mx mx-4 text-center shadow-2xl">
        
        <!-- Title -->
        <h3 class="text-xl font-semibold text-gray-800 mb-6">Pemulihan Akun</h3>

        <!-- Icon -->
        <div class="mb-6">
            <div class="w-20 h-20 mx-auto rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
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

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeRestoreModal();
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
        if (e.key === 'Enter') {
        showImageModal('{{ asset('images/ktp.JPG') }}'); // default
        }
    });

    function makeModalDraggable() {
        const modal = document.getElementById("draggableModal");
        let isDragging = false;
        let offsetX, offsetY;

        modal.addEventListener("mousedown", function (e) {
            isDragging = true;
            offsetX = e.clientX - modal.getBoundingClientRect().left;
            offsetY = e.clientY - modal.getBoundingClientRect().top;
            modal.style.position = 'absolute';
            modal.style.zIndex = 9999;
        });

        document.addEventListener("mousemove", function (e) {
            if (isDragging) {
                modal.style.left = e.clientX - offsetX + "px";
                modal.style.top = e.clientY - offsetY + "px";
            }
        });

        document.addEventListener("mouseup", function () {
            isDragging = false;
        });
    }

    document.addEventListener("DOMContentLoaded", makeModalDraggable);
</script>


@endsection