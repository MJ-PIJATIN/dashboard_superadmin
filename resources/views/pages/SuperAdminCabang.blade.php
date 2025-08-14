@extends('layouts.cabang')
@section('navtitle', 'Cabang')

@section('content')
    <div class="ml-[26px] mr-[26px] px-6 pt-[96px] pb-[103px] space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-700">Data Cabang</h2>
            <a href="/cabang/tambah">
                <button
                    class="flex items-center gap-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold rounded-lg shadow">
                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.0013 0.166016C13.6036 0.166016 17.3346 3.89697 17.3346 8.49935C17.3346 13.1017 13.6036 16.8327 9.0013 16.8327C4.39893 16.8327 0.667969 13.1017 0.667969 8.49935C0.667969 3.89697 4.39893 0.166016 9.0013 0.166016ZM9.0013 4.33268C8.68489 4.33268 8.42339 4.56781 8.38197 4.87287L8.3763 4.95768V7.87435H5.45964C5.11446 7.87435 4.83464 8.15418 4.83464 8.49935C4.83464 8.81577 5.06976 9.07727 5.37483 9.11868L5.45964 9.12435H8.3763V12.041C8.3763 12.3862 8.65614 12.666 9.0013 12.666C9.31772 12.666 9.57922 12.4308 9.62064 12.1258L9.6263 12.041V9.12435H12.543C12.8881 9.12435 13.168 8.84452 13.168 8.49935C13.168 8.18293 12.9328 7.92143 12.6278 7.88002L12.543 7.87435H9.6263V4.95768C9.6263 4.61251 9.34647 4.33268 9.0013 4.33268Z"
                            fill="white" />
                    </svg>
                    Tambahkan Cabang
                </button>
            </a>
        </div>

        {{-- Section Search dan Filter --}}
        <div class="flex items-center justify-between">
             <div class="flex w-full max-w-sm">
                <input type="text" id="search-input"
                    class="flex-grow px-4 py-2 rounded-l-lg bg-gray-100 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-teal-400 placeholder:text-gray-400"
                    placeholder="Cari cabang...">
                <button class="bg-teal-400 hover:bg-teal-500 text-white px-4 py-2 rounded-r-lg">
                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8 0.75C12.0041 0.75 15.25 3.99594 15.25 8C15.25 9.7319 14.6427 11.3219 13.6295 12.5688L18.5303 17.4697C18.8232 17.7626 18.8232 18.2374 18.5303 18.5303C18.2641 18.7966 17.8474 18.8208 17.5538 18.6029L17.4697 18.5303L12.5688 13.6295C11.3219 14.6427 9.7319 15.25 8 15.25C3.99594 15.25 0.75 12.0041 0.75 8C0.75 3.99594 3.99594 0.75 8 0.75ZM8 2.25C4.82436 2.25 2.25 4.82436 2.25 8C2.25 11.1756 4.82436 13.75 8 13.75C11.1756 13.75 13.75 11.1756 13.75 8C13.75 4.82436 11.1756 2.25 8 2.25Z"
                            fill="white" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700 border-collapse table-fixed">
                <thead class="border-b border-gray-300">
                    <tr>
                        <th class="text-left px-6 py-3 font-semibold break-words min-w-[100px]">#</th>
                        <th class="sort-btn text-left px-6 py-3 font-semibold break-words min-w-[100px] cursor-pointer" data-column="kota" data-sort-dir="asc">
                             <div class="flex items-center">
                                <span>Kota</span>
                                <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="sort-icon h-4 w-4 ml-2 opacity-40 transition-transform duration-200">
                            </div>
                        </th>
                        <th class="sort-btn text-left px-6 py-3 font-semibold break-words min-w-[100px] cursor-pointer" data-column="provinsi" data-sort-dir="asc">
                             <div class="flex items-center">
                                <span>Provinsi</span>
                                <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="sort-icon h-4 w-4 ml-2 opacity-40 transition-transform duration-200">
                            </div>
                        </th>
                        <th class="sort-btn text-left px-6 py-3 font-semibold break-words min-w-[100px] cursor-pointer" data-column="tanggal" data-sort-dir="desc">
                             <div class="flex items-center">
                                <span>Tanggal Peresmian</span>
                                <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="sort-icon h-4 w-4 ml-2 opacity-40 transition-transform duration-200">
                            </div>
                        </th>
                        <th class="sort-btn text-left px-6 py-3 font-semibold break-words min-w-[100px] cursor-pointer" data-column="status" data-sort-dir="asc">
                             <div class="flex items-center">
                                <span>Status Cabang</span>
                                <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="sort-icon h-4 w-4 ml-2 opacity-40 transition-transform duration-200">
                            </div>
                        </th>
                        <th class="sort-btn text-left px-6 py-3 font-semibold break-words min-w-[100px] cursor-pointer" data-column="alamat" data-sort-dir="asc">
                            <div class="flex items-center">
                                <span>Alamat Cabang</span>
                                <img src="{{ asset('images/sort.svg') }}" alt="Sort" class="sort-icon h-4 w-4 ml-2 opacity-40 transition-transform duration-200">
                            </div>
                        </th>
                        <th class="text-left px-6 py-3 font-semibold break-words min-w-[100px]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($branches as $branch)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-3 break-words min-w-[100px]">{{ $branch->branch_code }}</td>
                            <td
                                class="px-6 py-3 break-words min-w-[100px] max-w-[150px] truncate overflow-hidden whitespace-nowrap">
                                {{ $branch->city }}
                            </td>
                            <td
                                class="px-6 py-3 break-words min-w-[100px] max-w-[250px] truncate overflow-hidden whitespace-nowrap">
                                {{ $branch->province }}
                            </td>
                            <td class="px-6 py-3 break-words min-w-[100px]">
                                {{ \Carbon\Carbon::parse($branch->inauguration_date)->format('d-m-Y') }}
                            </td>

                            <td class="px-6 py-3 break-words min-w-[100px]">
                                @php
                                    $isActive = $branch->status === 'Aktif';
                                @endphp
                                <form method="POST" action="{{ route('cabang.toggleStatus', $branch->branch_code) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="flex items-center gap-2 text-sm font-medium px-3 py-1 rounded-[4px] w-[120px]
                                                            {{ $isActive ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                        <span
                                            class="w-2 h-2 rounded-full {{ $isActive ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                        {{ $isActive ? 'Aktif' : 'Tidak Aktif' }}
                                    </button>
                                </form>
                            </td>
                            <td
                                class="px-6 py-3 break-words min-w-[100px] max-w-[300px] truncate overflow-hidden whitespace-nowrap">
                                {{ $branch->address }}
                            </td>
                            <td class="px-6 py-3 break-words min-w-[100px]">
                                <a href="{{ route('cabang.detail', ['id' => $branch->branch_code]) }}"
                                    class="hover:text-blue-600">
                                    <svg width="18" height="18" viewBox="0 0 19 21" fill="none"
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
        <div class="flex justify-between items-center mt-4">
            <span class="text-base font-regular text-gray-600">
                Halaman {{ $branches->currentPage() }} dari {{ $branches->lastPage() }}
            </span>
            <div class="flex space-x-1 text-base font-semibold">
                {{-- Previous --}}
                @if ($branches->onFirstPage())
                    <button class="px-3 py-1 rounded bg-gray-200 text-gray-500" disabled>&lt;</button>
                @else
                    <a href="{{ $branches->previousPageUrl() }}"
                        class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">&lt;</a>
                @endif

                {{-- Page Numbers --}}
                @for ($i = 1; $i <= $branches->lastPage(); $i++)
                    @if ($i == $branches->currentPage())
                        <button class="px-3 py-1 rounded bg-teal-600 text-white">{{ $i }}</button>
                    @else
                        <a href="{{ $branches->url($i) }}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">{{ $i }}</a>
                    @endif
                @endfor

                {{-- Next --}}
                @if ($branches->hasMorePages())
                    <a href="{{ $branches->nextPageUrl() }}" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">&gt;</a>
                @else
                    <button class="px-3 py-1 rounded bg-gray-200 text-gray-500" disabled>&gt;</button>
                @endif
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');

    // Search filter logic
    function filterTable() {
        const filter = searchInput.value.toLowerCase().trim();
        const tableBody = document.querySelector('table tbody');
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
                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                    Tidak ada data yang ditemukan untuk pencarian "${filter}"
                </td>
            `;
            tableBody.appendChild(noResultsRow);
        }
    }

    searchInput.addEventListener('input', filterTable);

    // Sorting logic
    const sortableColumns = document.querySelectorAll('.sort-btn');
    sortableColumns.forEach(th => {
        th.addEventListener('click', function() {
            const column = this.dataset.column;
            const sortDir = this.dataset.sortDir;
            const tableBody = document.querySelector('table tbody');
            const rows = Array.from(tableBody.querySelectorAll('tr:not(.no-results-message)'));

            const headerRow = this.closest('tr');
            const colIndex = Array.from(headerRow.children).indexOf(this);

            if (colIndex === -1) return;

            rows.sort((a, b) => {
                const aText = a.cells[colIndex] ? a.cells[colIndex].innerText.trim() : '';
                const bText = b.cells[colIndex] ? b.cells[colIndex].innerText.trim() : '';

                let valA = aText;
                let valB = bText;

                if (column === 'tanggal') {
                    const parseDate = (dateStr) => {
                        if (!dateStr || dateStr === '-') return new Date(0);
                        const parts = dateStr.split('-'); // d-m-Y
                        return new Date(parts[2], parts[1] - 1, parts[0]);
                    };
                    valA = parseDate(aText);
                    valB = parseDate(bText);
                } else if (column === 'status') {
                    const statusOrder = ['Aktif', 'Tidak Aktif'];
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
                    icon.style.opacity = '1';
                    icon.style.transform = sortDir === 'asc' ? 'rotate(180deg)' : 'rotate(0deg)';
                    btn.classList.add('text-gray-900');
                } else {
                    btn.dataset.sortDir = 'asc';
                    btn.querySelector('.sort-icon').style.opacity = '0.4';
                    btn.querySelector('.sort-icon').style.transform = '';
                    btn.classList.remove('text-gray-900');
                }
            });

            rows.forEach(row => tableBody.appendChild(row));
        });
    });
});
</script>

@endsection