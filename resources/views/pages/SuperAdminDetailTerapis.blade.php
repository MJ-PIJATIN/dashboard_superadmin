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
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 flex flex-col">
                
                <!-- Profile Photo & Basic Info -->
                <div class="text-center mb-6">
                    <div class="w-52 h-52 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200" id="profile-photo-container">
                        @if($terapis->photo_url && $terapis->photo_url !== asset('images/default-avatar.png'))
                            <img src="{{ $terapis->photo_url }}" 
                                 alt="Profile Photo of {{ $terapis->name }}" 
                                 class="w-full h-full object-cover"
                                 id="profile-photo"
                                 onerror="showInitials()" />
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-300 text-gray-600 text-4xl font-semibold" id="initials-fallback">
                                {{ $terapis->initials ?? substr($terapis->name ?? 'N', 0, 2) }}
                            </div>
                        @endif
                    </div>
                    <h2 class="text-lg font-bold text-gray-900 mb-2">{{ $terapis->name ?? 'Nama Tidak Tersedia' }}</h2>
                    <span class="inline-block px-3 py-1 rounded rectangle-full text-xs font-medium" 
                          style="background-color: #469D8933; color: #469D89;">
                        Terapis
                    </span>
                    
                    <!-- Rating Stars (Static for now) -->
                    <div class="flex justify-center items-center mt-7 space-x-1">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                        @endfor
                    </div>
                </div>

                <!-- Informasi Data -->
                <div class="space-y-4">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3 mt-14">Informasi data</h3>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Status Akun</span>
                            <span class="px-2 py-1 rounded-full text-xs font-medium" style="color: {{ ($terapis->is_available ?? true) ? '#85B804' : '#EF4444' }};">
                                {{ $terapis->status_display ?? 'Aktif' }}
                            </span>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Alamat Email</span>
                            <span class="text-gray-900 text-xs font-medium">{{ $terapis->email ?? '-' }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Ponsel</span>
                            <span class="text-gray-900 text-xs font-medium">{{ $terapis->phone ?? '-' }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Area Kerja</span>
                            <span class="text-gray-900 text-xs font-medium">{{ $terapis->area_kerja ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Kanan - Identitas & Transaksi -->
            <div class="space-y-6w-1/2 flex flex-col space-y-6">
                
                <!-- Identitas Diri -->
                <div class="bg-white rounded-xl shadow-lg p-5 border border-gray-300 flex-1">
                    <h3 class="text-sm font-semibold text-gray-900 mb-4">Identitas Diri</h3>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">NIK</span>
                            <span class="text-gray-900 text-xs font-medium">{{ $terapis->NIK ?? '-' }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Nama Lengkap</span>
                            <span class="text-gray-900 text-xs font-medium">{{ $terapis->name ?? '-' }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 border-b border-gray-300">
                            <span class="text-gray-600 text-xs">Jenis Kelamin</span>
                            <span class="text-gray-900 text-xs font-medium">{{ $terapis->formatted_gender ?? $terapis->gender_display ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Transaksi Terakhir (Static data as requested) -->
                <div class="bg-white rounded-xl shadow-lg p-5 border border-gray-200 flex-1">
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

// Function to show initials when photo fails to load
function showInitials() {
    console.log('Profile image failed to load, showing initials');
    const profilePhoto = document.getElementById('profile-photo');
    const container = document.getElementById('profile-photo-container');
    
    if (profilePhoto) {
        profilePhoto.style.display = 'none';
    }
    
    if (container) {
        container.innerHTML = `
            <div class="w-full h-full flex items-center justify-center bg-gray-300 text-gray-600 text-4xl font-semibold" id="initials-fallback">
                {{ substr($terapis->name ?? 'N', 0, 2) }}
            </div>
        `;
    }
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    console.log('Detail terapis page loaded for: {{ $terapis->name ?? "Unknown" }}');
    
    // Debug information
    console.log('Area Kerja:', '{{ $terapis->area_kerja ?? "Not set" }}');
    console.log('Formatted Gender:', '{{ $terapis->formatted_gender ?? "Not set" }}');
    console.log('Gender Display:', '{{ $terapis->gender_display ?? "Not set" }}');
    console.log('Raw Gender:', '{{ $terapis->gender ?? "Not set" }}');
    
    // Handle BLOB photo loading
    const profilePhoto = document.getElementById('profile-photo');
    if (profilePhoto) {
        // Add loading indicator
        profilePhoto.onload = function() {
            console.log('Profile photo loaded successfully');
        };
        
        profilePhoto.onerror = function() {
            console.log('Error loading profile photo, showing initials');
            showInitials();
        };
        
        // Add timeout for slow loading images
        setTimeout(function() {
            if (profilePhoto && !profilePhoto.complete) {
                console.log('Photo loading timeout, showing initials');
                showInitials();
            }
        }, 10000); // 10 second timeout
    }
    
    // Optional: Add click handler to view photo in full size
    const photoContainer = document.getElementById('profile-photo-container');
    if (photoContainer && '{{ $terapis->photo_url ?? "" }}') {
        photoContainer.style.cursor = 'pointer';
        photoContainer.addEventListener('click', function() {
            // Open photo in new tab/window
            window.open('{{ $terapis->photo_url ?? "" }}', '_blank');
        });
    }
});

// Optional: Function to refresh photo if needed
function refreshPhoto() {
    const profilePhoto = document.getElementById('profile-photo');
    if (profilePhoto && '{{ $terapis->photo_url ?? "" }}') {
        // Add timestamp to force refresh
        const url = '{{ $terapis->photo_url ?? "" }}';
        profilePhoto.src = url + '?t=' + new Date().getTime();
    }
}

// Call debug function on page load (remove after testing)
debugTerapisData();
</script>

@endsection