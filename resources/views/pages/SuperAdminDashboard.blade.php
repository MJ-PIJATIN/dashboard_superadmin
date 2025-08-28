@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
@endpush

@section('content')
<div class="bg-gray-100 min-h-screen">
<div class="" style="margin-left: 50px; margin-right: 50px; padding-top: 100px; padding-bottom: 100px;">
    <h1 class="text-xl font-bold text-gray-700 mb-4">Ringkasan</h1>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    @foreach ($cards as $card)
        <div class="bg-white rounded-md p-4 shadow-md border text-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-gray-600 mb-1 whitespace-nowrap">{{ $card['title'] }}</h3>
                    <p class="text-xl text-gray-600">{{ $card['value'] }}</p>
                    <a href="{{ $card['route'] }}" class="text-xs text-teal-500 mt-1 cursor-pointer hover:text-teal-700 hover:underline inline-block">
                        Lihat Selengkapnya
                    </a>
                </div>
                <div class="flex items-center justify-center">
                    {!! $card['icon'] !!}
                </div>
            </div>
        </div>
    @endforeach
</div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="lg:col-span-2 bg-white rounded-md p-4 shadow-md border">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-xl font-semibold text-gray-700">Chart Pemesanan Tahunan</h3>
                <select id="yearSelector" class="border border-gray-300 rounded px-2 py-1 text-xs">
                    @for($year = date('Y'); $year >= date('Y') - 5; $year--)
                        <option value="{{ $year }}" {{ $year == $chartData['year'] ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="relative" style="height: 300px;">
                <canvas id="orderChart" width="400" height="300"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-md p-4 shadow-md border">
            <div class="flex items-center justify-between mb-10">
                <h3 class="text-xl font-semibold text-gray-700">Layanan Terpopuler</h3>
                <span class="font-semibold text-xs text-gray-700">
                    {{ \Carbon\Carbon::now()->format('M Y') }}
                </span>
            </div>
            <div class="space-y-10 text-md">
                @foreach($popularServices as $index => $service)
                    <div class="flex justify-between items-center p-2 bg-white-50 rounded shadow-sm">
                        <span>{{ $service['name'] }}</span>
                        <span class="font-bold 
                            @if($index == 0) text-yellow-400 
                            @elseif($index == 1) text-gray-600 
                            @else text-red-800 
                            @endif">
                            {{ $service['rank'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

<div class="bg-white rounded-md p-4 shadow-md border mt-6 text-sm">
    <h3 class="text-xl font-semibold text-gray-700 mb-4">
        Tabel Pesanan Terkini 
    </h3>
    <div class="overflow-x-auto">
    <table class="min-w-full table-auto border border-gray-400 text-sm">
            <thead>
                <tr class="bg-gray-50 text-left text-xs text-gray-800 uppercase">
                    <th class="px-3 py-2 text-left text-gray-700 border-b border-gray-400 bg-gray-50">#</th>
                    <th class="px-3 py-2 text-left text-gray-700 border-b border-gray-400 bg-gray-50">Tanggal Pesanan</th>
                    <th class="px-3 py-2 text-left text-gray-700 border-b border-gray-400 bg-gray-50">Customer</th>
                    <th class="px-3 py-2 text-left text-gray-700 border-b border-gray-400 bg-gray-50">Status</th>
                    <th class="px-3 py-2 text-center text-gray-700 border-b border-gray-400 bg-gray-50">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-400">
                @forelse($recentOrders as $index => $order)
                    <tr>
                        <td class="px-3 py-2">{{ $index + 1 }}</td>
                        <td class="px-3 py-2">{{ $order['date'] }}</td>
                        <td class="px-3 py-2">{{ $order['customer_name'] }}</td>
                        <td class="px-3 py-2">
                            <div class="flex items-center justify-start">
                                @if($order['status'] == 'Selesai')
                                    <span class="flex items-center justify-start gap-2 bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-[4px] w-[104px]">
                                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                        Selesai
                                    </span>
                                @elseif($order['status'] == 'Dibatalkan')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold" style="border-radius: 5px;">
                                        <span class="w-2 h-2 bg-red-500" style="border-radius: 5px;"></span>
                                        Dibatalkan
                                    </span>
                                @elseif($order['status'] == 'Berlangsung')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold" style="border-radius: 5px;">
                                        <span class="w-2 h-2 bg-blue-500" style="border-radius: 5px;"></span>
                                        Berlangsung
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold" style="border-radius: 5px;">
                                        <span class="w-2 h-2 bg-gray-500" style="border-radius: 5px;"></span>
                                        {{ $order['status'] }}
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-3 py-2 text-center">
                            <a href="{{ route('dashboard.order.detail', $order['id']) }}" class="text-blue-600 hover:text-blue-900 inline-flex items-center justify-center">
                                <img src="{{ asset('images/isi tabel.svg') }}" alt="Detail Pesanan" class="h-5 w-5">
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-3 py-4 text-center text-gray-500">
                            Belum ada pesanan terkini
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 text-right">
        <a href="{{ route('pesanan') }}" class="text-xs text-blue-600 cursor-pointer hover:underline">Lihat Selengkapnya</a>
    </div>
</div>
</div>

@push('scripts')
<script>
    let orderChart = null;
    
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Chart === 'undefined') {
            console.error('Chart.js tidak dimuat!');
            return;
        }

        const ctx = document.getElementById('orderChart');
        if (!ctx) {
            console.error('Canvas dengan ID orderChart tidak ditemukan!');
            return;
        }

        // Data awal dari controller
        const initialData = {
            completed: @json($chartData['completed']),
            cancelled: @json($chartData['cancelled'])
        };

        createChart(initialData);

        // Event listener untuk perubahan tahun
        document.getElementById('yearSelector').addEventListener('change', function() {
            const selectedYear = this.value;
            loadChartData(selectedYear);
        });
    });

    function createChart(data) {
        const ctx = document.getElementById('orderChart');
        
        if (orderChart) {
            orderChart.destroy();
        }

        try {
            orderChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [
                        {
                            label: 'Pesanan Selesai',
                            data: data.completed,
                            borderColor: '#8BC34A',
                            backgroundColor: '#8BC34A',
                            tension: 0.3,
                        },
                        {
                            label: 'Pesanan Dibatalkan',
                            data: data.cancelled,
                            borderColor: '#F44336',
                            backgroundColor: '#F44336',
                            tension: 0.3,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    plugins: {
                        legend: { 
                            display: true,
                            position: 'bottom',
                            align: 'center',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                padding: 20,
                                font: {
                                    size: 12
                                },
                                color: '#666'
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#666',
                                font: { size: 11 }
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                stepSize: 50,
                                color: '#666',
                                font: { size: 11 }
                            }
                        }
                    },
                    elements: {
                        point: { 
                            radius: 0, 
                            hoverRadius: 6,
                            hitRadius: 10
                        }
                    }
                }
            });
            console.log('Chart berhasil dibuat!', orderChart);
        } catch (error) {
            console.error('Error membuat chart:', error);
        }
    }

    function loadChartData(year) {
        fetch(`{{ route('dashboard') }}/chart-data?year=${year}`)
            .then(response => response.json())
            .then(data => {
                createChart(data);
            })
            .catch(error => {
                console.error('Error loading chart data:', error);
            });
    }
</script>
@endpush
@endsection