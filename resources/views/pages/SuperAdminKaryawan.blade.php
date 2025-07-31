@extends('layouts.app')
@section('navtitle', 'Karyawan')

@section('content')
<div class="px-6 py-20">
    <!-- Header Judul -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-700">Data Akun Karyawan</h2>
            <a href="/tambah/karyawan">
                <button
                    class="flex items-center gap-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-base font-semibold rounded-lg shadow">
                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.0013 0.166016C13.6036 0.166016 17.3346 3.89697 17.3346 8.49935C17.3346 13.1017 13.6036 16.8327 9.0013 16.8327C4.39893 16.8327 0.667969 13.1017 0.667969 8.49935C0.667969 3.89697 4.39893 0.166016 9.0013 0.166016ZM9.0013 4.33268C8.68489 4.33268 8.42339 4.56781 8.38197 4.87287L8.3763 4.95768V7.87435H5.45964C5.11446 7.87435 4.83464 8.15418 4.83464 8.49935C4.83464 8.81577 5.06976 9.07727 5.37483 9.11868L5.45964 9.12435H8.3763V12.041C8.3763 12.3862 8.65614 12.666 9.0013 12.666C9.31772 12.666 9.57922 12.4308 9.62064 12.1258L9.6263 12.041V9.12435H12.543C12.8881 9.12435 13.168 8.84452 13.168 8.49935C13.168 8.18293 12.9328 7.92143 12.6278 7.88002L12.543 7.87435H9.6263V4.95768C9.6263 4.61251 9.34647 4.33268 9.0013 4.33268Z"
                            fill="white" />
                    </svg>
                    Buat Akun Karyawan
                </button>
            </a>
        </div>

    {{-- Tab Header (Admin & Finance) --}}
    <div class="flex space-x-3 mb-4">
        <button id="tab-admin-btn" class="relative -mb-1 tab-button active-tab">
            <div class="bg-white border border-gray-300 rounded-t-lg px-6 py-2 shadow-md z-10 relative text-sm font-semibold">
                Admin
            </div>
            <div class="h-1 bg-white absolute bottom-0 left-0 right-0 z-20"></div>
        </button>
        <button id="tab-finance-btn" class="relative -mb-1 tab-button active-tab">
            <div class="bg-gray-100 border border-gray-300 rounded-t-lg px-6 py-2 shadow-sm z-0 text-sm text-gray-500">
                Finance
            </div>
        </button>
    </div>

    {{-- Card Container --}}
    <div class="bg-white rounded-2xl shadow-lg p-6">

        {{-- Section Search dan Filter --}}
        <div class="flex items-center justify-between mb-6">
                    <div class="flex w-[300px] max-w-2xl">
                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Cari nomor id, nama, kota, dll"
                        class="flex-grow px-4 py-2.5 text-sm border border-gray-300 rounded-l-lg focus:outline-none focus:ring focus:ring-blue-200"/>
                    <button onclick="performSearch()" class="bg-[#469D89] hover:bg-[#378877] text-white px-4 py-2 rounded-r-lg flex items-center justify-center transition-colors">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8 0.75C12.0041 0.75 15.25 3.99594 15.25 8C15.25 9.7319 14.6427 11.3219 13.6295 12.5688L18.5303 17.4697C18.8232 17.7626 18.8232 18.2374 18.5303 18.5303C18.2641 18.7966 17.8474 18.8208 17.5538 18.6029L17.4697 18.5303L12.5688 13.6295C11.3219 14.6427 9.7319 15.25 8 15.25C3.99594 15.25 0.75 12.0041 0.75 8C0.75 3.99594 3.99594 0.75 8 0.75ZM8 2.25C4.82436 2.25 2.25 4.82436 2.25 8C2.25 11.1756 4.82436 13.75 8 13.75C11.1756 13.75 13.75 11.1756 13.75 8C13.75 4.82436 11.1756 2.25 8 2.25Z"
                            fill="white"
                        />
                        </svg>
                        <i class="fas fa-search ml-1"></i>
                    </button>
                    </div>
                </div>

        {{-- Tab Contents (dummy data) --}}
        <div id="tab-admin" class="tab-content">
            <table class="w-full text-sm text-left">
                <thead class="text-gray-600 bg-gray-100">
                    <tr>
                        <th class="py-3 px-4">#</th>
                        <th class="py-3 px-4">Nama Lengkap</th>
                        <th class="py-3 px-4">Tanggal Bergabung</th>
                        <th class="py-3 px-4">Ponsel</th>
                        <th class="py-3 px-4">Jenis Kelamin</th>
                        <th class="py-3 px-4">Area Penempatan</th>
                        <th class="py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                    <tbody>
                        @php
                            $names = ['Nabila Usamah', 'Yuni Prastuti', 'Ina Laksmiwati', 'Fitriani Wahyuni', 'Jasmin Prawiti', 'Kurnia Mustofa', 'Praboto Waluyo', 'Ikin Wasita', 'Fitria Uyainah', 'Yunita Astari'];
                            $dates = ['02 Mar 2023', '17 Mei 2023', '07 Jul 2023', '03 Jul 2023', '03 Feb 2023', '14 Jan 2023', '23 Feb 2023', '23 Mei 2023', '30 Nov 2023', '17 Sep 2023'];
                            $phones = ['089876543211', '088765432187', '087987654321', '086987654321', '085987654321', '084987654321', '083987654321', '083987654321', '082987654321', '081987654321'];
                            $genders = ['Perempuan', 'Perempuan', 'Perempuan', 'Perempuan', 'Perempuan', 'Laki-Laki', 'Laki-Laki', 'Perempuan', 'Laki-Laki', 'Perempuan'];
                            $areas = ['Bandung', 'Sleman', 'Bantul', 'Kudus', 'Batam', 'Pekalongan', 'Solo', 'Bandung', 'Gunung Kidul', 'Surakarta'];
                        @endphp

                        @foreach(range(0, 9) as $i)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-3">{{ $i + 1 }}</td>
                                <td class="px-6 py-3">{{ $names[$i] }}</td>
                                <td class="px-6 py-3">{{ $dates[$i] }}</td>
                                <td class="px-6 py-3">{{ $phones[$i] }}</td>
                                <td class="px-6 py-3">{{ $genders[$i] }}</td>
                                <td class="px-6 py-3">{{ $areas[$i] }}</td>
                                <td class="py-2 px-4 flex space-x-2">
                                    <a href="{{ route('detail.karyawan', ['id' => $i + 1]) }}" class="hover:text-blue-600"
                                        title="Lihat Detail Akun">
                                        <svg width="19" height="21" viewBox="0 0 19 21" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.9103 8.94769C10.633 10.6704 10.8132 13.3515 9.45099 15.2747L9.30957 15.4644L13.5277 19.6835L13.6025 19.7702C13.8272 20.0731 13.8023 20.5026 13.5277 20.7772C13.2532 21.0517 12.8235 21.0767 12.5207 20.8521L12.434 20.7772L8.17677 16.52C6.26097 17.8118 3.63804 17.6101 1.94298 15.915C0.0190071 13.9911 0.0190071 10.8717 1.94298 8.94769C3.86695 7.02376 6.98633 7.02376 8.9103 8.94769ZM10.6307 0C11.2273 0 11.7996 0.236932 12.2216 0.658707L15.034 3.46961L17.8421 6.28199C18.2634 6.70392 18.5 7.2758 18.5 7.87206V17.7532C18.5 18.996 17.4925 20.0036 16.2496 20.0036L14.74 20.0042C14.7026 19.7111 14.5917 19.4249 14.4058 19.1743L14.2848 19.03L13.758 18.5023L16.2496 18.5033C16.6639 18.5033 16.9997 18.1674 16.9997 17.7532L16.9989 8.00442L12.7522 8.00532C11.5611 8.00532 10.5862 7.07999 10.507 5.90899L10.5018 5.75491V1.50027H4.75076C4.33647 1.50027 4.00062 1.83612 4.00062 2.2504L4.00029 6.67236C3.48132 6.79549 2.97573 6.98942 2.49892 7.25417L2.50036 2.2504C2.50036 1.00754 3.5079 0 4.75076 0H10.6307ZM3.03667 10.0414C1.71674 11.3613 1.71674 13.5014 3.03667 14.8213C4.35662 16.1413 6.49666 16.1413 7.8166 14.8213C9.13654 13.5014 9.13654 11.3613 7.8166 10.0414C6.49666 8.72145 4.35662 8.72145 3.03667 10.0414ZM12.002 2.56045V5.75491C12.002 6.13468 12.2843 6.44852 12.6504 6.49819L12.7522 6.50505L15.9437 6.50416L12.002 2.56045Z"
                                                fill="#2196F3" />
                                        </svg>
                                    </a>
                                    <a href="#" class="text-red-500">
                                        <svg class="w-6 h-6 inline" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tr>
                </tbody>
            </table>
        </div>

        <div id="tab-finance" class="tab-content hidden">
            <table class="w-full text-sm text-left">
                <thead class="text-gray-600 bg-gray-100">
                    <tr>
                        <th class="py-3 px-4">#</th>
                        <th class="py-3 px-4">Nama Lengkap</th>
                        <th class="py-3 px-4">Tanggal Bergabung</th>
                        <th class="py-3 px-4">Ponsel</th>
                        <th class="py-3 px-4">Jenis Kelamin</th>
                        <th class="py-3 px-4">Area Penempatan</th>
                        <th class="py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                    <tbody>
                        @php
                            $names = ['Nabila Usamah', 'Yuni Prastuti', 'Ina Laksmiwati', 'Fitriani Wahyuni', 'Jasmin Prawiti', 'Kurnia Mustofa', 'Praboto Waluyo', 'Ikin Wasita', 'Fitria Uyainah', 'Yunita Astari'];
                            $dates = ['02 Mar 2023', '17 Mei 2023', '07 Jul 2023', '03 Jul 2023', '03 Feb 2023', '14 Jan 2023', '23 Feb 2023', '23 Mei 2023', '30 Nov 2023', '17 Sep 2023'];
                            $phones = ['089876543211', '088765432187', '087987654321', '086987654321', '085987654321', '084987654321', '083987654321', '083987654321', '082987654321', '081987654321'];
                            $genders = ['Perempuan', 'Perempuan', 'Perempuan', 'Perempuan', 'Perempuan', 'Laki-Laki', 'Laki-Laki', 'Perempuan', 'Laki-Laki', 'Perempuan'];
                            $areas = ['Bandung', 'Sleman', 'Bantul', 'Kudus', 'Batam', 'Pekalongan', 'Solo', 'Bandung', 'Gunung Kidul', 'Surakarta'];
                        @endphp

                        @foreach(range(0, 9) as $i)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-3">{{ $i + 1 }}</td>
                                <td class="px-6 py-3">{{ $names[$i] }}</td>
                                <td class="px-6 py-3">{{ $dates[$i] }}</td>
                                <td class="px-6 py-3">{{ $phones[$i] }}</td>
                                <td class="px-6 py-3">{{ $genders[$i] }}</td>
                                <td class="px-6 py-3">{{ $areas[$i] }}</td>
                                <td class="py-2 px-4 flex space-x-2">
                                <a href="{{ route('detail.akun.finance', ['id' => $i + 1]) }}" class="hover:text-blue-600"
                                    title="Lihat Detail Akun">
                                    <svg width="19" height="21" viewBox="0 0 19 21" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.9103 8.94769C10.633 10.6704 10.8132 13.3515 9.45099 15.2747L9.30957 15.4644L13.5277 19.6835L13.6025 19.7702C13.8272 20.0731 13.8023 20.5026 13.5277 20.7772C13.2532 21.0517 12.8235 21.0767 12.5207 20.8521L12.434 20.7772L8.17677 16.52C6.26097 17.8118 3.63804 17.6101 1.94298 15.915C0.0190071 13.9911 0.0190071 10.8717 1.94298 8.94769C3.86695 7.02376 6.98633 7.02376 8.9103 8.94769ZM10.6307 0C11.2273 0 11.7996 0.236932 12.2216 0.658707L15.034 3.46961L17.8421 6.28199C18.2634 6.70392 18.5 7.2758 18.5 7.87206V17.7532C18.5 18.996 17.4925 20.0036 16.2496 20.0036L14.74 20.0042C14.7026 19.7111 14.5917 19.4249 14.4058 19.1743L14.2848 19.03L13.758 18.5023L16.2496 18.5033C16.6639 18.5033 16.9997 18.1674 16.9997 17.7532L16.9989 8.00442L12.7522 8.00532C11.5611 8.00532 10.5862 7.07999 10.507 5.90899L10.5018 5.75491V1.50027H4.75076C4.33647 1.50027 4.00062 1.83612 4.00062 2.2504L4.00029 6.67236C3.48132 6.79549 2.97573 6.98942 2.49892 7.25417L2.50036 2.2504C2.50036 1.00754 3.5079 0 4.75076 0H10.6307ZM3.03667 10.0414C1.71674 11.3613 1.71674 13.5014 3.03667 14.8213C4.35662 16.1413 6.49666 16.1413 7.8166 14.8213C9.13654 13.5014 9.13654 11.3613 7.8166 10.0414C6.49666 8.72145 4.35662 8.72145 3.03667 10.0414ZM12.002 2.56045V5.75491C12.002 6.13468 12.2843 6.44852 12.6504 6.49819L12.7522 6.50505L15.9437 6.50416L12.002 2.56045Z"
                                            fill="#2196F3" />
                                    </svg>
                                </a>
                                <a href="#" class="text-red-500">
                                    <svg class="w-6 h-6 inline" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                    </svg>
                                </a>
                            </td>
                            </tr>
                        @endforeach
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Script Tab Switching --}}
<script>
    const adminBtn = document.getElementById('tab-admin-btn');
    const financeBtn = document.getElementById('tab-finance-btn');
    const adminTab = document.getElementById('tab-admin');
    const financeTab = document.getElementById('tab-finance');

    const buttons = [adminBtn, financeBtn];

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            buttons.forEach(b => {
                b.classList.remove('active-tab');
                b.children[0].classList.remove('bg-white', 'text-gray-800', 'shadow-md');
                b.children[0].classList.add('bg-gray-100', 'text-gray-500', 'shadow-sm');
            });

            btn.classList.add('active-tab');
            btn.children[0].classList.remove('bg-gray-100', 'text-gray-500', 'shadow-sm');
            btn.children[0].classList.add('bg-white', 'text-gray-800', 'shadow-md');

            if (btn === adminBtn) {
                adminTab.classList.remove('hidden');
                financeTab.classList.add('hidden');
            } else {
                financeTab.classList.remove('hidden');
                adminTab.classList.add('hidden');
            }
        });
    });
</script>
@endsection
