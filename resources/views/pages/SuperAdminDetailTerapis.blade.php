@extends('layouts.terapis')
@section('navtitle')
    <div class="text-base flex items-center gap-2" style="color: #374151;">
        <span>Terapis</span>
        <span class="text-grey-700 font-semibold">&gt;</span>
        <span class="font-semibold" style="color: #469D89;">Detail Akun</span>
    </div>
@endsection

@section('navsubtitle', 'Detail Akun Terapis')

@section('content')
<div class="" style="margin-left: 50px; padding-top: 100px; padding-bottom: 100px; padding-right: 25px; margin-right: 26px;">
        
        <!-- Header dengan tombol kembali -->
        <div class="flex items-center mb-6">
            <div class="flex items-center text-sm text-gray-700 font-semibold hover:text-gray-800 transition-colors">
                <img onclick="goBack()" src="{{ asset('images/back.svg') }}" alt="Back Icon" class="w-4 h-4 mr-2 cursor-pointer">
                <span class="font-large text-base">Detail Akun Terapis</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- Card Kiri - Profile Info -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                
                <!-- Profile Photo & Basic Info -->
                <div class="text-center mb-6">
                    <div class="w-24 h-24 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200 ring-2 ring-gray-100">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=300&fit=crop&crop=face" 
                             alt="Profile Photo" 
                             class="w-full h-full object-cover" />
                    </div>
                    <h2 class="text-lg font-bold text-gray-900 mb-2">Karsa Wijaya</h2>
                    <span class="inline-block px-3 py-1 rounded rectangle-full text-xs font-medium" 
                          style="background-color: #469D8933; color: #469D89;">
                        Terapis
                    </span>
                    
                    <!-- Rating Stars -->
                    <div class="flex justify-center items-center mt-7 space-x-1">
                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                        </svg>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                        </svg>
                    </div>
                </div>

                <!-- Informasi Data -->
                <div class="space-y-4">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3 mt-14">Informasi data</h3>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Status Akun</span>
                            <span class="px-2 py-1 rounded-full text-xs font-medium" style= "color: #85B804;">
                                Tersedia
                            </span>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Alamat Email</span>
                            <span class="text-gray-900 text-xs font-medium">karsawijaya@gmail.com</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Ponsel</span>
                            <span class="text-gray-900 text-xs font-medium">08897E754578</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Area Kerja</span>
                            <span class="text-gray-900 text-xs font-medium">Bantul, Yogyakarta</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Kanan - Identitas & Transaksi -->
            <div class="space-y-6">
                
                <!-- Identitas Diri -->
                <div class="bg-white rounded-xl shadow-lg p-5 border border-gray-300">
                    <h3 class="text-sm font-semibold text-gray-900 mb-4">Identitas Diri</h3>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">NIK</span>
                            <span class="text-gray-900 text-xs font-medium">3171895833240935</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Nama Lengkap</span>
                            <span class="text-gray-900 text-xs font-medium">Karsa Wijaya</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Jenis Kelamin</span>
                            <span class="text-gray-900 text-xs font-medium">Laki-Laki</span>
                        </div>
                    </div>
                </div>

                <!-- Transaksi Terakhir -->
                <div class="bg-white rounded-xl shadow-lg p-5 border border-gray-200">
                    <h3 class="text-sm font-semibold text-gray-900 mb-4">Transaksi Terakhir</h3>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Nama Customer</span>
                            <span class="text-gray-900 text-xs font-medium">Willy Sutejo</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Layanan Utama</span>
                            <span class="text-gray-900 text-xs font-medium">Full Body Massage</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Layanan Tambahan</span>
                            <span class="text-gray-900 text-xs font-medium">Kerokan</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Durasi</span>
                            <span class="text-gray-900 text-xs font-medium">60 Menit</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Total Biaya Layanan</span>
                            <span class="text-gray-900 text-xs font-medium">Rp 180.000</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Tanggal Pelayanan</span>
                            <span class="text-gray-900 text-xs font-medium">25 Desember 2024</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Fungsi untuk kembali ke halaman sebelumnya
function goBack() {
    window.history.back();
}

// Dynamic data loading
function loadAccountDetail(accountData) {
    if (accountData) {
        console.log('Loading account detail for:', accountData);
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
</script>

@endsection