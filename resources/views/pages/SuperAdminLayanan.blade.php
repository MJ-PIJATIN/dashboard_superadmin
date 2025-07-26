@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Ringkasan statistik dan aktivitas terkini sistem Pijat.in')
@section('navtitle', 'Manajemen Layanan')
@section('content')
<div class="max-w-screen-xl" style="margin-left: 290px; padding-top: 100px; padding-bottom: 100px; padding-right: 22px;">

    <!-- Layanan Utama Section -->
    <div class="mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-900">Daftar Layanan Utama</h2>
            <button id="open-drawer-btn" class="bg-blue-500 text-white px-2 py-2 rounded-lg hover:bg-blue-600 transition-colors flex items-center text-sm">
                <div class="flex justify-center">
                    <img src="{{ asset('images/add.svg') }}" alt="Logo" class="h-4.5 w-4.5 mr-2">
                </div>
                Buat Layanan Utama
            </button>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-4 mt-2">
            <div class="overflow-x-auto bg-white">
                <table class="w-full">
                    <thead class="bg-white border-b border-gray-300">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-800">
                                <button class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Nama</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </button>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-800">
                                <button class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Harga</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </button>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-800">
                                <button class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Durasi</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </button>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-800">Deskripsi</th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-800">Status</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @php
                            $layananUtama = [
                                ['id' => 1, 'nama' => 'Full Body Massage', 'harga' => 150000, 'durasi' => 60, 'deskripsi' => 'Full body massage atau pijat di seluruh bagian tubuh, mul...', 'status' => 'Aktif'],
                                ['id' => 2, 'nama' => 'Hot Stone Massage', 'harga' => 200000, 'durasi' => 120, 'deskripsi' => 'Full body massage atau pijat di seluruh bagian tubuh, mul...', 'status' => 'Aktif'],
                                ['id' => 3, 'nama' => 'Thai Massage', 'harga' => 165000, 'durasi' => 60, 'deskripsi' => 'Full body massage atau pijat di seluruh bagian tubuh, mul...', 'status' => 'Aktif'],
                                ['id' => 4, 'nama' => 'Deep Tissue Massage', 'harga' => 140000, 'durasi' => 90, 'deskripsi' => 'Full body massage atau pijat di seluruh bagian tubuh, mul...', 'status' => 'Aktif'],
                                ['id' => 5, 'nama' => 'Swedish Massage', 'harga' => 170000, 'durasi' => 90, 'deskripsi' => 'Full body massage atau pijat di seluruh bagian tubuh, mul...', 'status' => 'Aktif'],
                                ['id' => 6, 'nama' => 'Traditional Massage', 'harga' => 145000, 'durasi' => 60, 'deskripsi' => 'Full body massage atau pijat di seluruh bagian tubuh, mul...', 'status' => 'Aktif'],
                            ];
                        @endphp
                        @foreach($layananUtama as $layanan)
                            <tr class="hover:bg-gray-50" data-service-id="{{ $layanan['id'] }}" data-service-name="{{ $layanan['nama'] }}" data-service-price="{{ $layanan['harga'] }}" data-service-duration="{{ $layanan['durasi'] }}" data-service-description="{{ $layanan['deskripsi'] }}">
                                <td class="px-4 py-1 whitespace-nowrap text-sm text-gray-600 font-medium">{{ $layanan['nama'] }}</td>
                                <td class="px-4 py-1 text-sm text-gray-600">{{ number_format($layanan['harga'], 0, ',', '.') }}</td>
                                <td class="px-4 py-1 text-sm text-gray-600 flex items-center">
                                    <img src="{{ asset('images/clock.svg') }}" alt="Clock" class="h-6.5 w-6.5 mr-2">
                                    {{ $layanan['durasi'] }} Menit
                                </td>
                                <td class="px-4 py-1 text-sm text-gray-600">{{ $layanan['deskripsi'] }}</td>
                                <td class="px-4 py-1">
                                    <button class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium status-button" 
                                            style="background-color: #E5F9F9; color: #3FC1C0;"
                                            data-service-id="{{ $layanan['id'] }}" data-current-status="{{ $layanan['status'] }}">
                                        <div class="w-2 h-2" style="background-color: #3FC1C0; border-radius: 9999px; margin-right: 0.375rem;"></div>
                                        <span class="status-text">{{ $layanan['status'] }}</span>
                                    </button>
                                </td>
                                <td class="px-4 py-1 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800 p-1 rounded edit-main-service-button" data-service-id="{{ $layanan['id'] }}">
                                            <img src="{{ asset('images/pencil.svg') }}" alt="Edit" class="h-6 w-6">
                                        </button>
                                        <button class="text-red-600 hover:text-red-800 p-1 rounded delete-button" data-service-id="{{ $layanan['id'] }}">
                                            <img src="{{ asset('images/trash can.svg') }}" alt="Hapus" class="h-6 w-6">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Layanan Tambahan Section -->
    <div>
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-900">Daftar Layanan Tambahan</h2>
            <button id="open-additional-service-btn" class="bg-blue-500 text-white px-2 py-2 rounded-lg hover:bg-blue-600 transition-colors flex items-center text-sm">
                <img src="{{ asset('images/add.svg') }}" alt="Add" class="h-4.5 w-4.5 mr-2">
                Buat Layanan Tambahan
            </button>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-4 mt-2">
            <div class="overflow-x-auto bg-white">
                <table class="w-full">
                    <thead class="bg-white border-b border-gray-300">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-800">
                                <button class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Nama</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </button>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-800">
                                <button class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Harga</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </button>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-800">
                                <button class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Durasi</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </button>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-800">Deskripsi</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @php
                            $layananTambahan = [
                                ['id' => 7, 'nama' => 'Kerokan', 'harga' => 50000, 'durasi' => 30, 'deskripsi' => 'Pengalaman kerokan unik yang menghilangkan kulit mati, merangsan...'],
                                ['id' => 8, 'nama' => 'Lulur', 'harga' => 70000, 'durasi' => 30, 'deskripsi' => 'Pelembab alami dan pijatan lembut dalam layanan lulur kami memb...'],
                                ['id' => 9, 'nama' => 'Totok Wajah', 'harga' => 80000, 'durasi' => 30, 'deskripsi' => 'Teknik totok wajah tradisional dan bahan alami berkualitas tinggi mer...'],
                                ['id' => 10, 'nama' => 'Refleksi', 'harga' => 50000, 'durasi' => 20, 'deskripsi' => 'Melibatkan pijatan dan tekanan lembut di seluruh tubuh, membantu...'],
                            ];
                        @endphp
                        @foreach($layananTambahan as $layanan)
                            <tr class="hover:bg-gray-50" data-service-id="{{ $layanan['id'] }}" data-service-name="{{ $layanan['nama'] }}" data-service-price="{{ $layanan['harga'] }}" data-service-duration="{{ $layanan['durasi'] }}" data-service-description="{{ $layanan['deskripsi'] }}">
                                <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-600">{{ $layanan['nama'] }}</td>
                                <td class="px-4 py-1 text-sm text-gray-600">{{ number_format($layanan['harga'], 0, ',', '.') }}</td>
                                <td class="px-4 py-1 text-sm text-gray-600 flex items-center">
                                    <img src="{{ asset('images/clock.svg') }}" alt="Clock" class="h-6.5 w-6.5 mr-2">
                                    {{ $layanan['durasi'] }} Menit
                                </td>
                                <td class="px-4 py-1 text-sm text-gray-600">{{ $layanan['deskripsi'] }}</td>
                                <td class="px-4 py-1 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800 p-1 rounded edit-additional-service-button" data-service-id="{{ $layanan['id'] }}">
                                            <img src="{{ asset('images/pencil.svg') }}" alt="Edit" class="h-6 w-6">
                                        </button>
                                        <button class="text-red-600 hover:text-red-800 p-1 rounded delete-button" data-service-id="{{ $layanan['id'] }}">
                                            <img src="{{ asset('images/trash can.svg') }}" alt="Hapus" class="h-6 w-6">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50"></div>

    <!-- Buat Layanan Utama Drawer -->
    <div id="drawer-main-service" class="fixed top-1/2 left-1/2 z-50 w-full max-w-md bg-white rounded-lg shadow-xl transform -translate-x-1/2 -translate-y-1/2 transition-all duration-300 ease-in-out opacity-0 scale-95 pointer-events-none">
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Buat Layanan Utama</h2>
            <button id="close-drawer-btn" class="text-gray-500 hover:text-gray-700 text-2xl font-light">&times;</button>
        </div>
            
        <form method="POST" action="#" class="p-4 space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Layanan</label>
                <input type="text" name="name" id="name" maxlength="50"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm"
                    placeholder="Maks. 50 karakter" required>
            </div>
                
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Harga Layanan</label>
                <input type="text" name="price" id="price"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm"
                    placeholder="Rp. Masukkan nominal tanpa titik" required>
            </div>
                
            <div class="relative">
                <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Durasi Layanan</label>
                <div class="relative">
                    <select name="duration" id="duration"
                        class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm appearance-none bg-white">
                        <option value="" class="text-gray-500">Pilih Menit</option>
                        <option value="60">60 Menit</option>
                        <option value="90">90 Menit</option>
                        <option value="120">120 Menit</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg class="h-4 w-4 text-gray-500 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
                
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" id="description" maxlength="512" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm resize-none"
                    placeholder="Penulisan dibatasi hingga 512 karakter" required></textarea>
            </div>
                
            <div class="mt-4 flex justify-end">
                <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white py-2.5 px-10 rounded-md shadow-sm font-medium text-sm transition-colors duration-200">
                    Tambahkan
                </button>
            </div>
        </form>
    </div>

    <!-- Ubah Layanan Utama Drawer -->
    <div id="drawer-edit-main-service" class="fixed top-1/2 left-1/2 z-50 w-full max-w-md bg-white rounded-lg shadow-xl transform -translate-x-1/2 -translate-y-1/2 transition-all duration-300 ease-in-out opacity-0 scale-95 pointer-events-none">
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Ubah Layanan Utama</h2>
            <button id="close-edit-main-drawer-btn" class="text-gray-500 hover:text-gray-700 text-2xl font-light">&times;</button>
        </div>
            
        <form method="POST" action="#" class="p-4 space-y-4" id="edit-main-service-form">
            <div>
                <label for="edit-main-name" class="block text-sm font-medium text-gray-700 mb-2">Nama Layanan</label>
                <input type="text" name="name" id="edit-main-name" maxlength="50"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm"
                    placeholder="Maks. 50 karakter" required>
            </div>
                
            <div>
                <label for="edit-main-price" class="block text-sm font-medium text-gray-700 mb-2">Harga Layanan</label>
                <input type="text" name="price" id="edit-main-price"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm"
                    placeholder="Rp. Masukkan nominal tanpa titik" required>
            </div>
                
            <div class="relative">
                <label for="edit-main-duration" class="block text-sm font-medium text-gray-700 mb-2">Durasi Layanan</label>
                <div class="relative">
                    <select name="duration" id="edit-main-duration"
                        class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm appearance-none bg-white">
                        <option value="" class="text-gray-500">Pilih Menit</option>
                        <option value="60">60 Menit</option>
                        <option value="90">90 Menit</option>
                        <option value="120">120 Menit</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg class="h-4 w-4 text-gray-500 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
                
            <div>
                <label for="edit-main-description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" id="edit-main-description" maxlength="512" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm resize-none"
                    placeholder="Penulisan dibatasi hingga 512 karakter" required></textarea>
            </div>
                
            <div class="mt-4 flex justify-end">
                <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white py-2.5 px-10 rounded-md shadow-sm font-medium text-sm transition-colors duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- Buat Layanan Tambahan Drawer -->
    <div id="drawer-additional-service" class="fixed top-1/2 left-1/2 z-50 w-full max-w-md bg-white rounded-lg shadow-xl transform -translate-x-1/2 -translate-y-1/2 transition-all duration-300 ease-in-out opacity-0 scale-95 pointer-events-none">
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Buat Layanan Tambahan</h2>
            <button id="close-additional-drawer-btn" class="text-gray-500 hover:text-gray-700 text-2xl font-light">&times;</button>
        </div>
            
        <form method="POST" action="#" class="p-4 space-y-4">
            <div>
                <label for="additional-service-name" class="block text-sm font-medium text-gray-700 mb-2">Nama Layanan Tambahan</label>
                <input type="text" name="name" id="additional-service-name" maxlength="50"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm"
                    placeholder="Maks. 50 karakter" required>
            </div>
                
            <div>
                <label for="additional-service-price" class="block text-sm font-medium text-gray-700 mb-2">Harga Layanan Tambahan</label>
                <input type="text" name="price" id="additional-service-price"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm"
                    placeholder="Rp. Masukkan nominal tanpa titik" required>
            </div>
            
            <div class="relative">
                <label for="additional-service-duration" class="block text-sm font-medium text-gray-700 mb-2">Durasi Layanan Tambahan</label>
                <div class="relative">
                    <select name="duration" id="additional-service-duration"
                        class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm appearance-none bg-white">
                        <option value="" class="text-gray-500">Pilih Menit</option>
                        <option value="20">20 Menit</option>
                        <option value="30">30 Menit</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg class="h-4 w-4 text-gray-500 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
            
            <div>
                <label for="additional-description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat</label>
                <textarea name="description" id="additional-description" maxlength="512" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm resize-none"
                    placeholder="Penulisan dibatasi hingga 512 karakter" required></textarea>
            </div>
                
            <div class="mt-4 flex justify-end">
                <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white py-2.5 px-10 rounded-md shadow-sm font-medium text-sm transition-colors duration-200">
                    Tambahkan
                </button>
            </div>
        </form>
    </div>

    <!-- Ubah Layanan Tambahan Drawer -->
    <div id="drawer-edit-additional-service" class="fixed top-1/2 left-1/2 z-50 w-full max-w-md bg-white rounded-lg shadow-xl transform -translate-x-1/2 -translate-y-1/2 transition-all duration-300 ease-in-out opacity-0 scale-95 pointer-events-none">
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Ubah Layanan Tambahan</h2>
            <button id="close-edit-additional-drawer-btn" class="text-gray-500 hover:text-gray-700 text-2xl font-light">&times;</button>
        </div>
            
        <form method="POST" action="#" class="p-4 space-y-4" id="edit-additional-service-form">
            <div>
                <label for="edit-additional-name" class="block text-sm font-medium text-gray-700 mb-2">Nama Layanan Tambahan</label>
                <input type="text" name="name" id="edit-additional-name" maxlength="50"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm"
                    placeholder="Maks. 50 karakter" required>
            </div>
                
            <div>
                <label for="edit-additional-price" class="block text-sm font-medium text-gray-700 mb-2">Harga Layanan Tambahan</label>
                <input type="text" name="price" id="edit-additional-price"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm"
                    placeholder="Rp. Masukkan nominal tanpa titik" required>
            </div>
            
            <div class="relative">
                <label for="edit-additional-duration" class="block text-sm font-medium text-gray-700 mb-2">Durasi Layanan Tambahan</label>
                <div class="relative">
                    <select name="duration" id="edit-additional-duration"
                        class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm appearance-none bg-white">
                        <option value="" class="text-gray-500">Pilih Menit</option>
                        <option value="20">20 Menit</option>
                        <option value="30">30 Menit</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg class="h-4 w-4 text-gray-500 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
            
            <div>
                <label for="edit-additional-description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat</label>
                <textarea name="description" id="edit-additional-description" maxlength="512" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm resize-none"
                    placeholder="Penulisan dibatasi hingga 512 karakter" required></textarea>
            </div>
                
            <div class="mt-4 flex justify-end">
                <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white py-2.5 px-10 rounded-md shadow-sm font-medium text-sm transition-colors duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- Status Change Drawer -->
    <div id="status-drawer" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
        <div id="status-drawer-overlay" class="flex items-center justify-center h-full">
            <div id="status-drawer-content" class="bg-white rounded-lg shadow-lg" style="width: 600px; padding: 24px;">
                <div class="flex flex-col items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-800 text-center">Peringatan Sistem</h2>
                </div>
                <div class="flex items-start bg-orange-100 p-4 rounded">
                    <img src="{{ asset('images/warning.svg') }}" alt="Peringatan" class="h-23 w-23 mr-4" />
                    <p id="status-warning-text" class="text-gray-600 text-left">
                        Jika anda <strong>menonaktifkan</strong> layanan utama tersebut, maka layanan tersebut tidak akan ditampilkan oleh sistem pada bagian Pemesanan (Pelanggan).
                    </p>
                </div>
                <div class="flex items-center justify-center mt-4">
                    <input type="checkbox" id="notify-users" class="mr-2" />
                    <label for="notify-users" class="text-sm text-gray-700">Beritahu Pengguna</label>
                </div>
                <div class="mt-6 flex justify-center space-x-14">
                    <button id="status-cancel" class="bg-red-500 text-white px-11 py-2 rounded hover:bg-red-600">Batal</button>
                    <button id="status-confirm" class="text-white px-4 py-2 rounded hover:opacity-80" style="background-color: #3FC1C0;">
                        <span id="status-confirm-text">Nonaktifkan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Drawer -->
    <div id="delete-drawer" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
        <div id="delete-drawer-overlay" class="flex items-center justify-center h-full">
            <div id="delete-drawer-content" class="bg-white rounded-lg shadow-lg" style="width: 400px; padding: 24px; min-height: 280px;">
                <div class="flex flex-col items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Hapus Data</h2>
                    <img src="{{ asset('images/trash can.svg') }}" alt="Hapus" class="h-20 w-20 mb-4"/>
                </div>
                <p class="text-gray-600 text-center mb-6">
                    Apakah anda yakin ingin menghapus layanan "<span id="delete-service-name"></span>"?
                </p>
                <div class="flex justify-center space-x-12">
                    <button id="delete-confirm" class="text-white px-6 py-2 rounded-lg hover:opacity-90 transition-colors" style="background-color: #469D89;">Hapus</button>
                    <button id="delete-cancel" class="bg-red-500 text-white px-7 py-2 rounded-lg hover:bg-red-600 transition-colors">Batal</button>
                </div>
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
                </div>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Global variables
    let currentStatusButton = null;
    let currentDeleteRow = null;
    let successTimeout = null;
    let currentEditRow = null;

    // DOM elements
    const elements = {
        serviceDrawer: document.getElementById('drawer-main-service'),
        additionalServiceDrawer: document.getElementById('drawer-additional-service'),
        editMainServiceDrawer: document.getElementById('drawer-edit-main-service'),
        editAdditionalServiceDrawer: document.getElementById('drawer-edit-additional-service'),
        overlay: document.getElementById('overlay'),
        openMainServiceBtn: document.getElementById('open-drawer-btn'),
        closeMainServiceBtn: document.getElementById('close-drawer-btn'),
        openAdditionalServiceBtn: document.getElementById('open-additional-service-btn'),
        closeAdditionalServiceBtn: document.getElementById('close-additional-drawer-btn'),
        closeEditMainServiceBtn: document.getElementById('close-edit-main-drawer-btn'),
        closeEditAdditionalServiceBtn: document.getElementById('close-edit-additional-drawer-btn'),
        mainServicePriceInput: document.getElementById('price'),
        additionalServicePriceInput: document.getElementById('additional-service-price'),
        editMainServicePriceInput: document.getElementById('edit-main-price'),
        editAdditionalServicePriceInput: document.getElementById('edit-additional-price')
    };

    // Drawer management functions
    const drawerManager = {
        openMain() {
            if (elements.serviceDrawer) {
                elements.serviceDrawer.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
                elements.serviceDrawer.classList.add('opacity-100', 'scale-100');
            }
            this.showOverlay();
        },

        closeMain() {
            if (elements.serviceDrawer) {
                elements.serviceDrawer.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                elements.serviceDrawer.classList.remove('opacity-100', 'scale-100');
            }
            this.hideOverlay();
        },

        openAdditional() {
            if (elements.additionalServiceDrawer) {
                elements.additionalServiceDrawer.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
                elements.additionalServiceDrawer.classList.add('opacity-100', 'scale-100');
            }
            this.showOverlay();
        },

        closeAdditional() {
            if (elements.additionalServiceDrawer) {
                elements.additionalServiceDrawer.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                elements.additionalServiceDrawer.classList.remove('opacity-100', 'scale-100');
            }
            this.hideOverlay();
        },

        openEditMain() {
            if (elements.editMainServiceDrawer) {
                elements.editMainServiceDrawer.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
                elements.editMainServiceDrawer.classList.add('opacity-100', 'scale-100');
            }
            this.showOverlay();
        },

        closeEditMain() {
            if (elements.editMainServiceDrawer) {
                elements.editMainServiceDrawer.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                elements.editMainServiceDrawer.classList.remove('opacity-100', 'scale-100');
            }
            this.hideOverlay();
        },

        openEditAdditional() {
            if (elements.editAdditionalServiceDrawer) {
                elements.editAdditionalServiceDrawer.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
                elements.editAdditionalServiceDrawer.classList.add('opacity-100', 'scale-100');
            }
            this.showOverlay();
        },

        closeEditAdditional() {
            if (elements.editAdditionalServiceDrawer) {
                elements.editAdditionalServiceDrawer.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                elements.editAdditionalServiceDrawer.classList.remove('opacity-100', 'scale-100');
            }
            this.hideOverlay();
        },

        showOverlay() {
            if (elements.overlay) {
                elements.overlay.classList.remove('hidden');
                elements.overlay.classList.add('bg-opacity-70');
            }
            document.body.style.overflow = 'hidden';
        },

        hideOverlay() {
            if (elements.overlay) {
                elements.overlay.classList.add('hidden');
                elements.overlay.classList.remove('bg-opacity-70');
            }
            document.body.style.overflow = 'auto';
        }
    };

    // Modal management functions
    const modalManager = {
        show(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) modal.classList.remove('hidden');
        },

        hide(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) modal.classList.add('hidden');
        },

        showSuccess() {
            this.show('success-drawer');
            successTimeout = setTimeout(() => {
                this.hide('success-drawer');
            }, 1000);
        },

        hideSuccess() {
            this.hide('success-drawer');
            if (successTimeout) {
                clearTimeout(successTimeout);
                successTimeout = null;
            }
        }
    };

    // Edit management functions
    const editManager = {
        openMainServiceEdit(button) {
            currentEditRow = button.closest('tr');
            if (!currentEditRow) return;

            const serviceName = currentEditRow.getAttribute('data-service-name');
            const servicePrice = currentEditRow.getAttribute('data-service-price');
            const serviceDuration = currentEditRow.getAttribute('data-service-duration');
            const serviceDescription = currentEditRow.getAttribute('data-service-description');

            // Populate form fields
            document.getElementById('edit-main-name').value = serviceName || '';
            document.getElementById('edit-main-price').value = servicePrice || '';
            document.getElementById('edit-main-duration').value = serviceDuration || '';
            document.getElementById('edit-main-description').value = serviceDescription || '';

            drawerManager.openEditMain();
        },

        openAdditionalServiceEdit(button) {
            currentEditRow = button.closest('tr');
            if (!currentEditRow) return;

            const serviceName = currentEditRow.getAttribute('data-service-name');
            const servicePrice = currentEditRow.getAttribute('data-service-price');
            const serviceDuration = currentEditRow.getAttribute('data-service-duration');
            const serviceDescription = currentEditRow.getAttribute('data-service-description');

            // Populate form fields
            document.getElementById('edit-additional-name').value = serviceName || '';
            document.getElementById('edit-additional-price').value = servicePrice || '';
            document.getElementById('edit-additional-duration').value = serviceDuration || '';
            document.getElementById('edit-additional-description').value = serviceDescription || '';

            drawerManager.openEditAdditional();
        },

        saveMainService() {
            if (!currentEditRow) return;

            const newName = document.getElementById('edit-main-name').value;
            const newPrice = document.getElementById('edit-main-price').value;
            const newDuration = document.getElementById('edit-main-duration').value;
            const newDescription = document.getElementById('edit-main-description').value;

            // Update table row
            const cells = currentEditRow.children;
            if (cells.length >= 4) {
                cells[0].textContent = newName;
                cells[1].textContent = new Intl.NumberFormat('id-ID').format(newPrice);
                cells[2].innerHTML = `<img src="{{ asset('images/clock.svg') }}" alt="Clock" class="h-6.5 w-6.5 mr-2">${newDuration} Menit`;
                cells[3].textContent = newDescription;
            }

            // Update data attributes
            currentEditRow.setAttribute('data-service-name', newName);
            currentEditRow.setAttribute('data-service-price', newPrice);
            currentEditRow.setAttribute('data-service-duration', newDuration);
            currentEditRow.setAttribute('data-service-description', newDescription);

            drawerManager.closeEditMain();
            modalManager.show('loading-drawer');

            setTimeout(() => {
                modalManager.hide('loading-drawer');
                modalManager.showSuccess();
                currentEditRow = null;
            }, 1000);
        },

        saveAdditionalService() {
            if (!currentEditRow) return;

            const newName = document.getElementById('edit-additional-name').value;
            const newPrice = document.getElementById('edit-additional-price').value;
            const newDuration = document.getElementById('edit-additional-duration').value;
            const newDescription = document.getElementById('edit-additional-description').value;

            // Update table row
            const cells = currentEditRow.children;
            if (cells.length >= 4) {
                cells[0].textContent = newName;
                cells[1].textContent = new Intl.NumberFormat('id-ID').format(newPrice);
                cells[2].innerHTML = `<img src="{{ asset('images/clock.svg') }}" alt="Clock" class="h-6.5 w-6.5 mr-2">${newDuration} Menit`;
                cells[3].textContent = newDescription;
            }

            // Update data attributes
            currentEditRow.setAttribute('data-service-name', newName);
            currentEditRow.setAttribute('data-service-price', newPrice);
            currentEditRow.setAttribute('data-service-duration', newDuration);
            currentEditRow.setAttribute('data-service-description', newDescription);

            drawerManager.closeEditAdditional();
            modalManager.show('loading-drawer');

            setTimeout(() => {
                modalManager.hide('loading-drawer');
                modalManager.showSuccess();
                currentEditRow = null;
            }, 1000);
        }
    };

    // Status management functions
    const statusManager = {
        openDialog(button) {
            currentStatusButton = button;
            const currentStatus = button.getAttribute('data-current-status');
            const warningText = document.getElementById('status-warning-text');
            const confirmText = document.getElementById('status-confirm-text');
            const notifyUsers = document.getElementById('notify-users');

            if (warningText && confirmText) {
                if (currentStatus === 'Aktif') {
                    warningText.innerHTML = 'Jika anda <strong>menonaktifkan</strong> layanan tersebut, maka layanan tidak akan ditampilkan di Pemesanan (Pelanggan).';
                    confirmText.textContent = 'Nonaktifkan';
                } else {
                    warningText.innerHTML = 'Jika anda <strong>mengaktifkan</strong> layanan tersebut, maka layanan akan ditampilkan kembali di Pemesanan (Pelanggan).';
                    confirmText.textContent = 'Aktifkan';
                }
            }

            if (notifyUsers) notifyUsers.checked = false;
            modalManager.show('status-drawer');
        },

        confirmChange() {
            if (!currentStatusButton) return;

            const currentStatus = currentStatusButton.getAttribute('data-current-status');
            const newStatus = currentStatus === 'Aktif' ? 'Nonaktif' : 'Aktif';
            
            const statusText = currentStatusButton.querySelector('.status-text');
            const statusDot = currentStatusButton.querySelector('div');

            if (statusText) statusText.textContent = newStatus;
            currentStatusButton.setAttribute('data-current-status', newStatus);

            if (newStatus === 'Aktif') {
                currentStatusButton.style.backgroundColor = '#E5F9F9';
                currentStatusButton.style.color = '#3FC1C0';
                if (statusDot) statusDot.style.backgroundColor = '#3FC1C0';
            } else {
                currentStatusButton.style.backgroundColor = '#FEF2F2';
                currentStatusButton.style.color = '#EF4444';
                if (statusDot) statusDot.style.backgroundColor = '#EF4444';
            }

            modalManager.hide('status-drawer');
            modalManager.show('loading-drawer');

            setTimeout(() => {
                modalManager.hide('loading-drawer');
                modalManager.showSuccess();
                currentStatusButton = null;
            }, 1000);
        },

        cancel() {
            modalManager.hide('status-drawer');
            currentStatusButton = null;
        }
    };

    // Delete management functions
    const deleteManager = {
        openDialog(button) {
            currentDeleteRow = button.closest('tr');
            const serviceName = currentDeleteRow ? currentDeleteRow.getAttribute('data-service-name') : '';
            const deleteServiceName = document.getElementById('delete-service-name');
            
            if (deleteServiceName) deleteServiceName.textContent = serviceName;
            modalManager.show('delete-drawer');
        },

        confirmDelete() {
            if (currentDeleteRow) {
                currentDeleteRow.remove();
                currentDeleteRow = null;

                modalManager.hide('delete-drawer');
                modalManager.show('loading-drawer');

                setTimeout(() => {
                    modalManager.hide('loading-drawer');
                    modalManager.showSuccess();
                }, 1000);
            }
        },

        cancel() {
            modalManager.hide('delete-drawer');
            currentDeleteRow = null;
        }
    };

    // Price input formatter
    function formatPriceInput(input) {
        if (input) {
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/[^0-9]/g, '');
                e.target.value = value;
            });
        }
    }

    // Form submission handler
    function handleFormSubmission(form, drawerCloseFunction) {
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                drawerCloseFunction();
                modalManager.show('loading-drawer');
                
                setTimeout(() => {
                    modalManager.hide('loading-drawer');
                    modalManager.showSuccess();
                    form.reset();
                }, 1000);
            });
        }
    }

    // Event listeners setup
    function setupEventListeners() {
        // Drawer buttons
        if (elements.openMainServiceBtn) {
            elements.openMainServiceBtn.addEventListener('click', (e) => {
                e.preventDefault();
                drawerManager.openMain();
            });
        }

        if (elements.closeMainServiceBtn) {
            elements.closeMainServiceBtn.addEventListener('click', (e) => {
                e.preventDefault();
                drawerManager.closeMain();
            });
        }

        if (elements.openAdditionalServiceBtn) {
            elements.openAdditionalServiceBtn.addEventListener('click', (e) => {
                e.preventDefault();
                drawerManager.openAdditional();
            });
        }

        if (elements.closeAdditionalServiceBtn) {
            elements.closeAdditionalServiceBtn.addEventListener('click', (e) => {
                e.preventDefault();
                drawerManager.closeAdditional();
            });
        }

        if (elements.closeEditMainServiceBtn) {
            elements.closeEditMainServiceBtn.addEventListener('click', (e) => {
                e.preventDefault();
                drawerManager.closeEditMain();
            });
        }

        if (elements.closeEditAdditionalServiceBtn) {
            elements.closeEditAdditionalServiceBtn.addEventListener('click', (e) => {
                e.preventDefault();
                drawerManager.closeEditAdditional();
            });
        }

        // Overlay click
        if (elements.overlay) {
            elements.overlay.addEventListener('click', function(e) {
                if (e.target === elements.overlay) {
                    drawerManager.closeMain();
                    drawerManager.closeAdditional();
                    drawerManager.closeEditMain();
                    drawerManager.closeEditAdditional();
                }
            });
        }

        // Edit buttons (using event delegation)
        document.addEventListener('click', function(e) {
            const editMainButton = e.target.closest('.edit-main-service-button');
            if (editMainButton) {
                e.preventDefault();
                e.stopPropagation();
                editManager.openMainServiceEdit(editMainButton);
                return;
            }

            const editAdditionalButton = e.target.closest('.edit-additional-service-button');
            if (editAdditionalButton) {
                e.preventDefault();
                e.stopPropagation();
                editManager.openAdditionalServiceEdit(editAdditionalButton);
                return;
            }
        });

        // Status buttons (using event delegation)
        document.addEventListener('click', function(e) {
            const statusButton = e.target.closest('.status-button');
            if (statusButton) {
                e.preventDefault();
                e.stopPropagation();
                statusManager.openDialog(statusButton);
            }
        });

        // Delete buttons (using event delegation)
        document.addEventListener('click', function(e) {
            const deleteButton = e.target.closest('.delete-button');
            if (deleteButton) {
                e.preventDefault();
                e.stopPropagation();
                deleteManager.openDialog(deleteButton);
            }
        });

        // Status modal buttons
        const statusCancel = document.getElementById('status-cancel');
        const statusConfirm = document.getElementById('status-confirm');
        if (statusCancel) statusCancel.addEventListener('click', (e) => {
            e.preventDefault();
            statusManager.cancel();
        });
        if (statusConfirm) statusConfirm.addEventListener('click', (e) => {
            e.preventDefault();
            statusManager.confirmChange();
        });

        // Delete modal buttons
        const deleteCancel = document.getElementById('delete-cancel');
        const deleteConfirm = document.getElementById('delete-confirm');
        if (deleteCancel) deleteCancel.addEventListener('click', (e) => {
            e.preventDefault();
            deleteManager.cancel();
        });
        if (deleteConfirm) deleteConfirm.addEventListener('click', (e) => {
            e.preventDefault();
            deleteManager.confirmDelete();
        });

        // Modal overlay clicks
        const overlays = ['status-drawer-overlay', 'delete-drawer-overlay', 'success-drawer-overlay'];
        overlays.forEach(overlayId => {
            const overlay = document.getElementById(overlayId);
            if (overlay) {
                overlay.addEventListener('click', function(e) {
                    if (e.target === this) {
                        const drawerId = overlayId.replace('-overlay', '');
                        modalManager.hide(drawerId);
                        if (drawerId === 'status-drawer') currentStatusButton = null;
                        if (drawerId === 'delete-drawer') currentDeleteRow = null;
                        if (drawerId === 'success-drawer') modalManager.hideSuccess();
                    }
                });
            }
        });

        // Prevent modal content clicks from closing modals
        const modalContents = ['status-drawer-content', 'delete-drawer-content', 'success-drawer-content'];
        modalContents.forEach(contentId => {
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
                drawerManager.closeMain();
                drawerManager.closeAdditional();
                drawerManager.closeEditMain();
                drawerManager.closeEditAdditional();
                modalManager.hide('delete-drawer');
                modalManager.hide('status-drawer');
                modalManager.hide('loading-drawer');
                modalManager.hideSuccess();
                
                currentStatusButton = null;
                currentDeleteRow = null;
                currentEditRow = null;
            }
        });
    }

    // Initialize
    function init() {
        setupEventListeners();
        
        // Setup price input formatting
        formatPriceInput(elements.mainServicePriceInput);
        formatPriceInput(elements.additionalServicePriceInput);
        formatPriceInput(elements.editMainServicePriceInput);
        formatPriceInput(elements.editAdditionalServicePriceInput);

        // Setup form submissions
        const mainServiceForm = elements.serviceDrawer ? elements.serviceDrawer.querySelector('form') : null;
        const additionalServiceForm = elements.additionalServiceDrawer ? elements.additionalServiceDrawer.querySelector('form') : null;
        const editMainServiceForm = document.getElementById('edit-main-service-form');
        const editAdditionalServiceForm = document.getElementById('edit-additional-service-form');
        
        handleFormSubmission(mainServiceForm, drawerManager.closeMain.bind(drawerManager));
        handleFormSubmission(additionalServiceForm, drawerManager.closeAdditional.bind(drawerManager));

        // Handle edit form submissions differently
        if (editMainServiceForm) {
            editMainServiceForm.addEventListener('submit', function(e) {
                e.preventDefault();
                editManager.saveMainService();
            });
        }

        if (editAdditionalServiceForm) {
            editAdditionalServiceForm.addEventListener('submit', function(e) {
                e.preventDefault();
                editManager.saveAdditionalService();
            });
        }

        // Form input styling
        const inputs = document.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.classList.add('ring-2', 'ring-teal-500', 'border-teal-500');
            });
            
            input.addEventListener('blur', function() {
                this.classList.remove('ring-2', 'ring-teal-500', 'border-teal-500');
            });
        });
    }
    init();
});
</script>
@endsection