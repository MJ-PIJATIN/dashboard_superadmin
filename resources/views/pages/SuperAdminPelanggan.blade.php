@extends('layouts.pelanggan')
@section('navtitle', 'Pelanggan')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="" style="margin-left: 50px; padding-top: 100px; padding-bottom: 100px; padding-right: 24px; margin-right: 26px;">
        {{-- Header --}}
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-700">Data Akun Pelanggan</h2>
            </div>
        <div class="bg-white rounded-lg shadow-md p-6">

            {{-- Section Search dan Filter --}}
            <div class="flex items-center justify-between">
                <div class="flex w-[300px] max-w-2xl">
                    <input type="text" id="search-input" placeholder="Cari nomor id, nama, kota, dll"
                        class="flex-grow px-4 py-2.5 text-sm border border-gray-300 rounded-l-lg focus:outline-none focus:ring focus:ring-blue-200" />
                    <button onclick="performSearch()"
                        class="bg-[#469D89] hover:bg-[#378877] text-white px-4 py-2 rounded-r-lg flex items-center justify-center transition-colors">
                        <svg width="18" height="18" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8 0.75C12.0041 0.75 15.25 3.99594 15.25 8C15.25 9.7319 14.6427 11.3219 13.6295 12.5688L18.5303 17.4697C18.8232 17.7626 18.8232 18.2374 18.5303 18.5303C18.2641 18.7966 17.8474 18.8208 17.5538 18.6029L17.4697 18.5303L12.5688 13.6295C11.3219 14.6427 9.7319 15.25 8 15.25C3.99594 15.25 0.75 12.0041 0.75 8C0.75 3.99594 3.99594 0.75 8 0.75ZM8 2.25C4.82436 2.25 2.25 4.82436 2.25 8C2.25 11.1756 4.82436 13.75 8 13.75C11.1756 13.75 13.75 11.1756 13.75 8C13.75 4.82436 11.1756 2.25 8 2.25Z"
                                fill="white" />
                        </svg>
                        <i class="fas fa-search ml-1"></i>
                    </button>
                </div>
            </div>

            {{-- Table Section --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700 border-collapse table-fixed">
                    <thead class="border-b border-gray-300">
                        <tr>
                            <th class="text-left px-6 py-3 font-semibold break-words w-[100px]">#</th>
                            <th class="text-left px-6 py-3 font-semibold break-words w-[240px]">Nama Lengkap</th>
                            <th class="text-left px-6 py-3 font-semibold break-words w-[240px]">Email</th>
                            <th class="text-left px-6 py-3 font-semibold break-words w-[240px]">Kota/Kabupaten</th>
                            <th class="text-left px-6 py-3 font-semibold break-words w-[240px]">Status</th>
                            <th class="text-left px-6 py-3 font-semibold break-words w-[100px]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $pelanggan)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-3 break-words w-[100px]">{{ $index + $data->firstItem() }}</td>
                                <td class="px-6 py-3 break-words w-[240px]">
                                    <div class="flex items-center gap-2">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md 
                                            @if ($pelanggan->gender == '♂️') bg-blue-200 
                                            @elseif ($pelanggan->gender == '♀️') bg-pink-200 
                                            @endif">
                                            @if ($pelanggan->gender == '♂️')
                                                <svg width="16" height="16" fill="#2196F3" viewBox="0 0 16 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10.5865 1.14676C10.5865 0.791723 10.8743 0.503906 11.2294 0.503906H14.6579C15.013 0.503906 15.3008 0.791723 15.3008 1.14676V4.57533C15.3008 4.93038 15.013 5.21819 14.6579 5.21819C14.3029 5.21819 14.0151 4.93038 14.0151 4.57533V2.69483L10.5998 6.0979C11.3955 7.08878 11.8722 8.34824 11.8722 9.71819C11.8722 12.9135 9.28185 15.5039 6.0865 15.5039C2.89113 15.5039 0.300781 12.9135 0.300781 9.71819C0.300781 6.52284 2.89113 3.93248 6.0865 3.93248C7.44815 3.93248 8.70076 4.40349 9.68885 5.19055L13.102 1.78962H11.2294C10.8743 1.78962 10.5865 1.5018 10.5865 1.14676ZM6.0865 5.21819C3.60121 5.21819 1.5865 7.23292 1.5865 9.71819C1.5865 12.2035 3.60121 14.2182 6.0865 14.2182C8.57177 14.2182 10.5865 12.2035 10.5865 9.71819C10.5865 8.47145 10.0804 7.34418 9.26071 6.52849C8.44635 5.718 7.32539 5.21819 6.0865 5.21819Z" />
                                                </svg>
                                            @elseif ($pelanggan->gender == '♀️')
                                                <svg width="11" height="16" fill="#E6007F" viewBox="0 0 11 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.0078125 5.69621C0.0078125 2.82858 2.33249 0.503906 5.20012 0.503906C8.06775 0.503906 10.3924 2.82858 10.3924 5.69621C10.3924 8.36883 8.37316 10.5698 5.77704 10.8568V12.8116H6.73858C7.05721 12.8116 7.31551 13.0699 7.31551 13.3885C7.31551 13.7071 7.05721 13.9654 6.73858 13.9654H5.77704V14.927C5.77704 15.2456 5.51875 15.5039 5.20012 15.5039C4.88149 15.5039 4.6232 15.2456 4.6232 14.927V13.9654H3.66166C3.34303 13.9654 3.08474 13.7071 3.08474 13.3885C3.08474 13.0699 3.34303 12.8116 3.66166 12.8116H4.6232V10.8568C2.02707 10.5698 0.0078125 8.36883 0.0078125 5.69621ZM5.20012 1.65775C2.96974 1.65775 1.16166 3.46583 1.16166 5.69621C1.16166 7.92659 2.96974 9.73468 5.20012 9.73468C7.43049 9.73468 9.23858 7.92659 9.23858 5.69621C9.23858 3.46583 7.4305 1.65775 5.20012 1.65775Z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <span>{{ $pelanggan->nama }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3 break-words w-[240px]">{{ $pelanggan->email }}</td>
                                <td class="px-6 py-3 break-words w-[240px]">{{ $pelanggan->kota }}</td>
                                <td class="px-6 py-3 break-words w-[100px]">
                                    @php
                                        $isActive = $pelanggan->status === 'Aktif';
                                    @endphp
                                    <form method="POST" action="{{ route('pelanggan.toggleStatus', ['id' => $pelanggan->id]) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="flex items-center gap-2 text-sm font-medium px-3 py-1 rounded-[4px] w-[120px]
                                                        {{ $isActive ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                                            <span
                                                class="w-2 h-2 rounded-full {{ $isActive ? 'bg-green-500' : 'bg-yellow-500' }}"></span>
                                            {{ $pelanggan->status }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-3 break-words min-w-[100px]">
                                    <a href="{{ route('detail.akun.pelanggan', ['id' => $pelanggan->id]) }}"
                                        class="hover:text-blue-600" title="Lihat Detail Akun Pelanggan">
                                        <svg width="18" height="18" viewBox="0 0 19 21" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.9103 8.94769C10.633 10.6704 10.8132 13.3515 9.45099 15.2747L9.30957 15.4644L13.5277 19.6835L13.6025 19.7702C13.8272 20.0731 13.8023 20.5026 13.5277 20.7772C13.2532 21.0517 12.8235 21.0767 12.5207 20.8521L12.434 20.7772L8.17677 16.52C6.26097 17.8118 3.63804 17.6101 1.94298 15.915C0.0190071 13.9911 0.0190071 10.8717 1.94298 8.94769C3.86695 7.02376 6.98633 7.02376 8.9103 8.94769ZM10.6307 0C11.2273 0 11.7996 0.236932 12.2216 0.658707L15.034 3.46961L17.8421 6.28199C18.2634 6.70392 18.5 7.2758 18.5 7.87206V17.7532C18.5 18.996 17.4925 20.0036 16.2496 20.0036L14.74 20.0042C14.7026 19.7111 14.5917 19.4249 14.4058 19.1743L14.2848 19.03L13.758 18.5023L16.2496 18.5033C16.6639 18.5033 16.9997 18.1674 16.9997 17.7532L16.9989 8.00442L12.7522 8.00532C11.5611 8.00532 10.5862 7.07999 10.507 5.90899L10.5018 5.75491V1.50027H4.75076C4.33647 1.50027 4.00062 1.83612 4.00062 2.2504L4.00029 6.67236C3.48132 6.79549 2.97573 6.98942 2.49892 7.25417L2.50036 2.2504C2.50036 1.00754 3.5079 0 4.75076 0H10.6307ZM3.03667 10.0414C1.71674 11.3613 1.71674 13.5014 3.03667 14.8213C4.35662 16.1413 6.49666 16.1413 7.8166 14.8213C9.13654 13.5014 9.13654 11.3613 7.8166 10.0414C6.49666 8.72145 4.35662 8.72145 3.03667 10.0414ZM12.002 2.56045V5.75491C12.002 6.13468 12.2843 6.44852 12.6504 6.49819L12.7522 6.50505L15.9437 6.50416L12.002 2.56045Z" fill="#2196F3" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination Section --}}
            @if ($data->lastPage() > 1)
                <div class="flex justify-between items-center mt-4">
                    <span class="text-base font-regular text-gray-600">Halaman {{ $data->currentPage() }} dari {{ $data->lastPage() }}</span>
                    <div class="flex space-x-1 text-base font-semibold">
                        @if ($data->onFirstPage())
                            <button class="px-3 py-1 rounded bg-gray-200 text-gray-500" disabled>&lt;</button>
                        @else
                            <a href="{{ $data->previousPageUrl() }}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">&lt;</a>
                        @endif

                        @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                            <a href="{{ $url }}" class="px-3 py-1 rounded {{ $page == $data->currentPage() ? 'bg-teal-600 text-white' : 'bg-gray-200 hover:bg-gray-300' }}">{{ $page }}</a>
                        @endforeach

                        @if ($data->hasMorePages())
                            <a href="{{ $data->nextPageUrl() }}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">&gt;</a>
                        @else
                            <button class="px-3 py-1 rounded bg-gray-200 text-gray-500" disabled>&gt;</button>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const tbody = document.querySelector('table tbody');
            const paginationContainer = document.querySelector('.flex.justify-between.items-center.mt-4');

            function renderTable(data) {
                tbody.innerHTML = ''; // Clear existing rows
                data.data.forEach((pelanggan, index) => {
                    const row = `
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-3 break-words min-w-[100px]">${index + data.from}</td>
                            <td class="px-6 py-3 break-words min-w-[200px]">
                                <div class="flex items-center gap-2">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md ${pelanggan.gender === '♂️' ? 'bg-blue-200' : 'bg-pink-200'}">
                                        ${pelanggan.gender === '♂️' ? '<svg width="16" height="16" fill="#2196F3" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><path d="M10.5865 1.14676C10.5865 0.791723 10.8743 0.503906 11.2294 0.503906H14.6579C15.013 0.503906 15.3008 0.791723 15.3008 1.14676V4.57533C15.3008 4.93038 15.013 5.21819 14.6579 5.21819C14.3029 5.21819 14.0151 4.93038 14.0151 4.57533V2.69483L10.5998 6.0979C11.3955 7.08878 11.8722 8.34824 11.8722 9.71819C11.8722 12.9135 9.28185 15.5039 6.0865 15.5039C2.89113 15.5039 0.300781 12.9135 0.300781 9.71819C0.300781 6.52284 2.89113 3.93248 6.0865 3.93248C7.44815 3.93248 8.70076 4.40349 9.68885 5.19055L13.102 1.78962H11.2294C10.8743 1.78962 10.5865 1.5018 10.5865 1.14676ZM6.0865 5.21819C3.60121 5.21819 1.5865 7.23292 1.5865 9.71819C1.5865 12.2035 3.60121 14.2182 6.0865 14.2182C8.57177 14.2182 10.5865 12.2035 10.5865 9.71819C10.5865 8.47145 10.0804 7.34418 9.26071 6.52849C8.44635 5.718 7.32539 5.21819 6.0865 5.21819Z" /></svg>' : '<svg width="11" height="16" fill="#E6007F" viewBox="0 0 11 16" xmlns="http://www.w3.org/2000/svg"><path d="M0.0078125 5.69621C0.0078125 2.82858 2.33249 0.503906 5.20012 0.503906C8.06775 0.503906 10.3924 2.82858 10.3924 5.69621C10.3924 8.36883 8.37316 10.5698 5.77704 10.8568V12.8116H6.73858C7.05721 12.8116 7.31551 13.0699 7.31551 13.3885C7.31551 13.7071 7.05721 13.9654 6.73858 13.9654H5.77704V14.927C5.77704 15.2456 5.51875 15.5039 5.20012 15.5039C4.88149 15.5039 4.6232 15.2456 4.6232 14.927V13.9654H3.66166C3.34303 13.9654 3.08474 13.7071 3.08474 13.3885C3.08474 13.0699 3.34303 12.8116 3.66166 12.8116H4.6232V10.8568C2.02707 10.5698 0.0078125 8.36883 0.0078125 5.69621ZM5.20012 1.65775C2.96974 1.65775 1.16166 3.46583 1.16166 5.69621C1.16166 7.92659 2.96974 9.73468 5.20012 9.73468C7.43049 9.73468 9.23858 7.92659 9.23858 5.69621C9.23858 3.46583 7.4305 1.65775 5.20012 1.65775Z" /></svg>'}
                                            </div>
                                            <span>${pelanggan.nama}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-3 break-words min-w-[250px]">${pelanggan.email}</td>
                                    <td class="px-6 py-3 break-words min-w-[150px]">${pelanggan.kota}</td>
                                    <td class="px-6 py-3 break-words min-w-[150px]">
                                        <form method="POST" action="/pelanggan/${pelanggan.id}/toggle-status">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PATCH">
                                            <button type="submit" class="flex items-center gap-2 text-sm font-medium px-3 py-1 rounded-[4px] w-[120px] ${pelanggan.status === 'Aktif' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600'}">
                                                <span class="w-2 h-2 rounded-full ${pelanggan.status === 'Aktif' ? 'bg-green-500' : 'bg-yellow-500'}"></span>
                                                ${pelanggan.status}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-3 break-words min-w-[100px]">
                                        <a href="/pelanggan/${pelanggan.id}" class="hover:text-blue-600" title="Lihat Detail Akun Pelanggan">
                                            <svg width="19" height="21" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.9103 8.94769C10.633 10.6704 10.8132 13.3515 9.45099 15.2747L9.30957 15.4644L13.5277 19.6835L13.6025 19.7702C13.8272 20.0731 13.8023 20.5026 13.5277 20.7772C13.2532 21.0517 12.8235 21.0767 12.5207 20.8521L12.434 20.7772L8.17677 16.52C6.26097 17.8118 3.63804 17.6101 1.94298 15.915C0.0190071 13.9911 0.0190071 10.8717 1.94298 8.94769C3.86695 7.02376 6.98633 7.02376 8.9103 8.94769ZM10.6307 0C11.2273 0 11.7996 0.236932 12.2216 0.658707L15.034 3.46961L17.8421 6.28199C18.2634 6.70392 18.5 7.2758 18.5 7.87206V17.7532C18.5 18.996 17.4925 20.0036 16.2496 20.0036L14.74 20.0042C14.7026 19.7111 14.5917 19.4249 14.4058 19.1743L14.2848 19.03L13.758 18.5023L16.2496 18.5033C16.6639 18.5033 16.9997 18.1674 16.9997 17.7532L16.9989 8.00442L12.7522 8.00532C11.5611 8.00532 10.5862 7.07999 10.507 5.90899L10.5018 5.75491V1.50027H4.75076C4.33647 1.50027 4.00062 1.83612 4.00062 2.2504L4.00029 6.67236C3.48132 6.79549 2.97573 6.98942 2.49892 7.25417L2.50036 2.2504C2.50036 1.00754 3.5079 0 4.75076 0H10.6307ZM3.03667 10.0414C1.71674 11.3613 1.71674 13.5014 3.03667 14.8213C4.35662 16.1413 6.49666 16.1413 7.8166 14.8213C9.13654 13.5014 9.13654 11.3613 7.8166 10.0414C6.49666 8.72145 4.35662 8.72145 3.03667 10.0414ZM12.002 2.56045V5.75491C12.002 6.13468 12.2843 6.44852 12.6504 6.49819L12.7522 6.50505L15.9437 6.50416L12.002 2.56045Z" fill="#2196F3" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        `;
                            tbody.innerHTML += row;
                        });

                        // Update pagination links
                        if (data.last_page > 1) {
                            let paginationHtml = `<span class="text-base font-regular text-gray-600">Halaman ${data.current_page} dari ${data.last_page}</span>
                                <div class="flex space-x-1 text-base font-semibold">`;

                            if (data.current_page > 1) {
                                paginationHtml += `<a href="${data.prev_page_url}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">&lt;</a>`;
                            } else {
                                paginationHtml += `<button class="px-3 py-1 rounded bg-gray-200 text-gray-500" disabled>&lt;</button>`;
                            }

                            data.links.forEach(link => {
                                if (link.url) {
                                    paginationHtml += `<a href="${link.url}" class="px-3 py-1 rounded ${link.active ? 'bg-teal-600 text-white' : 'bg-gray-200 hover:bg-gray-300'}">${link.label}</a>`;
                                } else if (link.label === '...') {
                                    paginationHtml += `<span class="px-2 py-1">...</span>`;
                                } else {
                                    paginationHtml += `<button class="px-3 py-1 rounded bg-gray-200 text-gray-500" disabled>${link.label}</button>`;
                                }
                            });

                            if (data.current_page < data.last_page) {
                                paginationHtml += `<a href="${data.next_page_url}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">&gt;</a>`;
                            } else {
                                paginationHtml += `<button class="px-3 py-1 rounded bg-gray-200 text-gray-500" disabled>&gt;</button>`;
                            }

                            paginationHtml += `</div>`;
                            paginationContainer.innerHTML = paginationHtml;
                            paginationContainer.style.display = 'flex'; // Show pagination
                        } else {
                            paginationContainer.innerHTML = '';
                            paginationContainer.style.display = 'none'; // Hide pagination
                        }
                    });
            }

            searchInput.addEventListener('input', performSearch);
        });
@endsection