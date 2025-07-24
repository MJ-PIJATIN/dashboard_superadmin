    @extends('layouts.app')

    @section('title', 'Dashboard')
    @section('page-title', 'Dashboard')
    @section('page-description', 'Ringkasan statistik dan aktivitas terkini sistem Pijat.in')
    @section('navtitle', 'Penangguhan')
    @section('navsubtitle', 'Data Akun Ditangguhkan')

    @section('content')
    <div class="bg-gray-100 min-h-screen">
        <div class="max-w-screen-xl" style="margin-left: 290px; padding-top: 100px; padding-bottom: 100px; padding-right: 22px;">
            <h1 class="text-xxl font-bold text-gray-700 mb-4">Data Akun Ditangguhkan</h1>

            <!-- Main Container -->
            <div class="w-full bg-white rounded-lg shadow-sm">
                <!-- Search Section -->
                <div class="p-6 pb-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center w-80">
                            <input 
                                type="text" 
                                id="searchInput"
                                placeholder="Cari nomor id, nama, kota, dll"
                                class="flex-grow px-4 py-2.5 text-sm border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                            />
                            <button onclick="performSearch()" class="w-12 h-11 bg-teal-600 hover:bg-teal-700 rounded-r-md transition-colors flex items-center justify-center">
                                <img src="{{ asset('images/search.svg') }}" alt="Search Icon" class="w-6 h-6">
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 bg-gray-50">
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">No</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">
                                    Nama Lengkap
                                    <img src="{{ asset('images/scrollupdown.svg') }}" alt="Sort Icon" class="inline-block ml-1 w-4 h-4" />
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">
                                    Jenis Kelamin
                                    <img src="{{ asset('images/scrollupdown.svg') }}" alt="Sort Icon" class="inline-block ml-1 w-4 h-4" />
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">
                                    Kota/Kabupaten
                                    <img src="{{ asset('images/scrollupdown.svg') }}" alt="Sort Icon" class="inline-block ml-1 w-4 h-4" />
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">
                                    Durasi Penangguhan
                                    <img src="{{ asset('images/scrollupdown.svg') }}" alt="Sort Icon" class="inline-block ml-1 w-4 h-4" />
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-700"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white" id="tableBody">
                            @forelse($suspendedAccounts ?? [] as $account)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 group cursor-pointer" 
                                onclick="navigateToDetail({{ $account['id'] }}, event)">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $account['id'] }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $account['nama'] }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $account['kelamin'] }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $account['kota'] }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $account['durasi_class'] }}">
                                        {{ $account['durasi'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 relative">
                                    <!-- Waktu - hilang saat hover -->
                                    <span class="group-hover:opacity-0 transition-opacity duration-200">{{ $account['waktu'] }}</span>
                                    
                                    <!-- Tombol - muncul saat hover -->
                                    <button onclick="openModal({{ $account['id'] }}, '{{ $account['nama'] }}'); event.stopPropagation();" 
                                        class="opacity-0 group-hover:opacity-100 absolute center top-1/2 -translate-y-1/2 flex items-center justify-center transition-opacity duration-200">
                                        <img src="/images/pemulihan.svg" alt="Pulihkan" class="w-5 h-5" />
                                    </button>
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
                </div>

                <!-- Pagination -->
                <div class="flex justify-between items-center px-6 py-4 border-t border-gray-200">
                    <span class="text-sm text-gray-600">
                        Halaman 1 dari {{ count($suspendedAccounts ?? []) }}
                    </span>
                    <div class="flex items-center gap-1">
                        <button class="w-8 h-8 flex items-center justify-center text-sm font-medium text-white bg-teal-600 rounded hover:bg-teal-700">1</button>
                        <button class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">2</button>
                        <button class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">3</button>
                        <button class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">...</button>
                        <button class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">10</button>
                        <button class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">→</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Popup -->
    <div id="restoreModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-2xl p-8 max-w-md w-mx mx-4 text-center shadow-2xl">
            
            <!-- Title -->
            <h3 class="text-xl font-semibold text-gray-800 mb-6">Pemulihan Akun</h3>

            <!-- Icon -->
            <div class="mb-6">
                <div class="w-20 h-20 mx-auto rounded-full flex items-center justify-center">
                    <img src="/images/iconpersonrestore.svg" alt="Sukses" class="w-15 h-15 text-green-600" />
                </div>
            </div>
            
            <!-- Message -->
            <p class="text-gray-600 mb-8" id="modalMessage">Apakah anda yakin ingin memulihkan akun tersebut?</p>
            
            <!-- Buttons -->
            <div class="flex gap-4 justify-center">
                <button onclick="closeModal()" 
                        class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors font-medium">
                    Batal
                </button>
                <button onclick="confirmRestore()" 
                        id="restoreButton"
                        class="px-6 py-2 bg-[#3FC1C0] text-white rounded-lg hover:bg-[#3AB3B2] transition-colors font-medium">
                    Pulihkan
                </button>
            </div>
        </div>
    </div>

    @section('scripts')
    <script>
    let currentUserId = null;
    let currentUserName = null;

    // CSRF Token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Fungsi untuk navigasi ke halaman detail
    function navigateToDetail(id, event) {
        // Menggunakan route helper Laravel untuk konsistensi
        window.location.href = "{{ route('suspended-account.detail', ['id' => ':id']) }}".replace(':id', id);
    }

    // Fungsi untuk membuka modal konfirmasi restore
    function openModal(userId, userName) {
        currentUserId = userId;
        currentUserName = userName;
        document.getElementById('modalMessage').textContent = `Apakah anda yakin ingin memulihkan akun ${userName}?`;
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
        if (!currentUserId) return;
        
        // Show loading state
        const restoreButton = document.getElementById('restoreButton');
        const originalText = restoreButton.textContent;
        restoreButton.textContent = 'Memulihkan...';
        restoreButton.disabled = true;
        
        // AJAX request untuk memulihkan akun
        fetch("{{ route('suspended-account.restore', ['id' => ':id']) }}".replace(':id', currentUserId), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                account_id: currentUserId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`Akun ${currentUserName} berhasil dipulihkan!`);
                closeModal();
                
                // Refresh halaman untuk update data
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                alert('Gagal memulihkan akun: ' + (data.message || 'Terjadi kesalahan'));
                
                // Reset button state
                restoreButton.textContent = originalText;
                restoreButton.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memulihkan akun. Silakan coba lagi.');
            
            // Reset button state
            restoreButton.textContent = originalText;
            restoreButton.disabled = false;
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
            } else {
                console.error('Search failed:', data.message);
            }
        })
        .catch(error => {
            console.error('Search error:', error);
        });
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
                <tr class="border-b border-gray-100 hover:bg-gray-50 group cursor-pointer" 
                    onclick="navigateToDetail(${account.id}, event)">
                    <td class="px-6 py-4 text-sm text-gray-700">${account.id}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${account.nama}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">${account.kelamin}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">${account.kota}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium ${durationClass}">
                            ${account.durasi}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 relative">
                        <span class="group-hover:opacity-0 transition-opacity duration-200">-</span>
                        <button onclick="openModal(${account.id}, '${account.nama}'); event.stopPropagation();" 
                            class="opacity-0 group-hover:opacity-100 absolute center top-1/2 -translate-y-1/2 flex items-center justify-center transition-opacity duration-200">
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
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
        
        // Prevent modal close when clicking inside modal content
        document.querySelector('#restoreModal .bg-white')?.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });

    // Auto-refresh setiap 5 menit untuk update status real-time
    setInterval(function() {
        // Hanya refresh jika tidak ada modal yang terbuka
        if (document.getElementById('restoreModal').classList.contains('hidden')) {
            // Bisa diganti dengan AJAX request untuk update data tanpa refresh halaman
            // fetchUpdatedData();
        }
    }, 300000); // 5 menit
    </script>
    @endsection

    @endsection