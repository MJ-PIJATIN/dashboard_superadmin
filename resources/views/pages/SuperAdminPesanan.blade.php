@extends('layouts.app')

@section('title', 'Data Pemesanan Layanan')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="mt-[34px] ml-[50px] mr-[50px] px-6 py-20 bg-gray-50 w full">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Data Pemesanan Layanan</h2>

        {{-- Tabs --}}
        <div class="flex text-sm font-semibold mb-0 relative z-10">
            <button id="tab-transfer-btn" class="w-32 py-3 rounded-t-xl bg-white text-emerald-600 z-20 relative">
                Transfer
            </button>
            <button id="tab-cash-btn"
                class="w-32 py-3 rounded-t-xl bg-gray-100 text-gray-400 z-10 -ml-6 relative after:absolute after:top-0 after:left-0 after:w-6 after:h-full after:bg-gray-100 after:z-[-1]">
                Cash
            </button>
        </div>


        {{-- Card Wrapper --}}
        <div class="bg-white border-gray-200 rounded-b-xl rounded-tr-xl overflow-hidden">

            {{-- Search Bar --}}
            <div class="flex items-center justify-between px-4 py-4">
                <div class="flex w-full max-w-sm">
                    <input type="text" id="search-input"
                        class="flex-grow px-4 py-2 rounded-l-lg bg-gray-100 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-teal-400 placeholder:text-gray-400"
                        placeholder=" ">
                    <button class="bg-teal-400 hover:bg-teal-500 text-white px-4 py-2 rounded-r-lg">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8 0.75C12.0041 0.75 15.25 3.99594 15.25 8C15.25 9.7319 14.6427 11.3219 13.6295 12.5688L18.5303 17.4697C18.8232 17.7626 18.8232 18.2374 18.5303 18.5303C18.2641 18.7966 17.8474 18.8208 17.5538 18.6029L17.4697 18.5303L12.5688 13.6295C11.3219 14.6427 9.7319 15.25 8 15.25C3.99594 15.25 0.75 12.0041 0.75 8C0.75 3.99594 3.99594 0.75 8 0.75ZM8 2.25C4.82436 2.25 2.25 4.82436 2.25 8C2.25 11.1756 4.82436 13.75 8 13.75C11.1756 13.75 13.75 11.1756 13.75 8C13.75 4.82436 11.1756 2.25 8 2.25Z"
                                fill="white" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Transfer Tab --}}
            <div id="tab-transfer" class="tab-content pt-4 px-4">
                <table class="w-full text-sm">
                    <thead class="bg-white border-collapse text-left">
                        <tr>
                            <th class="px-4 py-2 font-bold border-b border-gray-300">#</th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[240px]">
                                <button class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Nama Pemesan</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </button>
                            </th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[240px]">
                                <button class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Jenis Layanan</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </button>
                            </th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[200px]">
                                <button class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Jadwal Layanan</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </button>
                            </th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[200px]">
                                <button class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Status Layanan</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </button>
                            </th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($transfer as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $index + 1 }}</td>
                                <td class="py-2 px-4">{{ $item['nama'] }}</td>
                                <td class="py-2 px-4">{{ $item['layanan'] }}</td>
                                <td class="py-2 px-4">{{ $item['jadwal'] }}</td>
                                <td class="py-2 px-4">
                                    <div
                                        class="flex items-center gap-2 px-3 py-1 rounded-[4px] w-[130px]
                                                        @if ($item['status'] === 'Menunggu') bg-blue-100 text-blue-600
                                                        @elseif($item['status'] === 'Pending') bg-blue-100 text-blue-600
                                                        @elseif($item['status'] === 'Dijadwalkan') bg-teal-100 text-teal-600
                                                        @elseif($item['status'] === 'Berlangsung') bg-yellow-100 text-yellow-600
                                                        @elseif($item['status'] === 'Selesai') bg-teal-100 text-teal-600
                                                        @elseif($item['status'] === 'Dibatalkan') bg-red-100 text-red-600 @endif">
                                        <span
                                            class="w-2 h-2 rounded-full
                                                            @if ($item['status'] === 'Menunggu') bg-blue-500
                                                            @elseif($item['status'] === 'Pending') bg-blue-500
                                                            @elseif($item['status'] === 'Dijadwalkan') bg-teal-500
                                                            @elseif($item['status'] === 'Berlangsung') bg-yellow-500
                                                            @elseif($item['status'] === 'Selesai') bg-teal-500
                                                            @elseif($item['status'] === 'Dibatalkan') bg-red-500 @endif"></span>
                                        <span>{{ $item['status'] }}</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4 text-center">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="{{ route('pesanan.detail', ['tipe' => 'transfer', 'id' => $loop->index]) }}"
                                            class="text-blue-600 hover:underline">
                                            <img src="{{ asset('images/isi tabel.svg') }}" alt="Edit" class="h-5 w-5">
                                        </a>
                                        <button class="text-red-600 hover:text-red-800 btn-delete" data-id="{{ $item['id'] }}"
                                            data-nama="{{ $item['nama'] }}" data-tipe="transfer">
                                            <img src="{{ asset('images/trash can.svg') }}" alt="Hapus">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Cash Tab --}}
            <div id="tab-cash" class="tab-content pt-4 px-4 hidden">
                <table class="w-full text-sm">
                    <thead class="bg-white border-collapse text-left">
                        <tr>
                            <th class="px-4 py-2 font-bold border-b border-gray-300">#</th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[240px]">
                                <button class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Nama Pemesan</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </button>
                            </th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[240px]">
                                <button class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Jenis Layanan</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </button>
                            </th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[200px]">
                                <button class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Jadwal Layanan</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </button>
                            </th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[200px]">
                                <button class="flex items-center space-x-1 hover:text-gray-800">
                                    <span>Status Layanan</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="h-4.5 w-4.5">
                                </button>
                            </th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($cash as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $index + 1 }}</td>
                                <td class="py-2 px-4">{{ $item['nama'] }}</td>
                                <td class="py-2 px-4">{{ $item['layanan'] }}</td>
                                <td class="py-2 px-4">{{ $item['jadwal'] }}</td>
                                <td class="py-2 px-4">
                                    <div
                                        class="flex items-center gap-2 px-3 py-1 rounded-[4px] w-[130px]
                                                        @if ($item['status'] === 'Menunggu') bg-blue-100 text-blue-600
                                                        @elseif($item['status'] === 'Pending') bg-blue-100 text-blue-600
                                                        @elseif($item['status'] === 'Dijadwalkan') bg-teal-100 text-teal-600
                                                        @elseif($item['status'] === 'Berlangsung') bg-yellow-100 text-yellow-600
                                                        @elseif($item['status'] === 'Selesai') bg-teal-100 text-teal-600
                                                        @elseif($item['status'] === 'Dibatalkan') bg-red-100 text-red-600 @endif">
                                        <span
                                            class="w-2 h-2 rounded-full
                                                            @if ($item['status'] === 'Menunggu') bg-blue-500
                                                            @elseif($item['status'] === 'Pending') bg-blue-500
                                                            @elseif($item['status'] === 'Dijadwalkan') bg-teal-500
                                                            @elseif($item['status'] === 'Berlangsung') bg-yellow-500
                                                            @elseif($item['status'] === 'Selesai') bg-teal-500
                                                            @elseif($item['status'] === 'Dibatalkan') bg-red-500 @endif"></span>
                                        <span>{{ $item['status'] }}</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4 text-center">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="{{ route('pesanan.detail', ['tipe' => 'cash', 'id' => $loop->index]) }}"
                                            class="text-blue-600 hover:underline">
                                            <img src="{{ asset('images/isi tabel.svg') }}" alt="Edit" class="h-5 w-5">
                                        </a>
                                        <button class="text-red-600 hover:text-red-800 btn-delete" data-id="{{ $item['id'] }}"
                                            data-nama="{{ $item['nama'] }}" data-tipe="cash">
                                            <img src="{{ asset('images/trash can.svg') }}" alt="Hapus">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination Section --}}
            <div class="flex justify-between items-center p-4 mt-6">
                <span class="text-sm text-gray-600">Halaman 1 dari 53</span>
                <div class="flex space-x-1 text-sm font-semibold">
                    <button class="px-3 py-1 rounded bg-teal-600 text-white">1</button>
                    <button class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">2</button>
                    <button class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">3</button>
                    <span class="px-2 py-1">...</span>
                    <button class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">53</button>
                    <button class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">&gt;</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Drawer -->
    <div id="delete-drawer" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center h-full">
            <div class="bg-white rounded-lg shadow-lg" style="width: 400px; padding: 24px; min-height: 280px;">
                <div class="flex flex-col items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Hapus Data</h2>
                    <img src="{{ asset('images/trash can.svg') }}" alt="Hapus" class="h-20 w-20 mb-6" />
                    <p class="text-gray-600 text-center text-base">
                        Apakah Anda yakin ingin menghapus layanan
                        <br><span id="delete-service-name" class="font-semibold text-red-600"></span>?
                    </p>
                </div>
                <div class="flex justify-center gap-8 mt-8">
                    <button id="delete-confirm" class="text-white px-6 py-2 rounded-lg hover:opacity-90 transition-colors"
                        style="background-color: #469D89;">
                        Hapus
                    </button>
                    <button id="delete-cancel"
                        class="bg-red-500 text-white px-7 py-2 rounded-lg hover:bg-red-600 transition-colors">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- Script Tab Switching --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabTransferBtn = document.getElementById('tab-transfer-btn');
            const tabCashBtn = document.getElementById('tab-cash-btn');

            function setActiveTab(tab) {
                const isTransfer = tab === 'transfer';

                // Set active tab button styles
                if (isTransfer) {
                    tabTransferBtn.className = 'w-32 py-3 rounded-t-xl bg-white text-emerald-600 z-20 relative';
                    tabCashBtn.className = 'w-32 py-3 rounded-t-xl bg-gray-100 text-gray-400 z-10 -ml-6 relative after:absolute after:top-0 after:left-0 after:w-6 after:h-full after:bg-gray-100 after:z-[-1]';
                } else {
                    tabTransferBtn.className = 'w-32 py-3 rounded-t-xl bg-gray-100 text-gray-400 z-10 relative after:absolute after:top-0 after:right-0 after:w-6 after:h-full after:bg-gray-100 after:z-[-1]';
                    tabCashBtn.className = 'w-32 py-3 rounded-t-xl bg-white text-emerald-600 z-20 relative -ml-6';
                }

                // Simpan tab yang aktif
                localStorage.setItem('activeTab', tab);

                // Tampilkan konten tab yang sesuai
                document.getElementById('tab-transfer').classList.toggle('hidden', !isTransfer);
                document.getElementById('tab-cash').classList.toggle('hidden', isTransfer);
            }

            // Tombol diklik
            tabTransferBtn.addEventListener('click', () => setActiveTab('transfer'));
            tabCashBtn.addEventListener('click', () => setActiveTab('cash'));

            // Load dari localStorage
            const savedTab = localStorage.getItem('activeTab') || 'transfer';
            setActiveTab(savedTab);
        });

        document.addEventListener('DOMContentLoaded', function () {

            const searchInput = document.getElementById('search-input');

            searchInput.addEventListener('input', function () {
                const filter = this.value.toLowerCase();

                ['transfer', 'cash'].forEach(tipe => {
                    const rows = document.querySelectorAll(`#tab-${tipe} tbody tr`);
                    rows.forEach(row => {
                        const textRow = row.textContent.toLowerCase();
                        row.style.display = textRow.includes(filter) ? '' : 'none';
                    });
                });
            });


            const deleteDrawer = document.getElementById('delete-drawer');
            const deleteServiceName = document.getElementById('delete-service-name');
            const deleteConfirmBtn = document.getElementById('delete-confirm');
            const deleteCancelBtn = document.getElementById('delete-cancel');

            let rowToDelete = null;

            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function () {
                    const nama = this.dataset.nama;
                    deleteServiceName.textContent = nama;
                    rowToDelete = this.closest('tr');
                    deleteDrawer.classList.remove('hidden');
                });
            });

            deleteConfirmBtn.addEventListener('click', function () {
                if (rowToDelete) {
                    rowToDelete.remove();
                    rowToDelete = null;
                }
                deleteDrawer.classList.add('hidden');
            });

            deleteCancelBtn.addEventListener('click', function () {
                deleteDrawer.classList.add('hidden');
                rowToDelete = null;
            });
        });
    </script>
@endsection