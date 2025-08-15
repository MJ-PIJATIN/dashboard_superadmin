@extends('layouts.terapis')
@section('navtitle', 'Terapis')
@section('content')

<!-- Add CSRF token meta tag in the head section -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="bg-gray-100 min-h-screen">
<div class="bg-gray-100 ml-[50px] pt-[56px] pb-[100px] pr-[25px] mr-[34px]">

    <!-- Terapis Section -->
    <div>
        <div class="flex justify-between items-center mb-4 mt-10">
            <h2 class="text-xl font-bold text-gray-700">Data Terapis</h2>
            <a href="{{ route('tambah-terapis') }}" id="open-additional-service-btn" class="font-semibold bg-blue-500 text-white px-2 py-2 rounded-lg hover:bg-blue-600 transition-colors flex items-center text-sm">
                <img src="{{ asset('images/add.svg') }}" alt="Add" class="w-4 h-4 mr-2">
                Tambah Data Baru    
            </a>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-4 mt-2 border border-gray-200">
            <!-- Search Form -->
            <form method="GET" action="{{ route('terapis') }}" class="mb-4">
                <div class="flex w-full max-w-sm">
                    <input type="text" 
                        name="search" 
                        value="{{ $search }}"
                        class="flex-grow px-2 py-2 text-sm bg-gray-100 rounded-l-md focus:outline-none"
                        placeholder="Cari nomor id, nama, kota, dll">
                    <button type="submit" class="bg-teal-600 text-white px-2.5 py-2 rounded-r-md flex items-center justify-center">
                        <svg width="16" height="16" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8 0.75C12.0041 0.75 15.25 3.99594 15.25 8C15.25 9.7319 14.6427 11.3219 13.6295 12.5688L18.5303 17.4697C18.8232 17.7626 18.8232 18.2374 18.5303 18.5303C18.2641 18.7966 17.8474 18.8208 17.5538 18.6029L17.4697 18.5303L12.5688 13.6295C11.3219 14.6427 9.7319 15.25 8 15.25C3.99594 15.25 0.75 12.0041 0.75 8C0.75 3.99594 3.99594 0.75 8 0.75ZM8 2.25C4.82436 2.25 2.25 4.82436 2.25 8C2.25 11.1756 4.82436 13.75 8 13.75C11.1756 13.75 13.75 11.1756 13.75 8C13.75 4.82436 11.1756 2.25 8 2.25Z"
                                fill="white" />
                        </svg>
                    </button>
                </div>
            </form>

            <div class="overflow-x-auto bg-white">
                <table class="w-full">
                    <thead class="bg-white border-b border-gray-300">
                        <tr data-table-type="terapis">
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>#</span>
                                </div>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800 cursor-pointer sortable-header" data-sort="name">
                                    <span>Nama Lengkap</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5 sort-icon">
                                </div>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800 cursor-pointer sortable-header" data-sort="joining_date">
                                    <span>Tanggal Bergabung</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5 sort-icon">
                                </div>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Ponsel</span>
                                </div>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800 cursor-pointer sortable-header" data-sort="gender">
                                    <span>Jenis Kelamin</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5 sort-icon">
                                </div>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800 cursor-pointer sortable-header" data-sort="area_kerja">
                                    <span>Area Kerja</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5 sort-icon">
                                </div>
                            </th>
                            <th class="px-4 py-2 text-center text-sm font-semibold text-gray-800 w-[100px]">
                                <div class="flex items-center justify-center space-x-1 hover:text-gray-800">
                                    <span>Aksi</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse($terapis as $index => $item)
                            <tr class="hover:bg-gray-50" 
                                data-terapis-id="{{ $item->id }}" 
                                data-terapis-name="{{ $item->name }}"
                                data-terapis-joining-date="{{ $item->joining_date }}"
                                data-terapis-gender="{{ $item->formatted_gender }}"
                                data-terapis-area-kerja="{{ $item->area_kerja }}">
                                <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-600">
                                    {{ $item->id }}
                                </td>    
                                <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-600">
                                    {{ $item->name }}
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-600">
                                    {{ $item->formatted_joining_date }}
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-600">
                                    {{ $item->phone }}
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-600">
                                    {{ $item->formatted_gender }}
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-600">
                                    {{ $item->area_kerja }}
                                </td>
                                <td class="px-4 py-1 text-center">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="{{ route('detail-terapis', $item->id) }}" 
                                        class="text-blue-600 hover:text-blue-800 p-1 rounded view-terapis-button" 
                                        data-terapis-id="{{ $item->id }}"
                                        title="Lihat Detail Terapis">
                                            <img src="{{ asset('images/isi tabel.svg') }}" alt="View" class="w-4.5 h-4.5">
                                        </a>
                                        <button class="text-red-600 hover:text-red-800 p-1 rounded delete-terapis-button" 
                                                data-terapis-id="{{ $item->id }}"
                                                title="Hapus Terapis">
                                            <img src="{{ asset('images/trash can.svg') }}" alt="Hapus" class="h-4.5 w-4.5">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                    @if($search)
                                        Tidak ada data terapis yang ditemukan untuk pencarian "{{ $search }}"
                                    @else
                                        Belum ada data terapis
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- Pagination - Selalu tampil -->
                <div class="mt-6 ml-2.5 flex justify-between items-center text-sm">
                    <span class="text-gray-500">
                        @if($terapis->hasPages())
                            Halaman {{ $terapis->currentPage() }} dari {{ $terapis->lastPage() }}
                        @else
                            Halaman 1 dari 1
                        @endif
                    </span>
                    <div class="flex space-x-1">
                        {{-- Previous Page Link --}}
                        @if ($terapis->onFirstPage())
                            <span class="px-3 py-1 rounded border bg-gray-200 text-gray-500 cursor-not-allowed">&lt;</span>
                        @else
                            <a href="{{ $terapis->previousPageUrl() }}" class="px-3 py-1 rounded border hover:bg-gray-100">&lt;</a>
                        @endif

                        {{-- Pagination Elements --}}
                        @if($terapis->hasPages())
                            @foreach ($terapis->getUrlRange(1, $terapis->lastPage()) as $page => $url)
                                @if ($page == $terapis->currentPage())
                                    <span class="px-3 py-1 rounded border bg-[#2A9D8F] text-white">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-3 py-1 rounded border hover:bg-gray-100">{{ $page }}</a>
                                @endif
                            @endforeach
                        @else
                            {{-- Tampilkan halaman 1 saja jika tidak ada pagination --}}
                            <span class="px-3 py-1 rounded border bg-[#2A9D8F] text-white">1</span>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($terapis->hasMorePages())
                            <a href="{{ $terapis->nextPageUrl() }}" class="px-3 py-1 rounded border hover:bg-gray-100">&gt;</a>
                        @else
                            <span class="px-3 py-1 rounded border bg-gray-200 text-gray-500 cursor-not-allowed">&gt;</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Drawer -->
    <div id="delete-terapis-drawer" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
        <div id="delete-terapis-drawer-overlay" class="flex items-center justify-center h-full">
            <div id="delete-terapis-drawer-content" class="bg-white rounded-lg shadow-lg" style="width: 400px; padding: 24px; min-height: 280px;">
                <div class="flex flex-col items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Hapus Data Terapis</h2>
                    <img src="{{ asset('images/trash can.svg') }}" alt="Hapus" class="h-20 w-20 mb-4"/>
                </div>
                <p class="text-gray-600 text-center mb-6">
                    Apakah anda yakin ingin menghapus data terapis "<span id="delete-terapis-name"></span>"?
                </p>
                <div class="flex justify-center space-x-12">
                    <button id="delete-terapis-confirm" class="text-white px-6 py-2 rounded-lg hover:opacity-90 transition-colors" style="background-color: #469D89;">Hapus</button>
                    <button id="delete-terapis-cancel" class="bg-red-500 text-white px-7 py-2 rounded-lg hover:bg-red-600 transition-colors">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Spinner Drawer -->
    <div id="loading-terapis-drawer" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center h-full">
            <div class="bg-white rounded-lg shadow-lg" style="width: 400px; padding: 70.5px;">
                <div class="flex flex-col items-center mb-4">
                    <img src="{{ asset('images/loading.svg') }}" alt="Loading" class="h-30 w-30 animate-spin" />
                </div>
            </div>
        </div>
    </div>

    <!-- Success Drawer -->
    <div id="success-terapis-drawer" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
        <div id="success-terapis-drawer-overlay" class="flex items-center justify-center h-full">
            <div id="success-terapis-drawer-content" class="bg-white rounded-lg shadow-lg" style="width: 400px; padding: 24px; min-height: 280px;">
                <div class="flex flex-col items-center mb-4">
                    <h2 class="text-2xl font-bold mb-6" style="color: #469D89;">Berhasil!</h2>
                    <img src="{{ asset('images/succed.svg') }}" alt="Success" class="h-30 w-30">
                </div>
            </div>
        </div>
    </div>

    <!-- Error Drawer -->
    <div id="error-terapis-drawer" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
        <div id="error-terapis-drawer-overlay" class="flex items-center justify-center h-full">
            <div id="error-terapis-drawer-content" class="bg-white rounded-lg shadow-lg" style="width: 400px; padding: 24px; min-height: 280px;">
                <div class="flex flex-col items-center mb-4">
                    <h2 class="text-2xl font-bold mb-6 text-red-500">Error!</h2>
                    <div class="text-center">
                        <p id="error-message" class="text-gray-600 mb-4"></p>
                        <button id="error-close-btn" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<style>
.sort-icon {
    opacity: 0.5;
    transition: all 0.3s ease-in-out;
}

.sortable-header:hover .sort-icon {
    opacity: 0.8;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Global variables
    let currentDeleteTerapisRow = null;
    let successTerapisTimeout = null;
    let sortStates = {
        terapis: {
            name: 'none',
            joining_date: 'none',
            gender: 'none',
            area_kerja: 'none'
        }
    };

    // Modal management functions
    const modalTerapisManager = {
        show(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) modal.classList.remove('hidden');
        },

        hide(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) modal.classList.add('hidden');
        },

        showSuccess() {
            this.show('success-terapis-drawer');
            successTerapisTimeout = setTimeout(() => {
                this.hide('success-terapis-drawer');
                // Refresh the page after success
                window.location.reload();
            }, 1000);
        },

        showError(message) {
            const errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.textContent = message;
            }
            this.show('error-terapis-drawer');
        },

        hideSuccess() {
            this.hide('success-terapis-drawer');
            if (successTerapisTimeout) {
                clearTimeout(successTerapisTimeout);
                successTerapisTimeout = null;
            }
        }
    };

    // Sorting functions
    function sortTerapisTable(column, tbody, tableType) {
        const rows = Array.from(tbody.querySelectorAll('tr')).filter(row => 
            !row.querySelector('td[colspan]') // Exclude empty state row
        );
        let sortDirection = 'asc';
        
        // Reset other sort states for current table
        Object.keys(sortStates[tableType]).forEach(key => {
            if (key !== column) sortStates[tableType][key] = 'none';
        });
        
        // Determine sort direction
        if (sortStates[tableType][column] === 'none' || sortStates[tableType][column] === 'desc') {
            sortStates[tableType][column] = 'asc';
            sortDirection = 'asc';
        } else {
            sortStates[tableType][column] = 'desc';
            sortDirection = 'desc';
        }

        rows.sort((a, b) => {
            let aValue, bValue;
            
            switch(column) {
                case 'name':
                    aValue = a.getAttribute('data-terapis-name')?.toLowerCase() || '';
                    bValue = b.getAttribute('data-terapis-name')?.toLowerCase() || '';
                    break;
                case 'joining_date':
                    // Convert date to comparable format (assuming format is DD/MM/YYYY or YYYY-MM-DD)
                    const aDate = a.getAttribute('data-terapis-joining-date') || '';
                    const bDate = b.getAttribute('data-terapis-joining-date') || '';
                    aValue = new Date(aDate);
                    bValue = new Date(bDate);
                    break;
                case 'gender':
                    aValue = a.getAttribute('data-terapis-gender')?.toLowerCase() || '';
                    bValue = b.getAttribute('data-terapis-gender')?.toLowerCase() || '';
                    break;
                case 'area_kerja':
                    aValue = a.getAttribute('data-terapis-area-kerja')?.toLowerCase() || '';
                    bValue = b.getAttribute('data-terapis-area-kerja')?.toLowerCase() || '';
                    break;
                default:
                    return 0;
            }
            
            if (column === 'joining_date') {
                // Date comparison
                if (sortDirection === 'asc') {
                    return aValue - bValue;
                } else {
                    return bValue - aValue;
                }
            } else {
                // String comparison
                if (sortDirection === 'asc') {
                    return aValue.localeCompare(bValue, 'id', { sensitivity: 'base' });
                } else {
                    return bValue.localeCompare(aValue, 'id', { sensitivity: 'base' });
                }
            }
        });

        // Clear tbody and append sorted rows with animation
        const emptyRow = tbody.querySelector('tr td[colspan]')?.closest('tr');
        tbody.innerHTML = '';
        
        // Add back empty row if it exists
        if (emptyRow && rows.length === 0) {
            tbody.appendChild(emptyRow);
        } else {
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(-10px)';
                tbody.appendChild(row);
                
                setTimeout(() => {
                    row.style.transition = 'all 0.2s ease-in-out';
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 30);
            });
        }

        // Update sort icons for current table
        updateTerapisSortIcons(tableType);
    }

    function updateTerapisSortIcons(tableType) {
        // Reset all sort icons for current table
        const sortIcons = document.querySelectorAll(`[data-table-type="${tableType}"] .sort-icon`);
        sortIcons.forEach(icon => {
            icon.style.transform = 'rotate(0deg)';
            icon.style.opacity = '0.5';
        });

        // Update active sort icon for current table
        Object.keys(sortStates[tableType]).forEach(column => {
            if (sortStates[tableType][column] !== 'none') {
                const icon = document.querySelector(`[data-table-type="${tableType}"] [data-sort="${column}"] .sort-icon`);
                if (icon) {
                    icon.style.opacity = '1';
                    if (sortStates[tableType][column] === 'desc') {
                        icon.style.transform = 'rotate(180deg)';
                    }
                }
            }
        });
    }

    // Initialize sorting functionality
    function initializeTerapisSorting() {
        const tbody = document.querySelector('tbody.bg-white');
        
        if (tbody) {
            const table = tbody.closest('table');
            const headerRow = table.querySelector('thead tr');
            
            if (headerRow) {
                const sortableHeaders = headerRow.querySelectorAll('.sortable-header');
                
                sortableHeaders.forEach(header => {
                    const sortColumn = header.getAttribute('data-sort');
                    if (sortColumn) {
                        header.addEventListener('click', (e) => {
                            e.preventDefault();
                            sortTerapisTable(sortColumn, tbody, 'terapis');
                        });
                    }
                });
            }
        }

        // Initialize sort icon styles
        updateTerapisSortIcons('terapis');
    }

    // Delete management functions
    const deleteTerapisManager = {
        openDialog(button) {
            currentDeleteTerapisRow = button.closest('tr');
            const terapisName = currentDeleteTerapisRow ? currentDeleteTerapisRow.getAttribute('data-terapis-name') : '';
            const deleteTerapisName = document.getElementById('delete-terapis-name');
            
            if (deleteTerapisName) deleteTerapisName.textContent = terapisName;
            modalTerapisManager.show('delete-terapis-drawer');
        },

        async confirmDelete() {
            if (currentDeleteTerapisRow) {
                const terapisId = currentDeleteTerapisRow.getAttribute('data-terapis-id');
                
                console.log('Attempting to delete therapist with ID:', terapisId);
                
                modalTerapisManager.hide('delete-terapis-drawer');
                modalTerapisManager.show('loading-terapis-drawer');

                try {
                    const response = await fetch('/terapis/delete', {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ id: terapisId })
                    });

                    console.log('Response status:', response.status);
                    console.log('Response ok:', response.ok);

                    let result;
                    const responseText = await response.text();
                    console.log('Raw response:', responseText);

                    try {
                        result = JSON.parse(responseText);
                        console.log('Parsed result:', result);
                    } catch (parseError) {
                        console.error('JSON parse error:', parseError);
                        throw new Error('Server returned invalid JSON response');
                    }

                    setTimeout(() => {
                        modalTerapisManager.hide('loading-terapis-drawer');
                        
                        if (response.ok && result && result.success === true) {
                            console.log('Delete successful');
                            // Remove row with animation
                            currentDeleteTerapisRow.style.transition = 'all 0.3s ease-in-out';
                            currentDeleteTerapisRow.style.opacity = '0';
                            currentDeleteTerapisRow.style.transform = 'translateX(100px)';
                            
                            setTimeout(() => {
                                currentDeleteTerapisRow.remove();
                            }, 300);
                            
                            modalTerapisManager.showSuccess();
                        } else {
                            console.log('Delete failed or success not true:', result);
                            modalTerapisManager.showError(result?.message || 'Terjadi kesalahan saat menghapus data');
                        }
                        
                        currentDeleteTerapisRow = null;
                    }, 1000);

                } catch (error) {
                    console.error('Error during delete operation:', error);
                    setTimeout(() => {
                        modalTerapisManager.hide('loading-terapis-drawer');
                        modalTerapisManager.showError('Terjadi kesalahan saat menghapus data: ' + error.message);
                        currentDeleteTerapisRow = null;
                    }, 1000);
                }
            }
        },

        cancel() {
            modalTerapisManager.hide('delete-terapis-drawer');
            currentDeleteTerapisRow = null;
        }
    };

    // Event listeners setup
    function setupTerapisEventListeners() {
        // Delete buttons (using event delegation)
        document.addEventListener('click', function(e) {
            const deleteTerapisButton = e.target.closest('.delete-terapis-button');
            if (deleteTerapisButton) {
                e.preventDefault();
                e.stopPropagation();
                console.log('Delete button clicked for ID:', deleteTerapisButton.getAttribute('data-terapis-id'));
                deleteTerapisManager.openDialog(deleteTerapisButton);
            }
        });

        // Delete modal buttons
        const deleteTerapisCancel = document.getElementById('delete-terapis-cancel');
        const deleteTerapisConfirm = document.getElementById('delete-terapis-confirm');
        
        if (deleteTerapisCancel) {
            deleteTerapisCancel.addEventListener('click', (e) => {
                e.preventDefault();
                deleteTerapisManager.cancel();
            });
        }
        
        if (deleteTerapisConfirm) {
            deleteTerapisConfirm.addEventListener('click', (e) => {
                e.preventDefault();
                deleteTerapisManager.confirmDelete();
            });
        }

        // Error close button
        const errorCloseBtn = document.getElementById('error-close-btn');
        if (errorCloseBtn) {
            errorCloseBtn.addEventListener('click', () => {
                modalTerapisManager.hide('error-terapis-drawer');
            });
        }

        // Modal overlay clicks
        const terapisOverlays = ['delete-terapis-drawer-overlay', 'success-terapis-drawer-overlay', 'error-terapis-drawer-overlay'];
        terapisOverlays.forEach(overlayId => {
            const overlay = document.getElementById(overlayId);
            if (overlay) {
                overlay.addEventListener('click', function(e) {
                    if (e.target === this) {
                        const drawerId = overlayId.replace('-overlay', '');
                        modalTerapisManager.hide(drawerId);
                        if (drawerId === 'delete-terapis-drawer') currentDeleteTerapisRow = null;
                        if (drawerId === 'success-terapis-drawer') modalTerapisManager.hideSuccess();
                    }
                });
            }
        });

        // Prevent modal content clicks from closing modals
        const terapisModalContents = ['delete-terapis-drawer-content', 'success-terapis-drawer-content', 'error-terapis-drawer-content'];
        terapisModalContents.forEach(contentId => {
            const content = document.getElementById(contentId);
            if (content) {
                content.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
        });

        // Keyboard events
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                modalTerapisManager.hide('delete-terapis-drawer');
                modalTerapisManager.hide('loading-terapis-drawer');
                modalTerapisManager.hide('error-terapis-drawer');
                modalTerapisManager.hideSuccess();
                
                currentDeleteTerapisRow = null;
            }
        });
    }

    // Initialize
    function initTerapis() {
        setupTerapisEventListeners();
        initializeTerapisSorting();
        console.log('Terapis functionality initialized with sorting');
    }
    
    initTerapis();
});
</script>
@endsection