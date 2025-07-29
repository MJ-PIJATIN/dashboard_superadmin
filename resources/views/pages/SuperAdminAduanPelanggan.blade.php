@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Ringkasan statistik dan aktivitas terkini sistem Pijat.in')
@section('navtitle', 'Aduan Pelanggan')
@section('navsubtitle', 'Data Aduan dari Pelanggan')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 xl:ml-6 xl:px-6 py-6 sm:py-8 lg:py-16 xl:py-24">
        <h1 class="text-lg sm:text-xl font-bold text-gray-700 mb-4 sm:mb-6">Data Aduan Pelanggan</h1>

        <!-- Search Results Info -->
        @if(request('search'))
            <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <p class="text-sm text-green-800">
                    Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
                    ({{ $paginationData['total'] }} hasil ditemukan)
                </p>
            </div>
        @endif

        <!-- Main Container -->
        <div class="w-full bg-white rounded-lg shadow-sm">
            <!-- Search Section -->
            <div class="p-4 sm:p-6 pb-4">
                <form method="GET" action="{{ route('aduan-pelanggan') }}" class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex w-full sm:w-[300px] max-w-full">
                        <input
                            type="text"
                            name="search"
                            id="searchInput"
                            value="{{ request('search') }}"
                            placeholder="Cari nama pelapor, jenis aduan, dll"
                            class="flex-grow px-3 sm:px-4 py-2 sm:py-2.5 text-sm border border-gray-300 rounded-l-lg focus:outline-none focus:ring focus:ring-blue-200"/>
                        <button type="submit" class="bg-[#469D89] hover:bg-[#378877] text-white px-3 sm:px-4 py-2 rounded-r-lg flex items-center justify-center transition-colors flex-shrink-0">
                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5">
                                <path
                                    d="M8 0.75C12.0041 0.75 15.25 3.99594 15.25 8C15.25 9.7319 14.6427 11.3219 13.6295 12.5688L18.5303 17.4697C18.8232 17.7626 18.8232 18.2374 18.5303 18.5303C18.2641 18.7966 17.8474 18.8208 17.5538 18.6029L17.4697 18.5303L12.5688 13.6295C11.3219 14.6427 9.7319 15.25 8 15.25C3.99594 15.25 0.75 12.0041 0.75 8C0.75 3.99594 3.99594 0.75 8 0.75ZM8 2.25C4.82436 2.25 2.25 4.82436 2.25 8C2.25 11.1756 4.82436 13.75 8 13.75C11.1756 13.75 13.75 11.1756 13.75 8C13.75 4.82436 11.1756 2.25 8 2.25Z"
                                    fill="white"
                                />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-lg mt-0 shadow-lg">
                <div class="overflow-x-auto p-2">
                    @if(count($paginatedAduan) > 0)
                        <table class="min-w-full text-sm text-gray-700">
                            <thead class="bg-white">
                                <tr class="bg-white">
                                    <th class="px-10 py-4 text-left text-sm font-medium text-gray-700 whitespace-nowrap">Nama Pelapor</th>
                                    <th class="translate-x-[-60px] py-4 text-left text-sm font-medium text-gray-700 whitespace-nowrap">Alasan Aduan</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="px-1 pt-0 pb-3">
                                        <div class="h-px bg-gray-700 mx-4"></div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="aduTableBody">
                                @foreach ($paginatedAduan as $adu)
                                <tr class="group cursor-pointer transition-transform duration-200 transform hover:scale-[1.01] hover:bg-gray-50 hover:ring-[0.5px] hover:ring-gray-200 hover:ring-offset-0 hover:shadow-sm hover:rounded-md"
                                    onclick="window.location.href='{{ route('detiladuan', ['id' => $adu['id']]) }}'">
                                    <td class="px-10 py-4" data-field="nama_pelapor">{{ $adu['nama_pelapor'] }}</td>
                                    <td class="translate-x-[-60px] py-4 max-w-lg">
                                        <div class="text-sm text-gray-700">
                                            <span class="font-bold text-gray-600">{{ $adu['jenis_aduan'] }}</span>
                                            <span class="text-gray-700 mx-2">•</span>
                                            <span class="text-gray-600">{{ Str::limit($adu['deskripsi'], 80, '...') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-14 py-4 text-sm text-gray-500 relative">
                                        <div class="flex items-center justify-between">
                                              <!-- Waktu - tampil normal, hilang saat hover -->
                                            <span class="absolute inset-0 flex items-center justify-center group-hover:opacity-0 transition-opacity duration-200">
                                                {{ $adu['waktu'] }}
                                            </span>
                                            
                                            <!-- Buttons - tersembunyi normal, muncul saat hover -->
                                            <div class="absolute inset-0 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                <button onclick="showAlert('peringatan'); event.stopPropagation();"
                                                    title="Beri Peringatan"
                                                    class="flex items-center justify-center transition duration-200 hover:bg-yellow-200 rounded-md p-1">
                                                    <img src="/images/peringatan.svg" alt="Peringatan" class="w-4 h-4" />
                                                </button>
                                                <button onclick="showAlert('tangguhkan'); event.stopPropagation();"
                                                    title="Tangguhkan"
                                                    class="flex items-center justify-center transition duration-200 hover:bg-red-200 rounded-md p-1">
                                                    <img src="/images/tangguhkan.svg" alt="Tangguhkan" class="w-4 h-4" />
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <!-- Empty State -->
                        <div class="flex flex-col items-center justify-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-400 mb-2">Tidak ada hasil ditemukan</h3>
                            <p class="text-sm text-gray-400 mb-4">
                                @if(request('search'))
                                    Coba gunakan kata kunci yang berbeda atau 
                                    <a href="{{ route('aduan-pelanggan') }}" class="text-blue-600 hover:text-blue-800 underline">hapus filter pencarian</a>
                                @else
                                    Belum ada data aduan yang tersedia
                                @endif
                            </p>
                        </div>
                    @endif

                    <!-- Pagination -->
                    @if($paginationData['total'] > 0)
                        <div class="flex flex-col sm:flex-row justify-between items-center px-8 sm:px-9 py-4 border-gray-200 gap-4">
                        <span class="text-sm text-gray-500 order-2 sm:order-1">
                            Halaman {{ $paginationData['current_page'] }} dari {{ $paginationData['total_pages'] }}
                        </span>
                            
                            @if($paginationData['total_pages'] > 1)
                                <div class="flex items-center gap-1 order-1 sm:order-2">
                                    <!-- Previous Page -->
                                    @if($paginationData['current_page'] > 1)
                                        <a href="{{ request()->fullUrlWithQuery(['page' => $paginationData['current_page'] - 1]) }}" 
                                           class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">
                                            ←
                                        </a>
                                    @endif

                                    <!-- Page Numbers -->
                                    @php
                                        $start = max(1, $paginationData['current_page'] - 2);
                                        $end = min($paginationData['total_pages'], $paginationData['current_page'] + 2);
                                    @endphp

                                    @if($start > 1)
                                        <a href="{{ request()->fullUrlWithQuery(['page' => 1]) }}" 
                                           class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">
                                            1
                                        </a>
                                        @if($start > 2)
                                            <span class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700">...</span>
                                        @endif
                                    @endif

                                    @for($i = $start; $i <= $end; $i++)
                                        @if($i == $paginationData['current_page'])
                                            <span class="w-8 h-8 flex items-center justify-center text-sm font-medium text-white bg-teal-600 rounded">
                                                {{ $i }}
                                            </span>
                                        @else
                                            <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}" 
                                               class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">
                                                {{ $i }}
                                            </a>
                                        @endif
                                    @endfor

                                    @if($end < $paginationData['total_pages'])
                                        @if($end < $paginationData['total_pages'] - 1)
                                            <span class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700">...</span>
                                        @endif
                                        <a href="{{ request()->fullUrlWithQuery(['page' => $paginationData['total_pages']]) }}" 
                                           class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">
                                            {{ $paginationData['total_pages'] }}
                                        </a>
                                    @endif

                                    <!-- Next Page -->
                                    @if($paginationData['current_page'] < $paginationData['total_pages'])
                                        <a href="{{ request()->fullUrlWithQuery(['page' => $paginationData['current_page'] + 1]) }}" 
                                           class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">
                                            →
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
// Fungsi untuk menampilkan alert
function showAlert(type) {
    if (type === 'peringatan') {
        alert('Fitur peringatan belum tersedia.');
    } else if (type === 'tangguhkan') {
        alert('Fitur penangguhan belum tersedia.');
    }
}

// Auto-submit form on Enter key
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            this.closest('form').submit();
        }
    });
});
</script>
@endsection

@endsection