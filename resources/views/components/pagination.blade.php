{{-- Komponen Pagination yang dapat digunakan kembali --}}
@props(['paginationData'])

@if($paginationData['total'] > 0 && $paginationData['total_pages'] > 1)
<div class="flex flex-col sm:flex-row justify-between items-center px-4 sm:px-6 py-4 border-t border-gray-200 gap-4">
    <span class="text-sm text-gray-500 order-2 sm:order-1">
        Menampilkan {{ $paginationData['from'] }} sampai {{ $paginationData['to'] }} dari {{ $paginationData['total'] }} hasil
        (Halaman {{ $paginationData['current_page'] }} dari {{ $paginationData['total_pages'] }})
    </span>
    
    <div class="flex items-center gap-1 order-1 sm:order-2">
        <!-- Previous Page -->
        @if($paginationData['current_page'] > 1)
            <a href="{{ request()->fullUrlWithQuery(['page' => $paginationData['current_page'] - 1]) }}" 
               class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                ←
            </a>
        @else
            <span class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded cursor-not-allowed">
                ←
            </span>
        @endif

        <!-- Page Numbers -->
        @php
            $start = max(1, $paginationData['current_page'] - 2);
            $end = min($paginationData['total_pages'], $paginationData['current_page'] + 2);
        @endphp

        @if($start > 1)
            <a href="{{ request()->fullUrlWithQuery(['page' => 1]) }}" 
               class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                1
            </a>
            @if($start > 2)
                <span class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-400">...</span>
            @endif
        @endif

        @for($i = $start; $i <= $end; $i++)
            @if($i == $paginationData['current_page'])
                <span class="w-8 h-8 flex items-center justify-center text-sm font-medium text-white bg-teal-600 rounded">
                    {{ $i }}
                </span>
            @else
                <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}" 
                   class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                    {{ $i }}
                </a>
            @endif
        @endfor

        @if($end < $paginationData['total_pages'])
            @if($end < $paginationData['total_pages'] - 1)
                <span class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-400">...</span>
            @endif
            <a href="{{ request()->fullUrlWithQuery(['page' => $paginationData['total_pages']]) }}" 
               class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                {{ $paginationData['total_pages'] }}
            </a>
        @endif

        <!-- Next Page -->
        @if($paginationData['current_page'] < $paginationData['total_pages'])
            <a href="{{ request()->fullUrlWithQuery(['page' => $paginationData['current_page'] + 1]) }}" 
               class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                →
            </a>
        @else
            <span class="w-8 h-8 flex items-center justify-center text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded cursor-not-allowed">
                →
            </span>
        @endif
    </div>
</div>
@endif