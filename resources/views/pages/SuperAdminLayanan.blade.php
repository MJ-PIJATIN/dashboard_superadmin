@extends('layouts.layanan')
@section('navtitle', 'Manajemen Layanan')
@section('content')

<div class="bg-gray-100 min-h-screen">
<div class="max-w-screen-xl bg-gray-100 ml-[50px] pt-[100px] pb-[100px] pr-[25px]">

    <!-- Layanan Utama Section -->
    <div class="mb-8">
        <div class="flex justify-between items-center mb-4 mt-1">
            <h2 class="text-xl font-bold text-gray-700">Daftar Layanan Utama</h2>
            <button id="open-drawer-btn" class="bg-blue-500 text-white px-2 py-2 rounded-lg hover:bg-blue-600 transition-colors flex items-center text-sm">
                <div class="flex justify-center">
                    <img src="{{ asset('images/add.svg') }}" alt="Logo" class="h-4.5 w-4.5 mr-2">
                </div>
                Buat Layanan Utama
            </button>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-4 mt-2 border border-gray-200">
            <div class="overflow-x-auto bg-white">
                <table class="w-full">
                    <thead class="bg-white border-b border-gray-300">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Nama</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </div>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Harga</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </div>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Durasi</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </div>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Deskripsi</th>
                            <th class="px-4 py-2 pl-14 text-left text-sm font-semibold text-gray-800">Status</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($layananUtama as $layanan)
                            <tr class="hover:bg-gray-50"
                                data-service-id="{{ $layanan->id }}"
                                data-service-name="{{ $layanan->name }}"
                                data-service-price="{{ $layanan->price }}"
                                data-service-duration="{{ $layanan->duration }}"
                                data-service-description="{{ $layanan->description }}">
                                <td class="px-4 py-1 whitespace-nowrap text-sm text-gray-600 font-medium">{{ $layanan->name }}</td>
                                <td class="px-4 py-1 text-sm text-gray-600">{{ number_format($layanan->price, 0, ',', '.') }}</td>
                                <td class="px-4 py-1 text-sm text-gray-600 flex items-center">
                                    <img src="{{ asset('images/clock.svg') }}" alt="Clock" class="h-6.5 w-6.5 mr-2">
                                    {{ $layanan->duration }}
                                </td>
                                <td class="px-4 py-1 text-sm text-gray-600 relative group max-w-xs" style="max-width: 220px;">
                                    <span class="block truncate cursor-pointer" onmouseenter="showDescTooltip(this)" onmouseleave="hideDescTooltip(this)">
                                        {{ $layanan->description }}
                                    </span>
                                    <div class="desc-tooltip absolute left-1/2 -translate-x-1/2 -top-2 z-50 hidden min-w-[250px] max-w-xs bg-white text-gray-700 text-sm rounded shadow-lg p-3 border border-gray-200" style="white-space: pre-line;">
                                        {{ $layanan->description }}
                                    </div>
                                </td>
                                <td class="px-4 py-1">
                                    <button class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium status-button ml-10"
                                            style="background-color: {{ $layanan->status == 'aktif' ? '#E5F9F9' : '#FEF2F2' }};
                                                color: {{ $layanan->status == 'aktif' ? '#3FC1C0' : '#EF4444' }};"
                                            data-service-id="{{ $layanan->id }}" data-current-status="{{ $layanan->status == 'aktif' ? 'Aktif' : 'Nonaktif' }}">
                                        <div class="w-2 h-2" style="background-color: {{ $layanan->status == 'aktif' ? '#3FC1C0' : '#EF4444' }}; border-radius: 9999px; margin-right: 0.375rem;"></div>
                                        <span class="status-text">{{ $layanan->status == 'aktif' ? 'Aktif' : 'Nonaktif' }}</span>
                                    </button>
                                </td>
                                <td class="px-4 py-1 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800 p-1 rounded edit-main-service-button" data-service-id="{{ $layanan->id }}">
                                            <img src="{{ asset('images/pencil.svg') }}" alt="Edit" class="h-6 w-6">
                                        </button>
                                        <button class="text-red-600 hover:text-red-800 p-1 rounded delete-button" data-service-id="{{ $layanan->id }}">
                                            <img src="{{ asset('images/trash can.svg') }}" alt="Delete" class="h-6 w-6">
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
        <div class="flex justify-between items-center mb-4 mt-1">
            <h2 class="text-xl font-bold text-gray-700">Daftar Layanan Tambahan</h2>
            <button id="open-additional-service-btn" class="bg-blue-500 text-white px-2 py-2 rounded-lg hover:bg-blue-600 transition-colors flex items-center text-sm">
                <img src="{{ asset('images/add.svg') }}" alt="Add" class="h-4.5 w-4.5 mr-2">
                Buat Layanan Tambahan
            </button>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-4 mt-2 border border-gray-200">
            <div class="overflow-x-auto bg-white">
                <table class="w-full">
                    <thead class="bg-white border-b border-gray-300">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Nama</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </div>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Harga</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </div>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">
                                <div class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Durasi</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </div>
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-800">Deskripsi</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($layananTambahan as $layanan)
                            <tr class="hover:bg-gray-50"
                                data-service-id="{{ $layanan->id }}"
                                data-service-name="{{ $layanan->name }}"
                                data-service-price="{{ $layanan->price }}"
                                data-service-duration="{{ $layanan->duration }}"
                                data-service-description="{{ $layanan->description }}">
                                <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-600">{{ $layanan->name }}</td>
                                <td class="px-4 py-1 text-sm text-gray-600">{{ number_format($layanan->price, 0, ',', '.') }}</td>
                                <td class="px-4 py-1 text-sm text-gray-600 flex items-center">
                                    <img src="{{ asset('images/clock.svg') }}" alt="Clock" class="h-6.5 w-6.5 mr-2">
                                    {{ $layanan->duration }}
                                </td>
                                <td class="px-4 py-1 text-sm text-gray-600 relative group max-w-xs" style="max-width: 220px;">
                                    <span class="block truncate cursor-pointer" onmouseenter="showDescTooltip(this)" onmouseleave="hideDescTooltip(this)">
                                        {{ $layanan->description }}
                                    </span>
                                    <div class="desc-tooltip absolute left-1/2 -translate-x-1/2 -top-2 z-50 hidden min-w-[250px] max-w-xs bg-white text-gray-700 text-sm rounded shadow-lg p-3 border border-gray-200" style="white-space: pre-line;">
                                        {{ $layanan->description }}
                                    </div>
                                </td>
                                <td class="px-4 py-1 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800 p-1 rounded edit-additional-service-button" data-service-id="{{ $layanan->id }}">
                                            <img src="{{ asset('images/pencil.svg') }}" alt="Edit" class="h-6 w-6">
                                        </button>
                                        <button class="text-red-600 hover:text-red-800 p-1 rounded delete-button" data-service-id="{{ $layanan->id }}">
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
                        <option value="60 Menit">60 Menit</option>
                        <option value="90 Menit">90 Menit</option>
                        <option value="120 Menit">120 Menit</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg class="h-4 w-4 text-gray-500 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
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
                        <option value="60 Menit">60 Menit</option>
                        <option value="90 Menit">90 Menit</option>
                        <option value="120 Menit">120 Menit</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg class="h-4 w-4 text-gray-500 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
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
                        <option value="10 Menit">10 Menit</option>
                        <option value="20 Menit">20 Menit</option>
                        <option value="30 Menit">30 Menit</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg class="h-4 w-4 text-gray-500 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
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
                        <option value="10 Menit">10 Menit</option>
                        <option value="20 Menit">20 Menit</option>
                        <option value="30 Menit">30 Menit</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg class="h-4 w-4 text-gray-500 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
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
        <div class="flex items-center justify-center h-full">
            <div class="bg-white rounded-lg shadow-lg" style="width: 600px; padding: 24px;">
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
        <div class="flex items-center justify-center h-full">
            <div class="bg-white rounded-lg shadow-lg" style="width: 400px; padding: 24px; min-height: 280px;">
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
        <div class="flex items-center justify-center h-full">
            <div class="bg-white rounded-lg shadow-lg" style="width: 400px; padding: 24px; min-height: 280px;">
                <div class="flex flex-col items-center mb-4">
                    <h2 class="text-2xl font-bold mb-6" style="color: #469D89;">Berhasil!</h2>
                    <img src="{{ asset('images/succed.svg') }}" alt="Success" class="h-30 w-30">
                </div>
            </div>
        </div>
    </div>

</div>

<style>
.desc-tooltip {
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.15s;
}
.group:hover .desc-tooltip {
    display: block;
    opacity: 1;
    pointer-events: auto;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Global variables
    let currentStatusButton = null;
    let currentDeleteRow = null;
    let currentEditRow = null;
    let successTimeout = null;

    // Utility functions
    function showModal(modalId) {
        document.getElementById(modalId)?.classList.remove('hidden');
    }

    function hideModal(modalId) {
        document.getElementById(modalId)?.classList.add('hidden');
    }

    function showDrawer(drawerId) {
        const drawer = document.getElementById(drawerId);
        const overlay = document.getElementById('overlay');
        if (drawer) {
            drawer.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
            drawer.classList.add('opacity-100', 'scale-100');
        }
        if (overlay) {
            overlay.classList.remove('hidden');
        }
        document.body.style.overflow = 'hidden';
    }

    function hideDrawer(drawerId) {
        const drawer = document.getElementById(drawerId);
        const overlay = document.getElementById('overlay');
        if (drawer) {
            drawer.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
            drawer.classList.remove('opacity-100', 'scale-100');
        }
        if (overlay) {
            overlay.classList.add('hidden');
        }
        document.body.style.overflow = 'auto';
    }

    function showSuccess() {
        showModal('success-drawer');
        successTimeout = setTimeout(() => hideModal('success-drawer'), 1000);
    }

    function formatPriceInput(input) {
        if (input) {
            input.addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/[^0-9]/g, '');
            });
        }
    }

    // Tooltip functions
    window.showDescTooltip = function(el) {
        const tooltip = el.parentElement.querySelector('.desc-tooltip');
        if (tooltip) {
            tooltip.classList.remove('hidden');
            tooltip.style.opacity = '1';
        }
    };

    window.hideDescTooltip = function(el) {
        const tooltip = el.parentElement.querySelector('.desc-tooltip');
        if (tooltip) {
            tooltip.classList.add('hidden');
            tooltip.style.opacity = '0';
        }
    };

    // Main service form submission
    document.getElementById('drawer-main-service')?.querySelector('form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = {
            name: document.getElementById('name').value,
            price: document.getElementById('price').value.replace(/[^0-9]/g, ''),
            duration: document.getElementById('duration').value,
            description: document.getElementById('description').value
        };

        fetch("{{ route('layanan-utama.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                addRowToTable(data, formData, 'main');
                hideDrawer('drawer-main-service');
                showModal('loading-drawer');
                setTimeout(() => {
                    hideModal('loading-drawer');
                    showSuccess();
                    this.reset();
                }, 1000);
            } else {
                alert(data.message || 'Gagal menambah layanan.');
            }
        })
        .catch(() => alert('Terjadi kesalahan saat menambah layanan.'));
    });

    // Additional service form submission
    document.getElementById('drawer-additional-service')?.querySelector('form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = {
            name: document.getElementById('additional-service-name').value,
            price: document.getElementById('additional-service-price').value.replace(/[^0-9]/g, ''),
            duration: document.getElementById('additional-service-duration').value,
            description: document.getElementById('additional-description').value
        };

        fetch("{{ route('layanan-tambahan.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                addRowToTable(data, formData, 'additional');
                hideDrawer('drawer-additional-service');
                showModal('loading-drawer');
                setTimeout(() => {
                    hideModal('loading-drawer');
                    showSuccess();
                    this.reset();
                }, 1000);
            } else {
                alert(data.message || 'Gagal menambah layanan tambahan.');
            }
        })
        .catch(() => alert('Terjadi kesalahan saat menambah layanan tambahan.'));
    });

    // Edit main service form submission
    document.getElementById('edit-main-service-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        if (!currentEditRow) return;

        const serviceId = this.getAttribute('data-service-id');
        const formData = {
            id: serviceId,
            name: document.getElementById('edit-main-name').value,
            price: document.getElementById('edit-main-price').value.replace(/[^0-9]/g, ''),
            duration: document.getElementById('edit-main-duration').value,
            description: document.getElementById('edit-main-description').value
        };

        fetch("{{ route('layanan-utama.update') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateTableRow(currentEditRow, formData);
                hideDrawer('drawer-edit-main-service');
                showModal('loading-drawer');
                setTimeout(() => {
                    hideModal('loading-drawer');
                    showSuccess();
                    currentEditRow = null;
                }, 1000);
            } else {
                alert(data.message || 'Gagal mengubah layanan.');
            }
        })
        .catch(() => alert('Terjadi kesalahan saat mengubah layanan.'));
    });

    // Edit additional service form submission
    document.getElementById('edit-additional-service-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        if (!currentEditRow) return;

        const serviceId = this.getAttribute('data-service-id');
        const formData = {
            id: serviceId,
            name: document.getElementById('edit-additional-name').value,
            price: document.getElementById('edit-additional-price').value.replace(/[^0-9]/g, ''),
            duration: document.getElementById('edit-additional-duration').value,
            description: document.getElementById('edit-additional-description').value
        };

        fetch("{{ route('layanan-tambahan.update') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateTableRow(currentEditRow, formData, true);
                hideDrawer('drawer-edit-additional-service');
                showModal('loading-drawer');
                setTimeout(() => {
                    hideModal('loading-drawer');
                    showSuccess();
                    currentEditRow = null;
                }, 1000);
            } else {
                alert(data.message || 'Gagal mengubah layanan tambahan.');
            }
        })
        .catch(() => alert('Terjadi kesalahan saat mengubah layanan tambahan.'));
    });

    // Helper functions
    function addRowToTable(data, formData, type) {
        const tbody = type === 'main' 
            ? document.querySelector('tbody.bg-white')
            : document.querySelectorAll('tbody.bg-white')[1];
        
        if (!tbody) return;

        const row = document.createElement('tr');
        row.className = "hover:bg-gray-50";
        Object.entries(formData).forEach(([key, value]) => {
            row.setAttribute(`data-service-${key}`, value);
        });
        row.setAttribute('data-service-id', data.id);

        const statusColumn = type === 'main' ? `
            <td class="px-4 py-1">
                <button class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium status-button"
                        style="background-color: #E5F9F9; color: #3FC1C0;"
                        data-service-id="${data.id}" data-current-status="Aktif">
                    <div class="w-2 h-2" style="background-color: #3FC1C0; border-radius: 9999px; margin-right: 0.375rem;"></div>
                    <span class="status-text">Aktif</span>
                </button>
            </td>` : '';

        row.innerHTML = `
            <td class="px-4 py-1 whitespace-nowrap text-sm font-medium text-gray-600">${formData.name}</td>
            <td class="px-4 py-1 text-sm text-gray-600">${Number(formData.price).toLocaleString('id-ID')}</td>
            <td class="px-4 py-1 text-sm text-gray-600 flex items-center">
                <img src="{{ asset('images/clock.svg') }}" alt="Clock" class="h-6.5 w-6.5 mr-2">
                ${formData.duration}
            </td>
            <td class="px-4 py-1 text-sm text-gray-600 relative group max-w-xs" style="max-width: 220px;">
                <span class="block truncate cursor-pointer" onmouseenter="showDescTooltip(this)" onmouseleave="hideDescTooltip(this)">
                    ${formData.description}
                </span>
                <div class="desc-tooltip absolute left-1/2 -translate-x-1/2 -top-2 z-50 hidden min-w-[250px] max-w-xs bg-white text-gray-700 text-sm rounded shadow-lg p-3 border border-gray-200" style="white-space: pre-line;">
                    ${formData.description}
                </div>
            </td>
            ${statusColumn}
            <td class="px-4 py-1 text-right">
                <div class="flex items-center justify-end space-x-2">
                    <button class="text-blue-600 hover:text-blue-800 p-1 rounded edit-${type}-service-button" data-service-id="${data.id}">
                        <img src="{{ asset('images/pencil.svg') }}" alt="Edit" class="h-6 w-6">
                    </button>
                    <button class="text-red-600 hover:text-red-800 p-1 rounded delete-button" data-service-id="${data.id}">
                        <img src="{{ asset('images/trash can.svg') }}" alt="Delete" class="h-6 w-6">
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    }

    function updateTableRow(row, formData, isAdditional = false) {
        const cells = row.children;
        if (cells.length >= 4) {
            cells[0].textContent = formData.name;
            cells[1].textContent = new Intl.NumberFormat('id-ID').format(formData.price);
            cells[2].innerHTML = `<img src="{{ asset('images/clock.svg') }}" alt="Clock" class="h-6.5 w-6.5 mr-2">${formData.duration}`;
            cells[3].innerHTML = `
                <span class="block truncate cursor-pointer" onmouseenter="showDescTooltip(this)" onmouseleave="hideDescTooltip(this)">
                    ${formData.description}
                </span>
                <div class="desc-tooltip absolute left-1/2 -translate-x-1/2 -top-2 z-50 hidden min-w-[250px] max-w-xs bg-white text-gray-700 text-sm rounded shadow-lg p-3 border border-gray-200" style="white-space: pre-line;">
                    ${formData.description}
                </div>
            `;
        }

        Object.entries(formData).forEach(([key, value]) => {
            if (key !== 'id') row.setAttribute(`data-service-${key}`, value);
        });
    }

    // Event listeners
    document.getElementById('open-drawer-btn')?.addEventListener('click', () => showDrawer('drawer-main-service'));
    document.getElementById('close-drawer-btn')?.addEventListener('click', () => hideDrawer('drawer-main-service'));
    document.getElementById('open-additional-service-btn')?.addEventListener('click', () => showDrawer('drawer-additional-service'));
    document.getElementById('close-additional-drawer-btn')?.addEventListener('click', () => hideDrawer('drawer-additional-service'));
    document.getElementById('close-edit-main-drawer-btn')?.addEventListener('click', () => hideDrawer('drawer-edit-main-service'));
    document.getElementById('close-edit-additional-drawer-btn')?.addEventListener('click', () => hideDrawer('drawer-edit-additional-service'));

    document.getElementById('overlay')?.addEventListener('click', function(e) {
        if (e.target === this) {
            hideDrawer('drawer-main-service');
            hideDrawer('drawer-additional-service');
            hideDrawer('drawer-edit-main-service');
            hideDrawer('drawer-edit-additional-service');
        }
    });

    // Status modal events
    document.getElementById('status-cancel')?.addEventListener('click', () => {
        hideModal('status-drawer');
        currentStatusButton = null;
    });

    document.getElementById('status-confirm')?.addEventListener('click', () => {
        if (!currentStatusButton) return;

        const currentStatus = currentStatusButton.getAttribute('data-current-status');
        const newStatus = currentStatus === 'Aktif' ? 'Nonaktif' : 'Aktif';
        const serviceId = currentStatusButton.getAttribute('data-service-id');

        fetch("{{ route('layanan-utama.updateStatus') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ id: serviceId, status: newStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateStatusButton(currentStatusButton, newStatus);
                hideModal('status-drawer');
                showModal('loading-drawer');
                setTimeout(() => {
                    hideModal('loading-drawer');
                    showSuccess();
                    currentStatusButton = null;
                }, 1000);
            } else {
                alert(data.message || 'Gagal mengubah status.');
            }
        })
        .catch(() => alert('Terjadi kesalahan saat mengubah status.'));
    });

    // Delete modal events
    document.getElementById('delete-cancel')?.addEventListener('click', () => {
        hideModal('delete-drawer');
        currentDeleteRow = null;
    });

    document.getElementById('delete-confirm')?.addEventListener('click', () => {
        if (!currentDeleteRow) return;

        const serviceId = currentDeleteRow.getAttribute('data-service-id');
        const isAdditional = currentDeleteRow.closest('tbody') === document.querySelectorAll('tbody.bg-white')[1];
        const url = isAdditional ? "{{ route('layanan-tambahan.delete') }}" : "{{ route('layanan-utama.delete') }}";

        fetch(url, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ id: serviceId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                currentDeleteRow.remove();
                hideModal('delete-drawer');
                showModal('loading-drawer');
                setTimeout(() => {
                    hideModal('loading-drawer');
                    showSuccess();
                    currentDeleteRow = null;
                }, 1000);
            } else {
                alert(data.message || 'Gagal menghapus layanan.');
            }
        })
        .catch(() => alert('Terjadi kesalahan saat menghapus layanan.'));
    });

    function updateStatusButton(button, newStatus) {
        const statusText = button.querySelector('.status-text');
        const statusDot = button.querySelector('div');

        if (statusText) statusText.textContent = newStatus;
        button.setAttribute('data-current-status', newStatus);

        if (newStatus === 'Aktif') {
            button.style.backgroundColor = '#E5F9F9';
            button.style.color = '#3FC1C0';
            if (statusDot) statusDot.style.backgroundColor = '#3FC1C0';
        } else {
            button.style.backgroundColor = '#FEF2F2';
            button.style.color = '#EF4444';
            if (statusDot) statusDot.style.backgroundColor = '#EF4444';
        }
    }

    // Event delegation for dynamic buttons
    document.addEventListener('click', function(e) {
        const editMainButton = e.target.closest('.edit-main-service-button');
        if (editMainButton) {
            e.preventDefault();
            currentEditRow = editMainButton.closest('tr');
            if (currentEditRow) {
                const serviceId = currentEditRow.getAttribute('data-service-id');
                document.getElementById('edit-main-service-form').setAttribute('data-service-id', serviceId);
                document.getElementById('edit-main-name').value = currentEditRow.getAttribute('data-service-name') || '';
                document.getElementById('edit-main-price').value = currentEditRow.getAttribute('data-service-price') || '';
                document.getElementById('edit-main-duration').value = currentEditRow.getAttribute('data-service-duration') || '';
                document.getElementById('edit-main-description').value = currentEditRow.getAttribute('data-service-description') || '';
                showDrawer('drawer-edit-main-service');
            }
            return;
        }

        const editAdditionalButton = e.target.closest('.edit-additional-service-button');
        if (editAdditionalButton) {
            e.preventDefault();
            currentEditRow = editAdditionalButton.closest('tr');
            if (currentEditRow) {
                const serviceId = currentEditRow.getAttribute('data-service-id');
                document.getElementById('edit-additional-service-form').setAttribute('data-service-id', serviceId);
                document.getElementById('edit-additional-name').value = currentEditRow.getAttribute('data-service-name') || '';
                document.getElementById('edit-additional-price').value = currentEditRow.getAttribute('data-service-price') || '';
                document.getElementById('edit-additional-duration').value = currentEditRow.getAttribute('data-service-duration') || '';
                document.getElementById('edit-additional-description').value = currentEditRow.getAttribute('data-service-description') || '';
                showDrawer('drawer-edit-additional-service');
            }
            return;
        }

        const statusButton = e.target.closest('.status-button');
        if (statusButton) {
            e.preventDefault();
            currentStatusButton = statusButton;
            const currentStatus = statusButton.getAttribute('data-current-status');
            const warningText = document.getElementById('status-warning-text');
            const confirmText = document.getElementById('status-confirm-text');

            if (warningText && confirmText) {
                if (currentStatus === 'Aktif') {
                    warningText.innerHTML = 'Jika anda <strong>menonaktifkan</strong> layanan tersebut, maka layanan tidak akan ditampilkan di Pemesanan (Pelanggan).';
                    confirmText.textContent = 'Nonaktifkan';
                } else {
                    warningText.innerHTML = 'Jika anda <strong>mengaktifkan</strong> layanan tersebut, maka layanan akan ditampilkan kembali di Pemesanan (Pelanggan).';
                    confirmText.textContent = 'Aktifkan';
                }
            }
            document.getElementById('notify-users').checked = false;
            showModal('status-drawer');
            return;
        }

        const deleteButton = e.target.closest('.delete-button');
        if (deleteButton) {
            e.preventDefault();
            currentDeleteRow = deleteButton.closest('tr');
            const serviceName = currentDeleteRow?.getAttribute('data-service-name') || '';
            const isAdditional = currentDeleteRow?.closest('tbody') === document.querySelectorAll('tbody.bg-white')[1];
            const label = isAdditional ? 'Layanan Tambahan' : 'Layanan Utama';
            document.getElementById('delete-service-name').textContent = `${label}: ${serviceName}`;
            showModal('delete-drawer');
            return;
        }
    });

    // Initialize price inputs
    ['price', 'additional-service-price', 'edit-main-price', 'edit-additional-price'].forEach(id => {
        formatPriceInput(document.getElementById(id));
    });

    // Keyboard events
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideDrawer('drawer-main-service');
            hideDrawer('drawer-additional-service');
            hideDrawer('drawer-edit-main-service');
            hideDrawer('drawer-edit-additional-service');
            hideModal('delete-drawer');
            hideModal('status-drawer');
            hideModal('loading-drawer');
            hideModal('success-drawer');
            currentStatusButton = null;
            currentDeleteRow = null;
            currentEditRow = null;
            if (successTimeout) {
                clearTimeout(successTimeout);
                successTimeout = null;
            }
        }
    });
});
</script>
@endsection