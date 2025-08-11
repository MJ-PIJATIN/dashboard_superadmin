@extends('layouts.penangguhan')
@section('navtitle', 'Penangguhan')
@section('navsubtitle', 'Data Akun Ditangguhkan')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="mbg-gray-100 ml-[50px] pt-[100px] pb-[100px] pr-[25px] mr-[26px]">
        <h1 class="text-lg sm:text-xl font-bold text-gray-700 mb-4 sm:mb-6">Data Akun Ditangguhkan</h1>

        <!-- Main Container -->
        <div class="w-full bg-white rounded-lg shadow-sm">
            <!-- Search Section -->
            <div class="p-4 sm:p-6 pb-4">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex w-full sm:w-[300px] max-w-full">
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Cari nomor id, nama, kota, dll"
                            class="flex-grow px-3 sm:px-4 py-2 sm:py-2.5 text-sm border border-gray-300 rounded-l-lg focus:outline-none focus:ring focus:ring-blue-200"/>
                        <button onclick="performSearch()" class="bg-[#469D89] hover:bg-[#378877] text-white px-3 sm:px-4 py-2 rounded-r-lg flex items-center justify-center transition-colors flex-shrink-0">
                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5">
                                <path
                                    d="M8 0.75C12.0041 0.75 15.25 3.99594 15.25 8C15.25 9.7319 14.6427 11.3219 13.6295 12.5688L18.5303 17.4697C18.8232 17.7626 18.8232 18.2374 18.5303 18.5303C18.2641 18.7966 17.8474 18.8208 17.5538 18.6029L17.4697 18.5303L12.5688 13.6295C11.3219 14.6427 9.7319 15.25 8 15.25C3.99594 15.25 0.75 12.0041 0.75 8C0.75 3.99594 3.99594 0.75 8 0.75ZM8 2.25C4.82436 2.25 2.25 4.82436 2.25 8C2.25 11.1756 4.82436 13.75 8 13.75C11.1756 13.75 13.75 11.1756 13.75 8C13.75 4.82436 11.1756 2.25 8 2.25Z"
                                    fill="white"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Desktop Table View (hidden on small screens) -->
            <div class="bg-white rounded-lg mt-0 shadow-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-white">
                        <tr class="bg-white">
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 whitespace-nowrap">#</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 whitespace-nowrap">
                                Nama Lengkap
                                <img src="{{ asset('images/scrollupdown.svg') }}" alt="Sort Icon" class="inline-block ml-1 w-4 h-4" />
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 whitespace-nowrap">
                                Jenis Kelamin
                                <img src="{{ asset('images/scrollupdown.svg') }}" alt="Sort Icon" class="inline-block ml-1 w-4 h-4" />
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 whitespace-nowrap">
                                Kota/Kabupaten
                                <img src="{{ asset('images/scrollupdown.svg') }}" alt="Sort Icon" class="inline-block ml-1 w-4 h-4" />
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 whitespace-nowrap">
                                Durasi Penangguhan
                                <img src="{{ asset('images/scrollupdown.svg') }}" alt="Sort Icon" class="inline-block ml-1 w-4 h-4" />
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700"></th>
                        </tr>
                        <tr>
                        <th colspan="6" class="px-1 pt-0 pb-3">
                            <div class="h-px bg-gray-700 mx-4"></div>
                        </th>
                    </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($suspendedAccounts ?? [] as $account)
                        <tr id="account-row-{{ $account['suspension_id'] }}" class="group cursor-pointer transition-transform duration-200 transform hover:scale-[1.01] hover:bg-gray-50 hover:ring-[0.5px] hover:ring-gray-200 hover:ring-offset-0 hover:shadow-sm hover:rounded-md" onclick="navigateToDetail('{{ $account['suspension_id'] }}', event)">
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $account['suspension_id'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $account['nama'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $account['kelamin'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $account['area_kerja'] }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $durasi = $account['durasi'];
                                    $durasiClass = match($durasi) {
                                        'Permanen' => 'bg-[#ED555433] text-[#ED5554]',
                                        '30 Hari', '14 Hari', '7 Hari' => 'bg-[#FF990033] text-[#FF9900]',
                                        default => 'bg-gray-100 text-gray-600'
                                    };
                                    $durasiText = $durasi;
                                    if ($durasi !== 'Permanen') {
                                        $durasiText = str_replace('Hari', 'hari', $durasi);
                                    }
                                @endphp
                                <span class="inline-block w-24 px-3 py-1 rounded-md text-xs font-medium {{ $durasiClass }}">
                                    {{ $durasiText }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 relative">
                                <div class="flex items-center justify-end">
                                    <!-- Waktu - tampil normal, hilang saat hover -->
                                    <span class="group-hover:opacity-0 transition-opacity duration-200">
                                        {{ $account['waktu'] }}
                                    </span>
                                    
                                    <!-- Button - tersembunyi normal, muncul saat hover -->
                                    <div class="absolute inset-y-0 right-4 flex items-center justify-end opacity-0 group-hover:opacity-100 transition-opacity duration-200 pr-6">
                                        <button onclick="openModal('{{ $account['suspension_id'] }}', '{{ $account['nama'] }}'); event.stopPropagation();"
                                            title="Pulihkan"
                                            class="flex items-center justify-center transition duration-200 hover:bg-green-100 rounded-md p-1">
                                            <img src="/images/pemulihan.svg" alt="Pulihkan" class="w-5 h-5" />
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-lg font-medium text-gray-400">Tidak ada akun yang ditangguhkan</p>
                                    <p class="text-sm text-gray-400">Data akun ditangguhkan akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            @if($paginationData['total'] > 10)
                <div class="flex flex-col sm:flex-row justify-between items-center px-4 sm:px-6 py-4 border-gray-200 gap-4">
                    <span class="text-sm text-gray-600 order-2 sm:order-1">
                        Halaman {{ $paginationData['current_page'] }} dari {{ $paginationData['total_pages'] }}
                    </span>
                    <div class="flex items-center gap-1 order-1 sm:order-2">
                        @if($paginationData['current_page'] > 1)
                            <a href="{{ request()->fullUrlWithQuery(['page' => $paginationData['current_page'] - 1]) }}" class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">←</a>
                        @endif

                        @php
                            $start = max(1, $paginationData['current_page'] - 2);
                            $end = min($paginationData['total_pages'], $paginationData['current_page'] + 2);
                        @endphp

                        @if($start > 1)
                            <a href="{{ request()->fullUrlWithQuery(['page' => 1]) }}" class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">1</a>
                            @if($start > 2)
                                <span class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700">...</span>
                            @endif
                        @endif

                        @for($i = $start; $i <= $end; $i++)
                            @if($i == $paginationData['current_page'])
                                <span class="w-8 h-8 flex items-center justify-center text-sm font-medium text-white bg-teal-600 rounded">{{ $i }}</span>
                            @else
                                <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}" class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">{{ $i }}</a>
                            @endif
                        @endfor

                        @if($end < $paginationData['total_pages'])
                            @if($end < $paginationData['total_pages'] - 1)
                                <span class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700">...</span>
                            @endif
                            <a href="{{ request()->fullUrlWithQuery(['page' => $paginationData['total_pages']]) }}" class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">{{ $paginationData['total_pages'] }}</a>
                        @endif

                        @if($paginationData['current_page'] < $paginationData['total_pages'])
                            <a href="{{ request()->fullUrlWithQuery(['page' => $paginationData['current_page'] + 1]) }}" class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">→</a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Popup -->
<div id="restoreModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-6 sm:p-8 max-w-md w-full mx-4 text-center shadow-2xl">
        
        <!-- Title -->
        <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4 sm:mb-6">Pulihkan</h3>

        <!-- Icon -->
        <div class="mb-4 sm:mb-6">
            <div class="w-16 sm:w-20 h-16 sm:h-20 mx-auto rounded-full flex items-center justify-center">
                <img src="/images/iconpersonrestore.svg" alt="Peringatan" class="w-24 sm:w-24 h-24 sm:h-15" />
            </div>
        </div>
        
        <!-- Message -->
        <p class="text-gray-600 mb-6 sm:mb-8 text-sm sm:text-base" id="modalMessage">Apakah Anda yakin ingin memulihkan data penangguhan ini?</p>
        
        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
            <button onclick="closeModal()" 
                    class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700 transition-colors font-medium text-sm sm:text-base order-2 sm:order-1">
                Batal
            </button>
            <button onclick="confirmRestore()" 
                    id="restoreButton"
                    class="px-6 py-2 bg-[#06923E] text-white rounded-lg hover:bg-[#16610E] transition-colors font-medium text-sm sm:text-base order-1 sm:order-2">
                Pulihkan
            </button>
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

@section('scripts')
<script>
let currentUserId = null;
let currentUserName = null;

// CSRF Token
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

// Fungsi untuk menampilkan loading drawer
function showLoadingDrawer() {
    document.getElementById('loading-drawer').classList.remove('hidden');
}

// Fungsi untuk menyembunyikan loading drawer
function hideLoadingDrawer() {
    document.getElementById('loading-drawer').classList.add('hidden');
}

// Fungsi untuk menampilkan success drawer
function showSuccessDrawer(message) {
    document.getElementById('success-message').textContent = message;
    document.getElementById('success-drawer').classList.remove('hidden');
    
    // Auto hide after 3 seconds
    setTimeout(() => {
        hideSuccessDrawer();
    }, 3000);
}

// Fungsi untuk menyembunyikan success drawer
function hideSuccessDrawer() {
    document.getElementById('success-drawer').classList.add('hidden');
}

// Fungsi untuk navigasi ke halaman detail
function navigateToDetail(id, event) {
    // Menggunakan route helper Laravel untuk konsistensi
    window.location.href = "{{ route('detiladuan', ['id' => ':id']) }}".replace(':id', id);
}

// Fungsi untuk membuka modal konfirmasi restore
function openModal(userId, userName) {
    currentUserId = userId;
    currentUserName = userName;
    document.getElementById('modalMessage').textContent = `Apakah Anda yakin ingin memulihkan akun ${userName}?`;
    document.getElementById('restoreModal').classList.remove('hidden');
}

// Fungsi untuk menutup modal
function closeModal() {
    document.getElementById('restoreModal').classList.add('hidden');
    currentUserId = null;
    currentUserName = null;
    
    // Reset button state
    const restoreButton = document.getElementById('restoreButton');
    restoreButton.textContent = 'Pulihkan';
    restoreButton.disabled = false;
}

// Fungsi untuk mengkonfirmasi restore akun
function confirmRestore() {
    if (!currentUserId) {
        console.error('No user ID available');
        return;
    }
    
    // Close modal first
    closeModal();
    
    // Show loading drawer
    showLoadingDrawer();
    
    // Debug log
    console.log('Attempting to restore account ID:', currentUserId);
    
    // AJAX request untuk memulihkan akun - menggunakan hanya ID dari URL parameter
    fetch("{{ route('suspended-account.restore', ['id' => ':id']) }}".replace(':id', currentUserId), {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        hideLoadingDrawer();
        if (response.ok) {
            return response.json();
        } else {
            // Coba parse error JSON, jika gagal, lempar error umum
            return response.json().then(err => { throw new Error(err.message || 'Gagal memulihkan akun.'); }).catch(() => { throw new Error('Gagal memulihkan akun.'); });
        }
    })
    .then(data => {
        if (data.success) {
            showSuccessDrawer(data.message || 'Akun berhasil dipulihkan!');
            // Hapus baris dari tabel tanpa reload halaman
            const row = document.getElementById(`account-row-${currentUserId}`);
            if (row) row.remove();
            // Optional: refresh setelah beberapa saat jika diperlukan untuk update data lain
            setTimeout(() => {
                // Cek jika tabel kosong, tampilkan pesan
                const tableBody = document.getElementById('tableBody');
                if (tableBody && tableBody.children.length === 0) {
                    location.reload(); // Reload jika tabel kosong untuk menampilkan pesan
                }
            }, 1500);
        } else {
            throw new Error(data.message || 'Operasi gagal.');
        }
    })
    .catch(error => {
        hideLoadingDrawer();
        console.error('Fetch error:', error);
        showSuccessDrawer(error.message || 'Terjadi kesalahan. Silakan coba lagi.');
    });
}

// Fungsi untuk pencarian
function performSearch() {
    const query = document.getElementById('searchInput').value;
    
    if (query.trim() === '') {
        // Jika kosong, reload halaman untuk menampilkan semua data
        window.location.reload();
        return;
    }
    
    // AJAX request untuk pencarian
    fetch("{{ route('suspended-account.search') }}?q=" + encodeURIComponent(query), {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateTable(data.data);
            updateMobileCards(data.data);
        } else {
            console.error('Search failed:', data.message);
        }
    })
    .catch(error => {
        console.error('Search error:', error);
    });
}

// Fungsi untuk update mobile cards dengan hasil pencarian
function updateMobileCards(accounts) {
    const mobileCards = document.getElementById('mobileCards');
    
    if (accounts.length === 0) {
        mobileCards.innerHTML = `
            <div class="text-center py-12">
                <svg class="w-12 h-12 text-gray-300 mb-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <p class="text-lg font-medium text-gray-400">Tidak ada hasil ditemukan</p>
                <p class="text-sm text-gray-400">Coba gunakan kata kunci yang berbeda</p>
            </div>
        `;
        return;
    }
    
    let cardsHTML = '';
    accounts.forEach((account) => {
        // Determine duration class based on duration
        let durationClass = 'bg-gray-100 text-gray-600';
        if (account.durasi === 'Permanen') {
            durationClass = 'bg-red-100 text-red-600';
        } else if (account.durasi.includes('30 Hari')) {
            durationClass = 'bg-orange-100 text-orange-600';
        } else if (account.durasi.includes('7 Hari') || account.durasi.includes('14 Hari')) {
            durationClass = 'bg-yellow-100 text-yellow-600';
        }
        
        cardsHTML += `
            <div class="bg-white border border-gray-200 rounded-lg p-4 mb-4 shadow-sm" 
                 onclick="navigateToDetail(${account.id}, event)">
                <div class="flex justify-between items-start mb-3">
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900 text-base">${account.nama}</h3>
                        <p class="text-sm text-gray-500">ID: ${account.id}</p>
                    </div>
                    <button onclick="openModal(${account.id}, '${account.nama}'); event.stopPropagation();" 
                        class="p-2 text-gray-400 hover:text-[#469D89] transition-colors flex-shrink-0">
                        <img src="/images/pemulihan.svg" alt="Pulihkan" class="w-5 h-5" />
                    </button>
                </div>
                
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <span class="text-gray-500">Jenis Kelamin:</span>
                        <p class="text-gray-900 font-medium">${account.kelamin}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Kota:</span>
                        <p class="text-gray-900 font-medium">${account.kota}</p>
                    </div>
                </div>
                
                <div class="mt-3 flex justify-between items-center">
                    <span class="px-3 py-1 rounded-full text-xs font-medium ${durationClass}">
                        ${account.durasi}
                    </span>
                    <span class="text-xs text-gray-500">-</span>
                </div>
            </div>
        `;
    });
    
    mobileCards.innerHTML = cardsHTML;
}

// Fungsi untuk update tabel dengan hasil pencarian
function updateTable(accounts) {
    const tableBody = document.getElementById('tableBody');
    
    if (accounts.length === 0) {
        tableBody.innerHTML = `
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                    <div class="flex flex-col items-center">
                        <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <p class="text-lg font-medium text-gray-400">Tidak ada hasil ditemukan</p>
                        <p class="text-sm text-gray-400">Coba gunakan kata kunci yang berbeda</p>
                    </div>
                </td>
            </tr>
        `;
        return;
    }
    
    let tableHTML = '';
    accounts.forEach((account) => {
        // Determine duration class based on duration
        let durationClass = 'bg-gray-100 text-gray-600';
        if (account.durasi === 'Permanen') {
            durationClass = 'bg-red-100 text-red-600';
        } else if (account.durasi.includes('30 Hari')) {
            durationClass = 'bg-orange-100 text-orange-600';
        } else if (account.durasi.includes('7 Hari') || account.durasi.includes('14 Hari')) {
            durationClass = 'bg-yellow-100 text-yellow-600';
        }
        
        tableHTML += `
            <tr class="border-b border-gray-100 hover:bg-gray-50 group cursor-pointer transition-transform duration-200 transform hover:scale-[1.01]" 
                onclick="navigateToDetail(${account.suspension_id}, event)">
                <td class="px-6 py-4 text-sm text-gray-700">${account.id}</td>
                <td class="px-6 py-4 text-sm text-gray-900">${account.nama}</td>
                <td class="px-6 py-4 text-sm text-gray-700">${account.kelamin}</td>
                <td class="px-6 py-4 text-sm text-gray-700">${account.area_kerja}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-medium ${durationClass}">
                        ${account.durasi}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500 relative flex items-center justify-end">
                    <span class="group-hover:opacity-0 transition-opacity duration-200"> ${account.waktu} </span>
                    <button onclick="openModal(${account.id}, '${account.nama}'); event.stopPropagation();" 
                        class="opacity-0 group-hover:opacity-100 absolute inset-y-0 right-4 flex items-center justify-end opacity-0 group-hover:opacity-100 transition-opacity duration-200 pr-8">
                        <img src="/images/pemulihan.svg" alt="Pulihkan" class="w-5 h-5" />
                    </button>
                </td>
            </tr>
        `;
    });
    
    tableBody.innerHTML = tableHTML;
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Search on Enter key
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });
    
    // Close modal when clicking outside
    document.getElementById('restoreModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    // Close success drawer when clicking outside
    document.getElementById('success-drawer').addEventListener('click', function(e) {
        if (e.target === this) {
            hideSuccessDrawer();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
            hideSuccessDrawer();
        }
    });
    
    // Prevent modal close when clicking inside modal content
    document.querySelector('#restoreModal .bg-white')?.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    
    // Prevent success drawer close when clicking inside drawer content
    document.querySelector('#success-drawer-content')?.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});

// Auto-refresh setiap 5 menit untuk update status real-time
setInterval(function() {
    // Hanya refresh jika tidak ada modal yang terbuka
    if (document.getElementById('restoreModal').classList.contains('hidden') && 
        document.getElementById('loading-drawer').classList.contains('hidden') &&
        document.getElementById('success-drawer').classList.contains('hidden')) {
        // Bisa diganti dengan AJAX request untuk update data tanpa refresh halaman
        // fetchUpdatedData();
    }
}, 300000); // 5 menit
</script>
@endsection

@endsection