@extends('layouts.pelanggan')
@section('navtitle', 'Pelanggan')

@section('content')
<div class="container mx-auto px-4 py-20">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Data Akun Pelanggan</h2>

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

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border-separate border-spacing-y-2">
            <thead class="text-gray-600 font-semibold">
                <tr>
                    <th class="w-6">#</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Kota/Kabupaten</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @php
                    $data = [
                        ['Santi', 'santi@gmail.com', 'Jakarta Timur', 'Belum aktif', '♀️'],
                        ['Dandia Rianti', 'dandia@gmail.com', 'Jakarta Pusat', 'Belum aktif', '♀️'],
                        ['Tono Winarto', 'tono@gmail.com', 'Jakarta Barat', 'Belum aktif', '♂️'],
                        ['Salimin Ajaya', 'salimin1@gmail.com', 'Kendal', 'Aktif', '♂️'],
                        ['Willy Kusuma', 'willykus@gmail.com', 'Bandung', 'Aktif', '♂️'],
                        ['Salsabila Riana', 'salsabil@gmail.com', 'Bogor', 'Aktif', '♀️'],
                        ['Erna Puspita', 'erna28@gmail.com', 'Denpasar', 'Aktif', '♀️'],
                        ['Rendy Pangga Lali', 'rendy8@gmail.com', 'Gunung Kidul', 'Aktif', '♂️'],
                        ['Tri Kusnawi', 'tri@gmail.com', 'Sleman', 'Aktif', '♂️'],
                        ['Willy Kusuma', 'willykus@gmail.com', 'Malang', 'Aktif', '♂️'],
                    ];
                @endphp

                @foreach ($data as $index => [$nama, $email, $kota, $status, $gender])
                    <tr class="bg-white rounded shadow-sm">
                        <td class="px-3 py-2">{{ $index + 1 }}</td>
                        <td class="px-3 py-2 flex items-center gap-2">
                            <span class="text-lg">
                                @if($gender == '♀️')
                                    <span class="text-pink-500">♀️</span>
                                @else
                                    <span class="text-blue-500">♂️</span>
                                @endif
                            </span>
                            {{ $nama }}
                        </td>
                        <td class="px-3 py-2">{{ $email }}</td>
                        <td class="px-3 py-2">{{ $kota }}</td>
                        <td class="px-3 py-2">
                            @if($status == 'Aktif')
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded bg-green-100 text-green-600">● Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded bg-yellow-100 text-yellow-600">● Belum aktif</span>
                            @endif
                        </td>
                            <td class="px-6 py-3">
                                <a href="{{ route('detail.akun.pelanggan', ['id' => $loop->iteration]) }}" class="hover:text-blue-600"
                                    title="Lihat Detail Akun Pelanggan">
                                    <svg width="19" height="21" viewBox="0 0 19 21" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.9103 8.94769C10.633 10.6704 10.8132 13.3515 9.45099 15.2747L9.30957 15.4644L13.5277 19.6835L13.6025 19.7702C13.8272 20.0731 13.8023 20.5026 13.5277 20.7772C13.2532 21.0517 12.8235 21.0767 12.5207 20.8521L12.434 20.7772L8.17677 16.52C6.26097 17.8118 3.63804 17.6101 1.94298 15.915C0.0190071 13.9911 0.0190071 10.8717 1.94298 8.94769C3.86695 7.02376 6.98633 7.02376 8.9103 8.94769ZM10.6307 0C11.2273 0 11.7996 0.236932 12.2216 0.658707L15.034 3.46961L17.8421 6.28199C18.2634 6.70392 18.5 7.2758 18.5 7.87206V17.7532C18.5 18.996 17.4925 20.0036 16.2496 20.0036L14.74 20.0042C14.7026 19.7111 14.5917 19.4249 14.4058 19.1743L14.2848 19.03L13.758 18.5023L16.2496 18.5033C16.6639 18.5033 16.9997 18.1674 16.9997 17.7532L16.9989 8.00442L12.7522 8.00532C11.5611 8.00532 10.5862 7.07999 10.507 5.90899L10.5018 5.75491V1.50027H4.75076C4.33647 1.50027 4.00062 1.83612 4.00062 2.2504L4.00029 6.67236C3.48132 6.79549 2.97573 6.98942 2.49892 7.25417L2.50036 2.2504C2.50036 1.00754 3.5079 0 4.75076 0H10.6307ZM3.03667 10.0414C1.71674 11.3613 1.71674 13.5014 3.03667 14.8213C4.35662 16.1413 6.49666 16.1413 7.8166 14.8213C9.13654 13.5014 9.13654 11.3613 7.8166 10.0414C6.49666 8.72145 4.35662 8.72145 3.03667 10.0414ZM12.002 2.56045V5.75491C12.002 6.13468 12.2843 6.44852 12.6504 6.49819L12.7522 6.50505L15.9437 6.50416L12.002 2.56045Z"
                                            fill="#2196F3" />
                                    </svg>
                                </a>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

        {{-- Pagination Section --}}
        <div class="flex justify-between items-center">
            <span class="text-base font-regular text-gray-600">Halaman 1 dari 53</span>
            <div class="flex space-x-1 text-base font-semibold ">
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
@endsection
