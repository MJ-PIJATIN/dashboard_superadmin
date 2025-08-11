@extends('layouts.karyawan')
@section('navtitle', 'Karyawan')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <!-- Header Judul -->
    <div class="mt-[14px] ml-[26px] mr-[26px] px-6 py-20 bg-gray-100 flex justify-between items-center">
        <h2 class="text-xl font-bold text-gray-700">Data Akun Karyawan</h2>
        <a href="/tambah/karyawan">
            <button
                class="flex items-center gap-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-base font-semibold rounded-lg shadow">
                <svg width="18" height="18" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M9.0013 0.166016C13.6036 0.166016 17.3346 3.89697 17.3346 8.49935C17.3346 13.1017 13.6036 16.8327 9.0013 16.8327C4.39893 16.8327 0.667969 13.1017 0.667969 8.49935C0.667969 3.89697 4.39893 0.166016 9.0013 0.166016ZM9.0013 4.33268C8.68489 4.33268 8.42339 4.56781 8.38197 4.87287L8.3763 4.95768V7.87435H5.45964C5.11446 7.87435 4.83464 8.15418 4.83464 8.49935C4.83464 8.81577 5.06976 9.07727 5.37483 9.11868L5.45964 9.12435H8.3763V12.041C8.3763 12.3862 8.65614 12.666 9.0013 12.666C9.31772 12.666 9.57922 12.4308 9.62064 12.1258L9.6263 12.041V9.12435H12.543C12.8881 9.12435 13.168 8.84452 13.168 8.49935C13.168 8.18293 12.9328 7.92143 12.6278 7.88002L12.543 7.87435H9.6263V4.95768C9.6263 4.61251 9.34647 4.33268 9.0013 4.33268Z"
                        fill="white" />
                </svg>
                Buat Akun Karyawan
            </button>
        </a>
    </div>

    {{-- Tab Header (Admin & Finance) --}}
    <div class="flex text-sm font-semibold mb-0 relative z-10 ml-[50px] mr-[50px] mt-[-60px]">
        <button id="tab-admin-btn" class="w-32 py-3 rounded-t-xl bg-white text-emerald-600 z-20 relative">
            Admin
        </button>
        <button id="tab-finance-btn"
            class="w-32 py-3 rounded-t-xl bg-gray-200 text-gray-400 z-10 -ml-6 relative after:absolute after:top-0 after:left-0 after:w-6 after:h-full after:bg-gray-200 after:z-[-1]">  
            Finance
        </button>
    </div>

    {{-- Card Container --}}
    <div class="bg-white border-gray-200 rounded-b-xl rounded-tr-xl overflow-hidden ml-[50px] mr-[50px]">
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

            {{-- Tab Contents (Admin) --}}
            <div id="tab-admin" class="tab-content">
                <table class="w-full text-sm text-left">
                    <thead class="bg-white border-collapse text-left">
                        <tr>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[100px]">#</th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[220px]">Nama Lengkap</th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[220px]">Tanggal Bergabung</th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[220px]">Ponsel</th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[220px]">Jenis Kelamin</th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[220px]">Area Penempatan</th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[100px]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700" id="admin-tbody">
                        @foreach ($adminEmployees as $index => $employee)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-2">{{ $index + $adminEmployees->firstItem() }}</td>
                                <td class="px-4 py-2">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($employee->joining_date)->format('d M Y') }}</td>
                                <td class="px-4 py-2">{{ $employee->phone }}</td>
                                <td class="px-4 py-2">{{ $employee->gender }}</td>
                                <td class="px-4 py-2">{{ $employee->branch_id }}</td>
                                <td class="px-4 py-2 flex space-x-2 items-center">
                                    <a href="{{ route('detail.karyawan', ['id' => $employee->id]) }}" class="hover:text-blue-600" title="Lihat Detail Akun">
                                        <svg width="18" height="18" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.9103 8.94769C10.633 10.6704 10.8132 13.3515 9.45099 15.2747L9.30957 15.4644L13.5277 19.6835L13.6025 19.7702C13.8272 20.0731 13.8023 20.5026 13.5277 20.7772C13.2532 21.0517 12.8235 21.0767 12.5207 20.8521L12.434 20.7772L8.17677 16.52C6.26097 17.8118 3.63804 17.6101 1.94298 15.915C0.0190071 13.9911 0.0190071 10.8717 1.94298 8.94769C3.86695 7.02376 6.98633 7.02376 8.9103 8.94769ZM10.6307 0C11.2273 0 11.7996 0.236932 12.2216 0.658707L15.034 3.46961L17.8421 6.28199C18.2634 6.70392 18.5 7.2758 18.5 7.87206V17.7532C18.5 18.996 17.4925 20.0036 16.2496 20.0036L14.74 20.0042C14.7026 19.7111 14.5917 19.4249 14.4058 19.1743L14.2848 19.03L13.758 18.5023L16.2496 18.5033C16.6639 18.5033 16.9997 18.1674 16.9997 17.7532L16.9989 8.00442L12.7522 8.00532C11.5611 8.00532 10.5862 7.07999 10.507 5.90899L10.5018 5.75491V1.50027H4.75076C4.33647 1.50027 4.00062 1.83612 4.00062 2.2504L4.00029 6.67236C3.48132 6.79549 2.97573 6.98942 2.49892 7.25417L2.50036 2.2504C2.50036 1.00754 3.5079 0 4.75076 0H10.6307ZM3.03667 10.0414C1.71674 11.3613 1.71674 13.5014 3.03667 14.8213C4.35662 16.1413 6.49666 16.1413 7.8166 14.8213C9.13654 13.5014 9.13654 11.3613 7.8166 10.0414C6.49666 8.72145 4.35662 8.72145 3.03667 10.0414ZM12.002 2.56045V5.75491C12.002 6.13468 12.2843 6.44852 12.6504 6.49819L12.7522 6.50505L15.9437 6.50416L12.002 2.56045Z" fill="#2196F3"/>
                                        </svg>
                                    </a>
                                    <a href="#" class="text-red-500 btn-delete" data-nama="{{ $employee->first_name }} {{ $employee->last_name }}">
                                        <svg width="25" height="25" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.951 7.58537H17.0485C17.0485 6.45386 16.1313 5.53659 14.9998 5.53659C13.8682 5.53659 12.951 6.45386 12.951 7.58537ZM11.4144 7.58537C11.4144 5.60522 13.0196 4 14.9998 4C16.9799 4 18.5851 5.60522 18.5851 7.58537H24.4754C24.8997 7.58537 25.2437 7.92935 25.2437 8.35366C25.2437 8.77797 24.8997 9.12195 24.4754 9.12195H23.1241L21.9235 21.5285C21.733 23.4976 20.0782 25 18.0999 25H11.8996C9.92139 25 8.2666 23.4976 8.07604 21.5285L6.8754 9.12195H5.52415C5.09984 9.12195 4.75586 8.77797 4.75586 8.35366C4.75586 7.92935 5.09984 7.58537 5.52415 7.58537H11.4144ZM13.4632 12.4512C13.4632 12.0269 13.1192 11.6829 12.6949 11.6829C12.2706 11.6829 11.9266 12.0269 11.9266 12.4512V20.1341C11.9266 20.5584 12.2706 20.9024 12.6949 20.9024C13.1192 20.9024 13.4632 20.5584 13.4632 20.1341V12.4512ZM17.3046 11.6829C17.7289 11.6829 18.0729 12.0269 18.0729 12.4512V20.1341C18.0729 20.5584 17.7289 20.9024 17.3046 20.9024C16.8803 20.9024 16.5363 20.5584 16.5363 20.1341V12.4512C16.5363 12.0269 16.8803 11.6829 17.3046 11.6829ZM9.60549 21.3805C9.71982 22.562 10.7127 23.4634 11.8996 23.4634H18.0999C19.2868 23.4634 20.2797 22.562 20.394 21.3805L21.5803 9.12195H8.41916L9.60549 21.3805Z" fill="#ED5554"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination Section for Admin --}}
                <div class="flex justify-between items-center mt-4" id="admin-pagination-container">
                    <span class="text-base font-regular text-gray-600">Halaman {{ $adminEmployees->currentPage() }} dari {{ $adminEmployees->lastPage() }}</span>
                    <div class="flex space-x-1 text-base font-semibold">
                        @if ($adminEmployees->onFirstPage())
                            <button class="px-3 py-1 rounded bg-gray-200 text-gray-500" disabled>&lt;</button>
                        @else
                            <a href="{{ $adminEmployees->previousPageUrl() }}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">&lt;</a>
                        @endif

                        @foreach ($adminEmployees->getUrlRange(1, $adminEmployees->lastPage()) as $page => $url)
                            <a href="{{ $url }}" class="px-3 py-1 rounded {{ $page == $adminEmployees->currentPage() ? 'bg-teal-600 text-white' : 'bg-gray-200 hover:bg-gray-300' }}">{{ $page }}</a>
                        @endforeach

                        @if ($adminEmployees->hasMorePages())
                            <a href="{{ $adminEmployees->nextPageUrl() }}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">&gt;</a>
                        @else
                            <button class="px-3 py-1 rounded bg-gray-200 text-gray-500" disabled>&gt;</button>
                        @endif
                    </div>
                </div>
            </div>
            

            {{-- Tab Contents (Finance) --}}
            <div id="tab-finance-content" class="tab-content hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-white border-collapse text-left">
                        <tr>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[100px]">#</th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[220px]">Nama Lengkap</th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[220px]">Tanggal Bergabung</th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[220px]">Ponsel</th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[220px]">Jenis Kelamin</th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[220px]">Area Penempatan</th>
                            <th class="px-4 py-2 font-bold border-b border-gray-300 w-[100px]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700" id="finance-tbody">
                        @foreach ($financeEmployees as $index => $employee)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-2">{{ $index + $financeEmployees->firstItem() }}</td>
                                <td class="px-4 py-2">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($employee->joining_date)->format('d M Y') }}</td>
                                <td class="px-4 py-2">{{ $employee->phone }}</td>
                                <td class="px-4 py-2">{{ $employee->gender }}</td>
                                <td class="px-4 py-2">{{ $employee->branch_id }}</td>
                                <td class="px-4 py-2 flex space-x-2 items-center">
                                <a href="{{ route('detail.akun.finance', ['id' => $employee->id]) }}" class="hover:text-blue-600" title="Lihat Detail Akun">
                                    <svg width="18" height="18" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.9103 8.94769C10.633 10.6704 10.8132 13.3515 9.45099 15.2747L9.30957 15.4644L13.5277 19.6835L13.6025 19.7702C13.8272 20.0731 13.8023 20.5026 13.5277 20.7772C13.2532 21.0517 12.8235 21.0767 12.5207 20.8521L12.434 20.7772L8.17677 16.52C6.26097 17.8118 3.63804 17.6101 1.94298 15.915C0.0190071 13.9911 0.0190071 10.8717 1.94298 8.94769C3.86695 7.02376 6.98633 7.02376 8.9103 8.94769ZM10.6307 0C11.2273 0 11.7996 0.236932 12.2216 0.658707L15.034 3.46961L17.8421 6.28199C18.2634 6.70392 18.5 7.2758 18.5 7.87206V17.7532C18.5 18.996 17.4925 20.0036 16.2496 20.0036L14.74 20.0042C14.7026 19.7111 14.5917 19.4249 14.4058 19.1743L14.2848 19.03L13.758 18.5023L16.2496 18.5033C16.6639 18.5033 16.9997 18.1674 16.9997 17.7532L16.9989 8.00442L12.7522 8.00532C11.5611 8.00532 10.5862 7.07999 10.507 5.90899L10.5018 5.75491V1.50027H4.75076C4.33647 1.50027 4.00062 1.83612 4.00062 2.2504L4.00029 6.67236C3.48132 6.79549 2.97573 6.98942 2.49892 7.25417L2.50036 2.2504C2.50036 1.00754 3.5079 0 4.75076 0H10.6307ZM3.03667 10.0414C1.71674 11.3613 1.71674 13.5014 3.03667 14.8213C4.35662 16.1413 6.49666 16.1413 7.8166 14.8213C9.13654 13.5014 9.13654 11.3613 7.8166 10.0414C6.49666 8.72145 4.35662 8.72145 3.03667 10.0414ZM12.002 2.56045V5.75491C12.002 6.13468 12.2843 6.44852 12.6504 6.49819L12.7522 6.50505L15.9437 6.50416L12.002 2.56045Z" fill="#2196F3"/>
                                    </svg>
                                </a>
                                <a href="#" class="text-red-500 btn-delete" data-nama="{{ $employee->first_name }} {{ $employee->last_name }}">
                                    <svg width="25" height="25" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.951 7.58537H17.0485C17.0485 6.45386 16.1313 5.53659 14.9998 5.53659C13.8682 5.53659 12.951 6.45386 12.951 7.58537ZM11.4144 7.58537C11.4144 5.60522 13.0196 4 14.9998 4C16.9799 4 18.5851 5.60522 18.5851 7.58537H24.4754C24.8997 7.58537 25.2437 7.92935 25.2437 8.35366C25.2437 8.77797 24.8997 9.12195 24.4754 9.12195H23.1241L21.9235 21.5285C21.733 23.4976 20.0782 25 18.0999 25H11.8996C9.92139 25 8.2666 23.4976 8.07604 21.5285L6.8754 9.12195H5.52415C5.09984 9.12195 4.75586 8.77797 4.75586 8.35366C4.75586 7.92935 5.09984 7.58537 5.52415 7.58537H11.4144ZM13.4632 12.4512C13.4632 12.0269 13.1192 11.6829 12.6949 11.6829C12.2706 11.6829 11.9266 12.0269 11.9266 12.4512V20.1341C11.9266 20.5584 12.2706 20.9024 12.6949 20.9024C13.1192 20.9024 13.4632 20.5584 13.4632 20.1341V12.4512ZM17.3046 11.6829C17.7289 11.6829 18.0729 12.0269 18.0729 12.4512V20.1341C18.0729 20.5584 17.7289 20.9024 17.3046 20.9024C16.8803 20.9024 16.5363 20.5584 16.5363 20.1341V12.4512C16.5363 12.0269 16.8803 11.6829 17.3046 11.6829ZM9.60549 21.3805C9.71982 22.562 10.7127 23.4634 11.8996 23.4634H18.0999C19.2868 23.4634 20.2797 22.562 20.394 21.3805L21.5803 9.12195H8.41916L9.60549 21.3805Z" fill="#ED5554"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination Section for Finance --}}
                <div class="flex justify-between items-center mt-4" id="finance-pagination-container">
                    <span class="text-base font-regular text-gray-600">Halaman {{ $financeEmployees->currentPage() }} dari {{ $financeEmployees->lastPage() }}</span>
                    <div class="flex space-x-1 text-base font-semibold">
                        @if ($financeEmployees->onFirstPage())
                            <button class="px-3 py-1 rounded bg-gray-200 text-gray-500" disabled>&lt;</button>
                        @else
                            <a href="{{ $financeEmployees->previousPageUrl() }}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">&lt;</a>
                        @endif

                        @foreach ($financeEmployees->getUrlRange(1, $financeEmployees->lastPage()) as $page => $url)
                            <a href="{{ $url }}" class="px-3 py-1 rounded {{ $page == $financeEmployees->currentPage() ? 'bg-teal-600 text-white' : 'bg-gray-200 hover:bg-gray-300' }}">{{ $page }}</a>
                        @endforeach

                        @if ($financeEmployees->hasMorePages())
                            <a href="{{ $financeEmployees->nextPageUrl() }}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">&gt;</a>
                        @else
                            <button class="px-3 py-1 rounded bg-gray-200 text-gray-500" disabled>&gt;</button>
                        @endif
                    </div>
                </div>
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

{{-- Script Tab Switching --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabAdminBtn = document.getElementById('tab-admin-btn');
    const tabFinanceBtn = document.getElementById('tab-finance-btn');
    const adminContent = document.getElementById('tab-admin');
    const financeContent = document.getElementById('tab-finance-content');
    const adminTbody = document.getElementById('admin-tbody');
    const financeTbody = document.getElementById('finance-tbody');
    const adminPaginationContainer = document.getElementById('admin-pagination-container');
    const financePaginationContainer = document.getElementById('finance-pagination-container');
    const searchInput = document.getElementById('searchInput');

    let activeTab = localStorage.getItem('activeTabKaryawan') || 'admin';

    function renderTable(tbodyElement, data, type) {
        tbodyElement.innerHTML = '';
        data.data.forEach((employee, index) => {
            // Format tanggal dengan benar
            const joinDate = new Date(employee.joining_date);
            const formattedDate = joinDate.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });

            const row = `
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-2">${index + data.from}</td>
                    <td class="px-4 py-2">${employee.first_name} ${employee.last_name}</td>
                    <td class="px-4 py-2">${formattedDate}</td>
                    <td class="px-4 py-2">${employee.phone}</td>
                    <td class="px-4 py-2">${employee.gender}</td>
                    <td class="px-4 py-2">${employee.branch_id}</td>
                    <td class="px-4 py-2 flex space-x-2 items-center">
                        <a href="/${type === 'admin' ? 'detail/karyawan' : 'detail/akun/finance'}/${employee.id}" class="hover:text-blue-600" title="Lihat Detail Akun">
                            <svg width="18" height="18" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.9103 8.94769C10.633 10.6704 10.8132 13.3515 9.45099 15.2747L9.30957 15.4644L13.5277 19.6835L13.6025 19.7702C13.8272 20.0731 13.8023 20.5026 13.5277 20.7772C13.2532 21.0517 12.8235 21.0767 12.5207 20.8521L12.434 20.7772L8.17677 16.52C6.26097 17.8118 3.63804 17.6101 1.94298 15.915C0.0190071 13.9911 0.0190071 10.8717 1.94298 8.94769C3.86695 7.02376 6.98633 7.02376 8.9103 8.94769ZM10.6307 0C11.2273 0 11.7996 0.236932 12.2216 0.658707L15.034 3.46961L17.8421 6.28199C18.2634 6.70392 18.5 7.2758 18.5 7.87206V17.7532C18.5 18.996 17.4925 20.0036 16.2496 20.0036L14.74 20.0042C14.7026 19.7111 14.5917 19.4249 14.4058 19.1743L14.2848 19.03L13.758 18.5023L16.2496 18.5033C16.6639 18.5033 16.9997 18.1674 16.9997 17.7532L16.9989 8.00442L12.7522 8.00532C11.5611 8.00532 10.5862 7.07999 10.507 5.90899L10.5018 5.75491V1.50027H4.75076C4.33647 1.50027 4.00062 1.83612 4.00062 2.2504L4.00029 6.67236C3.48132 6.79549 2.97573 6.98942 2.49892 7.25417L2.50036 2.2504C2.50036 1.00754 3.5079 0 4.75076 0H10.6307ZM3.03667 10.0414C1.71674 11.3613 1.71674 13.5014 3.03667 14.8213C4.35662 16.1413 6.49666 16.1413 7.8166 14.8213C9.13654 13.5014 9.13654 11.3613 7.8166 10.0414C6.49666 8.72145 4.35662 8.72145 3.03667 10.0414ZM12.002 2.56045V5.75491C12.002 6.13468 12.2843 6.44852 12.6504 6.49819L12.7522 6.50505L15.9437 6.50416L12.002 2.56045Z" fill="#2196F3"/>
                            </svg>
                        </a>
                        <a href="#" class="text-red-500 btn-delete" data-nama="${employee.first_name} ${employee.last_name}">
                            <svg width="25" height="25" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.951 7.58537H17.0485C17.0485 6.45386 16.1313 5.53659 14.9998 5.53659C13.8682 5.53659 12.951 6.45386 12.951 7.58537ZM11.4144 7.58537C11.4144 5.60522 13.0196 4 14.9998 4C16.9799 4 18.5851 5.60522 18.5851 7.58537H24.4754C24.8997 7.58537 25.2437 7.92935 25.2437 8.35366C25.2437 8.77797 24.8997 9.12195 24.4754 9.12195H23.1241L21.9235 21.5285C21.733 23.4976 20.0782 25 18.0999 25H11.8996C9.92139 25 8.2666 23.4976 8.07604 21.5285L6.8754 9.12195H5.52415C5.09984 9.12195 4.75586 8.77797 4.75586 8.35366C4.75586 7.92935 5.09984 7.58537 5.52415 7.58537H11.4144ZM13.4632 12.4512C13.4632 12.0269 13.1192 11.6829 12.6949 11.6829C12.2706 11.6829 11.9266 12.0269 11.9266 12.4512V20.1341C11.9266 20.5584 12.2706 20.9024 12.6949 20.9024C13.1192 20.9024 13.4632 20.5584 13.4632 20.1341V12.4512ZM17.3046 11.6829C17.7289 11.6829 18.0729 12.0269 18.0729 12.4512V20.1341C18.0729 20.5584 17.7289 20.9024 17.3046 20.9024C16.8803 20.9024 16.5363 20.5584 16.5363 20.1341V12.4512C16.5363 12.0269 16.8803 11.6829 17.3046 11.6829ZM9.60549 21.3805C9.71982 22.562 10.7127 23.4634 11.8996 23.4634H18.0999C19.2868 23.4634 20.2797 22.562 20.394 21.3805L21.5803 9.12195H8.41916L9.60549 21.3805Z" fill="#ED5554"/>
                            </svg>
                        </a>
                    </td>
                </tr>
            `;
            tbodyElement.innerHTML += row;
        });

        // Update pagination links - always show pagination
        const paginationContainer = type === 'admin' ? adminPaginationContainer : financePaginationContainer;
        
        // Always show pagination regardless of page count
        let paginationHtml = `<span class="text-base font-regular text-gray-600">Halaman ${data.current_page} dari ${data.last_page}</span>
            <div class="flex space-x-1 text-base font-semibold">`;

        if (data.current_page > 1) {
            paginationHtml += `<a href="#" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 pagination-link" data-page="${data.current_page - 1}">&lt;</a>`;
        } else {
            paginationHtml += `<button class="px-3 py-1 rounded bg-gray-200 text-gray-500" disabled>&lt;</button>`;
        }

        for (let page = 1; page <= data.last_page; page++) {
            paginationHtml += `<a href="#" class="px-3 py-1 rounded ${page === data.current_page ? 'bg-teal-600 text-white' : 'bg-gray-200 hover:bg-gray-300'} pagination-link" data-page="${page}">${page}</a>`;
        }

        if (data.current_page < data.last_page) {
            paginationHtml += `<a href="#" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 pagination-link" data-page="${data.current_page + 1}">&gt;</a>`;
        } else {
            paginationHtml += `<button class="px-3 py-1 rounded bg-gray-200 text-gray-500" disabled>&gt;</button>`;
        }

        paginationHtml += `</div>`;
        paginationContainer.innerHTML = paginationHtml;
        paginationContainer.style.display = 'flex';

        // Re-attach delete event listeners
        attachDeleteListeners();
    }

    async function loadKaryawanData(page = 1, filter = '') {
        try {
            const url = `{{ route('karyawan.search') }}?filter=${filter}&role=${activeTab}&page=${page}`;
            const response = await fetch(url);
            const data = await response.json();
            
            if (activeTab === 'admin') {
                renderTable(adminTbody, data, 'admin');
            } else {
                renderTable(financeTbody, data, 'finance');
            }
        } catch (error) {
            console.error('Error loading data:', error);
        }
    }

    function setActiveTabVisual(tab) {
        const isAdmin = tab === 'admin';
        activeTab = tab;

        // Set active tab button styles
        if (isAdmin) {
            tabAdminBtn.className = 'w-32 py-3 rounded-t-xl bg-white text-emerald-600 z-20 relative';
            tabFinanceBtn.className = 'w-32 py-3 rounded-t-xl bg-gray-200 text-gray-400 z-10 -ml-6 relative after:absolute after:top-0 after:left-0 after:w-6 after:h-full after:bg-gray-200 after:z-[-1]';
        } else {
            tabAdminBtn.className = 'w-32 py-3 rounded-t-xl bg-gray-200 text-gray-400 z-10 relative after:absolute after:top-0 after:right-0 after:w-6 after:h-full after:bg-gray-200 after:z-[-1]';
            tabFinanceBtn.className = 'w-32 py-3 rounded-t-xl bg-white text-emerald-600 z-20 relative -ml-6';
        }

        // Save active tab
        localStorage.setItem('activeTabKaryawan', tab);

        // Show/hide content and pagination
        adminContent.classList.toggle('hidden', !isAdmin);
        financeContent.classList.toggle('hidden', isAdmin);
        
        // Show/hide pagination containers
        adminPaginationContainer.classList.toggle('hidden', !isAdmin);
        financePaginationContainer.classList.toggle('hidden', isAdmin);
    }

    function setActiveTab(tab) {
        setActiveTabVisual(tab);
        
        // Load data for the active tab only when switching
        const filter = searchInput.value.toLowerCase();
        loadKaryawanData(1, filter);
    }

    function attachDeleteListeners() {
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.removeEventListener('click', handleDeleteClick);
            button.addEventListener('click', handleDeleteClick);
        });
    }

    function handleDeleteClick(event) {
        event.preventDefault();
        const nama = this.dataset.nama;
        deleteServiceName.textContent = nama;
        rowToDelete = this.closest('tr');
        deleteDrawer.classList.remove('hidden');
    }

    // Initial setup without loading data (data already rendered from server)
    setActiveTabVisual(activeTab);

    // Event listeners
    tabAdminBtn.addEventListener('click', () => setActiveTab('admin'));
    tabFinanceBtn.addEventListener('click', () => setActiveTab('finance'));

    searchInput.addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        loadKaryawanData(1, filter);
    });

    // Handle pagination clicks
    document.addEventListener('click', function(event) {
        if (event.target.matches('.pagination-link')) {
            event.preventDefault();
            const page = event.target.dataset.page;
            const filter = searchInput.value.toLowerCase();
            loadKaryawanData(page, filter);
        }
    });

    // Delete confirmation functionality
    const deleteDrawer = document.getElementById('delete-drawer');
    const deleteServiceName = document.getElementById('delete-service-name');
    const deleteConfirmBtn = document.getElementById('delete-confirm');
    const deleteCancelBtn = document.getElementById('delete-cancel');
    let rowToDelete = null;

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

    // Initial attachment of delete listeners
    attachDeleteListeners();
});

// Function for search button (if needed)
function performSearch() {
    const searchInput = document.getElementById('searchInput');
    const filter = searchInput.value.toLowerCase();
    // Trigger the same search as input event
    searchInput.dispatchEvent(new Event('input'));
}
</script>
@endsection