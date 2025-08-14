"""@extends('layouts.pesanan')
@section('navtitle', 'Pesanan')

@section('content')
<div class="bg-gray-100 min-h-screen">

    <div class="mt-[20px] ml-[26px] mr-[26px] px-6 py-20 bg-gray-100">

        <h2 class="text-xl font-bold text-gray-700 mb-6">Data Pemesanan Layanan</h2>

        {{-- Tabs --}}
        <div class="flex text-sm font-semibold mb-0 relative z-10">
            <button id="tab-transfer-btn" class="w-32 py-3 rounded-t-xl bg-white text-emerald-600 z-20 relative">
                Transfer
            </button>
            <button id="tab-cash-btn"
                class="w-32 py-3 rounded-t-xl bg-gray-200 text-gray-400 z-10 -ml-6 relative after:absolute after:top-0 after:left-0 after:w-6 after:h-full after:bg-gray-100 after:z-[-1]">
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
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[100px]">#</th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[240px]">
                                <button class="sort-btn flex items-center space-x-1 hover:text-gray-700" data-column="nama" data-sort-dir="asc">
                                    <span>Nama Pemesan</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="sort-icon h-4 w-4 transition-transform duration-200">
                                </button>
                            </th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[240px]">
                                <button class="sort-btn flex items-center space-x-1 hover:text-gray-700" data-column="layanan" data-sort-dir="asc">
                                    <span>Jenis Layanan</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="sort-icon h-4 w-4 transition-transform duration-200">
                                </button>
                            </th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[200px]">
                                <button class="sort-btn flex items-center space-x-1 hover:text-gray-700" data-column="jadwal" data-sort-dir="desc">
                                    <span>Jadwal Layanan</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="sort-icon h-4 w-4 transition-transform duration-200">
                                </button>
                            </th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[200px]">
                                <button class="sort-btn flex items-center space-x-1 hover:text-gray-700" data-column="status" data-sort-dir="asc">
                                    <span>Status Layanan</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="sort-icon h-4 w-4 transition-transform duration-200">
                                </button>
                            </th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 text-center w-[100px]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($transfer as $booking)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $booking->booking_code }}</td>
                                <td class="py-2 px-4">
                                    <div class="flex items-center gap-2">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md 
                                            @if ($booking->customer?->gender === 'LakiLaki') bg-blue-200 
                                            @elseif ($booking->customer?->gender === 'Perempuan') bg-pink-200 
                                            @endif">
                                            @if ($booking->customer?->gender === 'LakiLaki')
                                                <svg width="16" height="16" fill="#2196F3" viewBox="0 0 16 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10.5865 1.14676C10.5865 0.791723 10.8743 0.503906 11.2294 0.503906H14.6579C15.013 0.503906 15.3008 0.791723 15.3008 1.14676V4.57533C15.3008 4.93038 15.013 5.21819 14.6579 5.21819C14.3029 5.21819 14.0151 4.93038 14.0151 4.57533V2.69483L10.5998 6.0979C11.3955 7.08878 11.8722 8.34824 11.8722 9.71819C11.8722 12.9135 9.28185 15.5039 6.0865 15.5039C2.89113 15.5039 0.300781 12.9135 0.300781 9.71819C0.300781 6.52284 2.89113 3.93248 6.0865 3.93248C7.44815 3.93248 8.70076 4.40349 9.68885 5.19055L13.102 1.78962H11.2294C10.8743 1.78962 10.5865 1.5018 10.5865 1.14676ZM6.0865 5.21819C3.60121 5.21819 1.5865 7.23292 1.5865 9.71819C1.5865 12.2035 3.60121 14.2182 6.0865 14.2182C8.57177 14.2182 10.5865 12.2035 10.5865 9.71819C10.5865 8.47145 10.0804 7.34418 9.26071 6.52849C8.44635 5.718 7.32539 5.21819 6.0865 5.21819Z" />
                                                </svg>
                                            @elseif ($booking->customer?->gender === 'Perempuan')
                                                <svg width="11" height="16" fill="#E6007F" viewBox="0 0 11 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.0078125 5.69621C0.0078125 2.82858 2.33249 0.503906 5.20012 0.503906C8.06775 0.503906 10.3924 2.82858 10.3924 5.69621C10.3924 8.36883 8.37316 10.5698 5.77704 10.8568V12.8116H6.73858C7.05721 12.8116 7.31551 13.0699 7.31551 13.3885C7.31551 13.7071 7.05721 13.9654 6.73858 13.9654H5.77704V14.927C5.77704 15.2456 5.51875 15.5039 5.20012 15.5039C4.88149 15.5039 4.6232 15.2456 4.6232 14.927V13.9654H3.66166C3.34303 13.9654 3.08474 13.7071 3.08474 13.3885C3.08474 13.0699 3.34303 12.8116 3.66166 12.8116H4.6232V10.8568C2.02707 10.5698 0.0078125 8.36883 0.0078125 5.69621ZM5.20012 1.65775C2.96974 1.65775 1.16166 3.46583 1.16166 5.69621C1.16166 7.92659 2.96974 9.73468 5.20012 9.73468C7.43049 9.73468 9.23858 7.92659 9.23858 5.69621C9.23858 3.46583 7.4305 1.65775 5.20012 1.65775Z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <span>{{ $booking->customer?->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4">{{ $booking->mainService?->name ?? '-' }}</td>
                                <td class="py-2 px-4">{{ $booking->bookings_date ? \Carbon\Carbon::parse($booking->bookings_date)->format('m-d-y') : '-' }}</td>
                                <td class="py-2 px-4 font-semibold">
                                    <div
                                        class="flex items-center gap-2 px-3 py-1 rounded-[4px] w-[130px]
                                                        @if ($booking->status === 'Dijadwalkan') bg-cyan-100 text-cyan-400
                                                        @elseif($booking->status === 'Pending') bg-amber-100 text-amber-500
                                                        @elseif($booking->status === 'Berlangsung') bg-green-100 text-green-600
                                                        @elseif($booking->status === 'Menunggu') bg-yellow-100 text-yellow-400
                                                        @elseif($booking->status === 'Selesai') bg-teal-100 text-teal-500
                                                        @elseif($booking->status === 'Dibatalkan') bg-red-100 text-red-600 @endif">
                                        <span
                                            class="w-2 h-2 rounded-full
                                                            @if ($booking->status === 'Dijadwalkan') bg-cyan-400
                                                            @elseif($booking->status === 'Pending') bg-amber-500
                                                            @elseif($booking->status === 'Berlangsung') bg-green-600
                                                            @elseif($booking->status === 'Menunggu') bg-yellow-400
                                                            @elseif($booking->status === 'Selesai') bg-teal-500
                                                            @elseif($booking->status === 'Dibatalkan') bg-red-500 @endif"></span>
                                        <span>{{ $booking->status }}</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="{{ route('pesanan.detail', ['tipe' => 'transfer', 'id' => $booking->id]) }}"
                                            class="text-blue-600 hover:underline">
                                            <svg width="18" height="18" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.9103 8.94769C10.633 10.6704 10.8132 13.3515 9.45099 15.2747L9.30957 15.4644L13.5277 19.6835L13.6025 19.7702C13.8272 20.0731 13.8023 20.5026 13.5277 20.7772C13.2532 21.0517 12.8235 21.0767 12.5207 20.8521L12.434 20.7772L8.17677 16.52C6.26097 17.8118 3.63804 17.6101 1.94298 15.915C0.0190071 13.9911 0.0190071 10.8717 1.94298 8.94769C3.86695 7.02376 6.98633 7.02376 8.9103 8.94769ZM10.6307 0C11.2273 0 11.7996 0.236932 12.2216 0.658707L15.034 3.46961L17.8421 6.28199C18.2634 6.70392 18.5 7.2758 18.5 7.87206V17.7532C18.5 18.996 17.4925 20.0036 16.2496 20.0036L14.74 20.0042C14.7026 19.7111 14.5917 19.4249 14.4058 19.1743L14.2848 19.03L13.758 18.5023L16.2496 18.5033C16.6639 18.5033 16.9997 18.1674 16.9997 17.7532L16.9989 8.00442L12.7522 8.00532C11.5611 8.00532 10.5862 7.07999 10.507 5.90899L10.5018 5.75491V1.50027H4.75076C4.33647 1.50027 4.00062 1.83612 4.00062 2.2504L4.00029 6.67236C3.48132 6.79549 2.97573 6.98942 2.49892 7.25417L2.50036 2.2504C2.50036 1.00754 3.5079 0 4.75076 0H10.6307ZM3.03667 10.0414C1.71674 11.3613 1.71674 13.5014 3.03667 14.8213C4.35662 16.1413 6.49666 16.1413 7.8166 14.8213C9.13654 13.5014 9.13654 11.3613 7.8166 10.0414C6.49666 8.72145 4.35662 8.72145 3.03667 10.0414ZM12.002 2.56045V5.75491C12.002 6.13468 12.2843 6.44852 12.6504 6.49819L12.7522 6.50505L15.9437 6.50416L12.002 2.56045Z" fill="#2196F3"/>
                                            </svg>
                                        </a>
                                        <button class="text-red-600 hover:text-red-800 btn-delete" data-id="{{ $booking->id }}"
                                        data-name="{{ $booking->customer?->name ?? '-' }}" data-tipe="transfer">
                                            <svg width="25" height="25" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                               <path d="M12.951 7.58537H17.0485C17.0485 6.45386 16.1313 5.53659 14.9998 5.53659C13.8682 5.53659 12.951 6.45386 12.951 7.58537ZM11.4144 7.58537C11.4144 5.60522 13.0196 4 14.9998 4C16.9799 4 18.5851 5.60522 18.5851 7.58537H24.4754C24.8997 7.58537 25.2437 7.92935 25.2437 8.35366C25.2437 8.77797 24.8997 9.12195 24.4754 9.12195H23.1241L21.9235 21.5285C21.733 23.4976 20.0782 25 18.0999 25H11.8996C9.92139 25 8.2666 23.4976 8.07604 21.5285L6.8754 9.12195H5.52415C5.09984 9.12195 4.75586 8.77797 4.75586 8.35366C4.75586 7.92935 5.09984 7.58537 5.52415 7.58537H11.4144ZM13.4632 12.4512C13.4632 12.0269 13.1192 11.6829 12.6949 11.6829C12.2706 11.6829 11.9266 12.0269 11.9266 12.4512V20.1341C11.9266 20.5584 12.2706 20.9024 12.6949 20.9024C13.1192 20.9024 13.4632 20.5584 13.4632 20.1341V12.4512ZM17.3046 11.6829C17.7289 11.6829 18.0729 12.0269 18.0729 12.4512V20.1341C18.0729 20.5584 17.7289 20.9024 17.3046 20.9024C16.8803 20.9024 16.5363 20.5584 16.5363 20.1341V12.4512C16.5363 12.0269 16.8803 11.6829 17.3046 11.6829ZM9.60549 21.3805C9.71982 22.562 10.7127 23.4634 11.8996 23.4634H18.0999C19.2868 23.4634 20.2797 22.562 20.394 21.3805L21.5803 9.12195H8.41916L9.60549 21.3805Z" fill="#ED5554"/>
                                            </svg>
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
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[100px]">#</th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[240px]">
                                <button class="sort-btn flex items-center space-x-1 hover:text-gray-700" data-column="nama" data-sort-dir="asc">
                                    <span>Nama Pemesan</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="sort-icon h-4 w-4 transition-transform duration-200">
                                </button>
                            </th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[240px]">
                                <button class="sort-btn flex items-center space-x-1 hover:text-gray-700" data-column="layanan" data-sort-dir="asc">
                                    <span>Jenis Layanan</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="sort-icon h-4 w-4 transition-transform duration-200">
                                </button>
                            </th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[200px]">
                                <button class="sort-btn flex items-center space-x-1 hover:text-gray-700" data-column="jadwal" data-sort-dir="desc">
                                    <span>Jadwal Layanan</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="sort-icon h-4 w-4 transition-transform duration-200">
                                </button>
                            </th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[200px]">
                                <button class="sort-btn flex items-center space-x-1 hover:text-gray-700" data-column="status" data-sort-dir="asc">
                                    <span>Status Layanan</span>
                                    <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="sort-icon h-4 w-4 transition-transform duration-200">
                                </button>
                            </th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 text-center w-[100px]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($cash as $booking)
                            <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4">{{ $booking->booking_code }}</td>
                               <td class="py-2 px-4">
                                    <div class="flex items-center gap-2">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md 
                                            @if ($booking->customer?->gender === 'LakiLaki') bg-blue-200 
                                            @elseif ($booking->customer?->gender === 'Perempuan') bg-pink-200 
                                            @endif">
                                            @if ($booking->customer?->gender === 'LakiLaki')
                                                <svg width="16" height="16" fill="#2196F3" viewBox="0 0 16 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10.5865 1.14676C10.5865 0.791723 10.8743 0.503906 11.2294 0.503906H14.6579C15.013 0.503906 15.3008 0.791723 15.3008 1.14676V4.57533C15.3008 4.93038 15.013 5.21819 14.6579 5.21819C14.3029 5.21819 14.0151 4.93038 14.0151 4.57533V2.69483L10.5998 6.0979C11.3955 7.08878 11.8722 8.34824 11.8722 9.71819C11.8722 12.9135 9.28185 15.5039 6.0865 15.5039C2.89113 15.5039 0.300781 12.9135 0.300781 9.71819C0.300781 6.52284 2.89113 3.93248 6.0865 3.93248C7.44815 3.93248 8.70076 4.40349 9.68885 5.19055L13.102 1.78962H11.2294C10.8743 1.78962 10.5865 1.5018 10.5865 1.14676ZM6.0865 5.21819C3.60121 5.21819 1.5865 7.23292 1.5865 9.71819C1.5865 12.2035 3.60121 14.2182 6.0865 14.2182C8.57177 14.2182 10.5865 12.2035 10.5865 9.71819C10.5865 8.47145 10.0804 7.34418 9.26071 6.52849C8.44635 5.718 7.32539 5.21819 6.0865 5.21819Z" />
                                                </svg>
                                            @elseif ($booking->customer?->gender === 'Perempuan')
                                                <svg width="11" height="16" fill="#E6007F" viewBox="0 0 11 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.0078125 5.69621C0.0078125 2.82858 2.33249 0.503906 5.20012 0.503906C8.06775 0.503906 10.3924 2.82858 10.3924 5.69621C10.3924 8.36883 8.37316 10.5698 5.77704 10.8568V12.8116H6.73858C7.05721 12.8116 7.31551 13.0699 7.31551 13.3885C7.31551 13.7071 7.05721 13.9654 6.73858 13.9654H5.77704V14.927C5.77704 15.2456 5.51875 15.5039 5.20012 15.5039C4.88149 15.5039 4.6232 15.2456 4.6232 14.927V13.9654H3.66166C3.34303 13.9654 3.08474 13.7071 3.08474 13.3885C3.08474 13.0699 3.34303 12.8116 3.66166 12.8116H4.6232V10.8568C2.02707 10.5698 0.0078125 8.36883 0.0078125 5.69621ZM5.20012 1.65775C2.96974 1.65775 1.16166 3.46583 1.16166 5.69621C1.16166 7.92659 2.96974 9.73468 5.20012 9.73468C7.43049 9.73468 9.23858 7.92659 9.23858 5.69621C9.23858 3.46583 7.4305 1.65775 5.20012 1.65775Z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <span>{{ $booking->customer?->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4">{{ $booking->mainService?->name ?? '-' }}</td>
                                <td class="py-2 px-4">{{ $booking->bookings_date ? \Carbon\Carbon::parse($booking->bookings_date)->format('m-d-y') : '-' }}</td>
                                <td class="py-2 px-4 font-semibold">
                                    <div
                                        class="flex items-center gap-2 px-3 py-1 rounded-[4px] w-[130px]
                                                        @if ($booking->status === 'Dijadwalkan') bg-cyan-100 text-cyan-400
                                                        @elseif($booking->status === 'Pending') bg-amber-100 text-amber-500
                                                        @elseif($booking->status === 'Berlangsung') bg-green-100 text-green-600
                                                        @elseif($booking->status === 'Menunggu') bg-yellow-100 text-yellow-400
                                                        @elseif($booking->status === 'Selesai') bg-teal-100 text-teal-500
                                                        @elseif($booking->status === 'Dibatalkan') bg-red-100 text-red-600 @endif">
                                        <span
                                            class="w-2 h-2 rounded-full
                                                            @if ($booking->status === 'Dijadwalkan') bg-cyan-400
                                                            @elseif($booking->status === 'Pending') bg-amber-500
                                                            @elseif($booking->status === 'Berlangsung') bg-green-600
                                                            @elseif($booking->status === 'Menunggu') bg-yellow-400
                                                            @elseif($booking->status === 'Selesai') bg-teal-500
                                                            @elseif($booking->status === 'Dibatalkan') bg-red-500 @endif"></span>
                                        <span>{{ $booking->status }}</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="{{ route('pesanan.detail', ['tipe' => 'cash', 'id' => $booking->id]) }}"
                                            class="text-blue-600 hover:underline">
                                            <svg width="18" height="18" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.9103 8.94769C10.633 10.6704 10.8132 13.3515 9.45099 15.2747L9.30957 15.4644L13.5277 19.6835L13.6025 19.7702C13.8272 20.0731 13.8023 20.5026 13.5277 20.7772C13.2532 21.0517 12.8235 21.0767 12.5207 20.8521L12.434 20.7772L8.17677 16.52C6.26097 17.8118 3.63804 17.6101 1.94298 15.915C0.0190071 13.9911 0.0190071 10.8717 1.94298 8.94769C3.86695 7.02376 6.98633 7.02376 8.9103 8.94769ZM10.6307 0C11.2273 0 11.7996 0.236932 12.2216 0.658707L15.034 3.46961L17.8421 6.28199C18.2634 6.70392 18.5 7.2758 18.5 7.87206V17.7532C18.5 18.996 17.4925 20.0036 16.2496 20.0036L14.74 20.0042C14.7026 19.7111 14.5917 19.4249 14.4058 19.1743L14.2848 19.03L13.758 18.5023L16.2496 18.5033C16.6639 18.5033 16.9997 18.1674 16.9997 17.7532L16.9989 8.00442L12.7522 8.00532C11.5611 8.00532 10.5862 7.07999 10.507 5.90899L10.5018 5.75491V1.50027H4.75076C4.33647 1.50027 4.00062 1.83612 4.00062 2.2504L4.00029 6.67236C3.48132 6.79549 2.97573 6.98942 2.49892 7.25417L2.50036 2.2504C2.50036 1.00754 3.5079 0 4.75076 0H10.6307ZM3.03667 10.0414C1.71674 11.3613 1.71674 13.5014 3.03667 14.8213C4.35662 16.1413 6.49666 16.1413 7.8166 14.8213C9.13654 13.5014 9.13654 11.3613 7.8166 10.0414C6.49666 8.72145 4.35662 8.72145 3.03667 10.0414ZM12.002 2.56045V5.75491C12.002 6.13468 12.2843 6.44852 12.6504 6.49819L12.7522 6.50505L15.9437 6.50416L12.002 2.56045Z" fill="#2196F3"/>
                                            </svg>
                                        </a>
                                        <button class="text-red-600 hover:text-red-800 btn-delete" data-id="{{ $booking->id }}"
                                        data-name="{{ $booking->customer?->name ?? '-' }}" data-tipe="cash">
                                            <svg width="25" height="25" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                               <path d="M12.951 7.58537H17.0485C17.0485 6.45386 16.1313 5.53659 14.9998 5.53659C13.8682 5.53659 12.951 6.45386 12.951 7.58537ZM11.4144 7.58537C11.4144 5.60522 13.0196 4 14.9998 4C16.9799 4 18.5851 5.60522 18.5851 7.58537H24.4754C24.8997 7.58537 25.2437 7.92935 25.2437 8.35366C25.2437 8.77797 24.8997 9.12195 24.4754 9.12195H23.1241L21.9235 21.5285C21.733 23.4976 20.0782 25 18.0999 25H11.8996C9.92139 25 8.2666 23.4976 8.07604 21.5285L6.8754 9.12195H5.52415C5.09984 9.12195 4.75586 8.77797 4.75586 8.35366C4.75586 7.92935 5.09984 7.58537 5.52415 7.58537H11.4144ZM13.4632 12.4512C13.4632 12.0269 13.1192 11.6829 12.6949 11.6829C12.2706 11.6829 11.9266 12.0269 11.9266 12.4512V20.1341C11.9266 20.5584 12.2706 20.9024 12.6949 20.9024C13.1192 20.9024 13.4632 20.5584 13.4632 20.1341V12.4512ZM17.3046 11.6829C17.7289 11.6829 18.0729 12.0269 18.0729 12.4512V20.1341C18.0729 20.5584 17.7289 20.9024 17.3046 20.9024C16.8803 20.9024 16.5363 20.5584 16.5363 20.1341V12.4512C16.5363 12.0269 16.8803 11.6829 17.3046 11.6829ZM9.60549 21.3805C9.71982 22.562 10.7127 23.4634 11.8996 23.4634H18.0999C19.2868 23.4634 20.2797 22.562 20.394 21.3805L21.5803 9.12195H8.41916L9.60549 21.3805Z" fill="#ED5554"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination Section --}}
            <div id="pagination-transfer" class="flex justify-between items-center p-4 mt-4">
                <span class="text-base font-regular text-gray-600">
                    Halaman {{ $transfer->currentPage() }} dari {{ $transfer->lastPage() }}
                </span>
                <div class="flex space-x-1 text-base font-semibold">
                    {{-- Previous --}}
                    @if ($transfer->onFirstPage())
                        <button class="px-3 py-1 rounded bg-gray-200 text-gray-500" disabled>&lt;</button>
                    @else
                        <a href="{{ $transfer->previousPageUrl() }}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">&lt;</a>
                    @endif

                    {{-- Page Numbers --}}
                    @for ($i = 1; $i <= $transfer->lastPage(); $i++)
                        @if ($i == $transfer->currentPage())
                            <button class="px-3 py-1 rounded bg-teal-600 text-white">{{ $i }}</button>
                        @else
                            <a href="{{ $transfer->url($i) }}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">{{ $i }}</a>
                        @endif
                    @endfor

                    {{-- Next --}}
                    @if ($transfer->hasMorePages())
                        <a href="{{ $transfer->nextPageUrl() }}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">&gt;</a>
                    @else
                        <button class="px-3 py-1 rounded bg-gray-200 text-gray-500" disabled>&gt;</button>
                    @endif
                </div>
            </div>

            <div id="pagination-cash" class="flex justify-between items-center p-4 mt-4 hidden">
                <span class="text-base font-regular text-gray-600">
                    Halaman {{ $cash->currentPage() }} dari {{ $cash->lastPage() }}
                </span>
                <div class="flex space-x-1 text-base font-semibold">
                    {{-- Previous --}}
                    @if ($cash->onFirstPage())
                        <button class="px-3 py-1 rounded bg-gray-200 text-gray-500" disabled>&lt;</button>
                    @else
                        <a href="{{ $cash->previousPageUrl() }}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">&lt;</a>
                    @endif

                    {{-- Page Numbers --}}
                    @for ($i = 1; $i <= $cash->lastPage(); $i++)
                        @if ($i == $cash->currentPage())
                            <button class="px-3 py-1 rounded bg-teal-600 text-white">{{ $i }}</button>
                        @else
                            <a href="{{ $cash->url($i) }}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">{{ $i }}</a>
                        @endif
                    @endfor

                    {{-- Next --}}
                    @if ($cash->hasMorePages())
                        <a href="{{ $cash->nextPageUrl() }}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">&gt;</a>
                    @else
                        <button class="px-3 py-1 rounded bg-gray-200 text-gray-500" disabled>&gt;</button>
                    @endif
                </div>
            </div>
    </div>

    <!-- Delete Confirmation Drawer -->
    <div id="delete-drawer" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center h-full">
            <div class="bg-white rounded-lg shadow-lg" style="width: 400px; padding: 24px; min-height: 280px;">
                <div class="flex flex-col items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-700 mb-6">Hapus Data</h2>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabTransferBtn = document.getElementById('tab-transfer-btn');
            const tabCashBtn = document.getElementById('tab-cash-btn');
            const searchInput = document.getElementById('search-input');

            function filterTable() {
                const filter = searchInput.value.toLowerCase().trim();
                const activeTab = document.querySelector('.tab-content:not(.hidden)');
                if (!activeTab) return;

                const tableBody = activeTab.querySelector('tbody');
                const rows = tableBody.querySelectorAll('tr');
                let visibleRows = 0;

                rows.forEach(row => {
                    if (row.classList.contains('no-results-message')) {
                        row.remove();
                        return;
                    }
                    const textContent = row.textContent.toLowerCase();
                    if (filter === '' || textContent.includes(filter)) {
                        row.style.display = '';
                        visibleRows++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                const existingMessage = tableBody.querySelector('.no-results-message');
                if (existingMessage) {
                    existingMessage.remove();
                }

                if (visibleRows === 0 && filter !== '') {
                    const noResultsRow = document.createElement('tr');
                    noResultsRow.className = 'no-results-message';
                    noResultsRow.innerHTML = `
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            Tidak ada data yang ditemukan untuk pencarian "${filter}"
                        </td>
                    `;
                    tableBody.appendChild(noResultsRow);
                }
            }

            function setActiveTab(tab) {
                const isTransfer = tab === 'transfer';

                if (isTransfer) {
                    tabTransferBtn.className = 'w-32 py-3 rounded-t-xl bg-white text-emerald-600 z-20 relative';
                    tabCashBtn.className = 'w-32 py-3 rounded-t-xl bg-gray-200 text-gray-400 z-10 -ml-6 relative after:absolute after:top-0 after:left-0 after:w-6 after:h-full after:bg-gray-200 after:z-[-1]';
                } else {
                    tabTransferBtn.className = 'w-32 py-3 rounded-t-xl bg-gray-200 text-gray-400 z-10 relative after:absolute after:top-0 after:right-0 after:w-6 after:h-full after:bg-gray-200 after:z-[-1]';
                    tabCashBtn.className = 'w-32 py-3 rounded-t-xl bg-white text-emerald-600 z-20 relative -ml-6';
                }

                localStorage.setItem('activeTab', tab);

                document.getElementById('tab-transfer').classList.toggle('hidden', !isTransfer);
                document.getElementById('tab-cash').classList.toggle('hidden', isTransfer);

                document.getElementById('pagination-transfer').classList.toggle('hidden', !isTransfer);
                document.getElementById('pagination-cash').classList.toggle('hidden', isTransfer);
                
                filterTable(); // a filter when tab changes
            }

            tabTransferBtn.addEventListener('click', () => setActiveTab('transfer'));
            tabCashBtn.addEventListener('click', () => setActiveTab('cash'));

            const savedTab = localStorage.getItem('activeTab') || 'transfer';
            setActiveTab(savedTab);

            searchInput.addEventListener('input', filterTable);

            const deleteDrawer = document.getElementById('delete-drawer');
            const deleteServiceName = document.getElementById('delete-service-name');
            const deleteConfirmBtn = document.getElementById('delete-confirm');
            const deleteCancelBtn = document.getElementById('delete-cancel');

            let rowToDelete = null;
            let deleteData = null;

            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    const name = this.dataset.name;
                    const tipe = this.dataset.tipe;
                    
                    deleteServiceName.textContent = name;
                    rowToDelete = this.closest('tr');
                    deleteData = { id: id, tipe: tipe };
                    deleteDrawer.classList.remove('hidden');
                });
            });

            deleteConfirmBtn.addEventListener('click', function () {
                if (deleteData && rowToDelete) {
                    deleteConfirmBtn.textContent = 'Menghapus...';
                    deleteConfirmBtn.disabled = true;

                    fetch(`/pesanan/${deleteData.tipe}/${deleteData.id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            rowToDelete.remove();
                            
                            alert('Pesanan berhasil dihapus');
                            
                            setTimeout(() => {
                                window.location.reload();
                            }, 500);
                        } else {
                            alert('Gagal menghapus pesanan: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus pesanan');
                    })
                    .finally(() => {
                        deleteConfirmBtn.textContent = 'Hapus';
                        deleteConfirmBtn.disabled = false;

                        deleteDrawer.classList.add('hidden');
                        rowToDelete = null;
                        deleteData = null;
                    });
                }
            });

            deleteCancelBtn.addEventListener('click', function () {
                deleteDrawer.classList.add('hidden');
                rowToDelete = null;
                deleteData = null;
            });

            // Sorting logic
            const sortableColumns = document.querySelectorAll('.sort-btn');

            sortableColumns.forEach(button => {
                button.addEventListener('click', function() {
                    const column = this.dataset.column;
                    const sortDir = this.dataset.sortDir;
                    const activeTab = document.querySelector('.tab-content:not(.hidden)');
                    if (!activeTab) return;

                    const tableBody = activeTab.querySelector('tbody');
                    const rows = Array.from(tableBody.querySelectorAll('tr:not(.no-results-message)'));

                    const headerRow = this.closest('tr');
                    const colIndex = Array.from(headerRow.children).indexOf(this.closest('th'));

                    if (colIndex === -1) return;

                    rows.sort((a, b) => {
                        const aText = a.cells[colIndex] ? a.cells[colIndex].innerText.trim() : '';
                        const bText = b.cells[colIndex] ? b.cells[colIndex].innerText.trim() : '';

                        let valA = aText;
                        let valB = bText;

                        if (column === 'jadwal') {
                            const parseDate = (dateStr) => {
                                if (!dateStr || dateStr === '-') return new Date(0);
                                const parts = dateStr.split('-'); // m-d-y
                                return new Date('20' + parts[2], parts[0] - 1, parts[1]);
                            };
                            valA = parseDate(aText);
                            valB = parseDate(bText);
                        } else if (column === 'status') {
                            const statusOrder = ['Menunggu', 'Pending', 'Dijadwalkan', 'Berlangsung', 'Selesai', 'Dibatalkan'];
                            valA = statusOrder.indexOf(aText);
                            valB = statusOrder.indexOf(bText);
                        }

                        if (valA < valB) {
                            return sortDir === 'asc' ? -1 : 1;
                        }
                        if (valA > valB) {
                            return sortDir === 'asc' ? 1 : -1;
                        }
                        return 0;
                    });

                    const newSortDir = sortDir === 'asc' ? 'desc' : 'asc';
                    this.dataset.sortDir = newSortDir;

                    document.querySelectorAll('.sort-btn').forEach(btn => {
                        const icon = btn.querySelector('.sort-icon');
                        if (btn === this) {
                            icon.style.transform = sortDir === 'asc' ? 'rotate(180deg)' : 'rotate(0deg)';
                            btn.classList.add('text-gray-900', 'font-bold');
                        } else {
                            btn.dataset.sortDir = 'asc';
                            icon.style.transform = '';
                            btn.classList.remove('text-gray-900', 'font-bold');
                        }
                    });

                    rows.forEach(row => tableBody.appendChild(row));
                });
            });
        });
    </script>
@endsection
""