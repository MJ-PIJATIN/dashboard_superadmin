@extends('layouts.app')
@section('navtitle', 'Terapis')
@section('content')

<div class="bg-gray-100 min-h-screen">
<div class="max-w-screen-xl bg-gray-100 ml-[50px] pt-[70px] pb-[100px] pr-[25px]">

    <!-- Terapis Section -->
    <div>
        <div class="flex justify-between items-center mb-4 mt-10">
            <h2 class="text-xl font-semibold text-gray-900">Data Terapis</h2>
            <a href="{{ route('tambah-terapis') }}" id="open-additional-service-btn" class="bg-blue-500 text-white px-2 py-2 rounded-lg hover:bg-blue-600 transition-colors flex items-center text-sm">
                <img src="{{ asset('images/add.svg') }}" alt="Add" class="w-4 h-4 mr-2">
                Tambah Data Baru    
            </a>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-4 mt-2 border border-gray-200">
            <div class="overflow-x-auto bg-white">
                <table class="w-full">
                    <thead class="bg-white border-b border-gray-300">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>#</span>
                                </div>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Nama Lengkap</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </div>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Tanggal Bergabung</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </div>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Ponsel</span>
                                </div>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Jenis Kelamin</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </div>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Area Kerja</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </div>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800 ml-12">
                                    <span>Aksi</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @php
                        $terapis = [
                            ['id' => 1, 'nama' => 'Karsa Wijaya', 'tanggal' => '02 Maret 2023', 'ponsel' => '084354818515', 'jenis_kelamin' => 'Laki-laki', 'area' => 'Bandung'],
                            ['id' => 2, 'nama' => 'Karsa Ani Nasyiah', 'tanggal' => '17 Mei 2023', 'ponsel' => '081815874520', 'jenis_kelamin' => 'Perempuan', 'area' => 'Sleman'],
                            ['id' => 3, 'nama' => 'Marwata Saefullah', 'tanggal' => '07 Jul 2023', 'ponsel' => '082321092200', 'jenis_kelamin' => 'Perempuan', 'area' => 'Bantul'],
                            ['id' => 4, 'nama' => 'Harjaya Januar', 'tanggal' => '03 Jul 2023', 'ponsel' => '086363677404', 'jenis_kelamin' => 'Laki-Laki', 'area' => 'Kudus'],
                            ['id' => 5, 'nama' => 'Ayu Usada', 'tanggal' => '03 Feb 2023', 'ponsel' => '083065887869', 'jenis_kelamin' => 'Perempuan', 'area' => 'Batang'],
                            ['id' => 6, 'nama' => 'Chandra Utama', 'tanggal' => '14 Jan 2023', 'ponsel' => '089911792890', 'jenis_kelamin' => 'Laki-Laki', 'area' => 'Pekalongan'],
                            ['id' => 7, 'nama' => 'Uda Lazuardi', 'tanggal' => '23 Feb 2023', 'ponsel' => '082959100395', 'jenis_kelamin' => 'Laki-Laki', 'area' => 'Bandung'],
                            ['id' => 8, 'nama' => 'Galar Pradipta', 'tanggal' => '23 Mei 2023', 'ponsel' => '086926051809', 'jenis_kelamin' => 'Laki-Laki', 'area' => 'Gunung Kidul'],
                            ['id' => 9, 'nama' => 'Kamaria Mandasari', 'tanggal' => '30 Nov 2022', 'ponsel' => '082242647638', 'jenis_kelamin' => 'Perempuan', 'area' => 'Surakarta'],
                            ['id' => 10, 'nama' => 'Yance Widiastuti', 'tanggal' => '17 Sep 2022', 'ponsel' => '081107010437', 'jenis_kelamin' => 'Perempuan', 'area' => 'Kulon Progo'],
                        ];
                        @endphp
                        @foreach($terapis as $terapis)
                            <tr class="hover:bg-gray-50" data-terapis-id="{{ $terapis['id'] }}" data-terapis-name="{{ $terapis['nama'] }}" data-terapis-date="{{ $terapis['tanggal'] }}" data-terapis-phone="{{ $terapis['ponsel'] }}" data-terapis-gender="{{ $terapis['jenis_kelamin'] }}" data-terapis-area="{{ $terapis['area'] }}">
                            <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-600">{{ $terapis['id'] }}</td>    
                            <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-600">{{ $terapis['nama'] }}</td>
                            <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-600">{{ $terapis['tanggal'] }}</td>
                            <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-600">{{ $terapis['ponsel'] }}</td>
                            <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-600">{{ $terapis['jenis_kelamin'] }}</td>
                            <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-600">{{ $terapis['area'] }}</td>
                                <td class="px-4 py-1 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('detail-terapis') }}" class="text-blue-600 hover:text-blue-800 p-1 rounded edit-terapis-button" data-terapis-id="{{ $terapis['id'] }}">
                                            <img src="{{ asset('images/isi tabel.svg') }}" alt="Edit" class="w-4.5 h-4.5">
                                        </a>
                                        <button class="text-red-600 hover:text-red-800 p-1 rounded delete-terapis-button" data-terapis-id="{{ $terapis['id'] }}">
                                            <img src="{{ asset('images/trash can.svg') }}" alt="Hapus" class="h-4.5 w-4.5">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <div class="flex items-center justify-between">
                        <div class="flex w-full max-w-sm mb-7">
                            <input type="text"
                                class="flex-grow px-2 py-2 text-sm bg-gray-100 rounded-l-md focus:outline-none"
                                placeholder="Cari nomor id, nama, kota, dll">
                            <button class="bg-teal-600 text-white px-2.5 py-2 rounded-r-md flex items-center justify-center">
                                <svg width="16" height="16" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8 0.75C12.0041 0.75 15.25 3.99594 15.25 8C15.25 9.7319 14.6427 11.3219 13.6295 12.5688L18.5303 17.4697C18.8232 17.7626 18.8232 18.2374 18.5303 18.5303C18.2641 18.7966 17.8474 18.8208 17.5538 18.6029L17.4697 18.5303L12.5688 13.6295C11.3219 14.6427 9.7319 15.25 8 15.25C3.99594 15.25 0.75 12.0041 0.75 8C0.75 3.99594 3.99594 0.75 8 0.75ZM8 2.25C4.82436 2.25 2.25 4.82436 2.25 8C2.25 11.1756 4.82436 13.75 8 13.75C11.1756 13.75 13.75 11.1756 13.75 8C13.75 4.82436 11.1756 2.25 8 2.25Z"
                                        fill="white" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </table>
                <div class="mt-6 ml-2.5 flex justify-between items-center text-sm">
                    <span class="text-gray-500">Halaman 1 dari 41</span>
                    <div class="flex space-x-1">
                        <button class="px-3 py-1 rounded border bg-[#2A9D8F] text-white">1</button>
                        <button class="px-3 py-1 rounded border">2</button>
                        <button class="px-3 py-1 rounded border">3</button>
                        <button class="px-3 py-1 rounded border">...</button>
                        <button class="px-3 py-1 rounded border">41</button>
                        <button class="px-3 py-1 rounded border">&gt;</button>
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

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Global variables
    let currentDeleteTerapisRow = null;
    let successTerapisTimeout = null;

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
            }, 1000);
        },

        hideSuccess() {
            this.hide('success-terapis-drawer');
            if (successTerapisTimeout) {
                clearTimeout(successTerapisTimeout);
                successTerapisTimeout = null;
            }
        }
    };

    // Delete management functions
    const deleteTerapisManager = {
        openDialog(button) {
            currentDeleteTerapisRow = button.closest('tr');
            const terapisName = currentDeleteTerapisRow ? currentDeleteTerapisRow.getAttribute('data-terapis-name') : '';
            const deleteTerapisName = document.getElementById('delete-terapis-name');
            
            if (deleteTerapisName) deleteTerapisName.textContent = terapisName;
            modalTerapisManager.show('delete-terapis-drawer');
        },

        confirmDelete() {
            if (currentDeleteTerapisRow) {
                currentDeleteTerapisRow.remove();
                currentDeleteTerapisRow = null;

                modalTerapisManager.hide('delete-terapis-drawer');
                modalTerapisManager.show('loading-terapis-drawer');

                setTimeout(() => {
                    modalTerapisManager.hide('loading-terapis-drawer');
                    modalTerapisManager.showSuccess();
                }, 1000);
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

        // Modal overlay clicks
        const terapisOverlays = ['delete-terapis-drawer-overlay', 'success-terapis-drawer-overlay'];
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
        const terapisModalContents = ['delete-terapis-drawer-content', 'success-terapis-drawer-content'];
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
                modalTerapisManager.hideSuccess();
                
                currentDeleteTerapisRow = null;
            }
        });
    }

    // Initialize
    function initTerapis() {
        setupTerapisEventListeners();
    }
    
    initTerapis();
});
</script>
@endsection