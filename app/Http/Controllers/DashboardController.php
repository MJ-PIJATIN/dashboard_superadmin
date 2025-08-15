<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Terapis;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total customer
        $totalCustomers = Pelanggan::count();
        
        // Hitung total terapis
        $totalTerapis = Terapis::count();
        
        // Hitung pesanan selesai
        $pesananSelesai = Pesanan::where('status', 'Selesai')->count();
        
        // Hitung pesanan dibatalkan
        $pesananDibatalkan = Pesanan::where('status', 'Dibatalkan')->count();
        
        // Data untuk cards dengan nilai dari database
        $cards = [
            [
                'title' => 'Total Customer',
                'value' => $this->formatNumber($totalCustomers),
                'color' => 'blue',
                'icon' => '<img src="' . asset('images/customer DB.svg') . '" alt="Total Customer" width="64" height="64">',
                'route' => route('pelanggan'),
                'raw_value' => $totalCustomers
            ],
            [
                'title' => 'Total Terapis',
                'value' => $this->formatNumber($totalTerapis),
                'color' => 'blue',
                'icon' => '<img src="' . asset('images/terapis DB.svg') . '" alt="Total Terapis" width="64" height="64">',
                'route' => route('terapis'),
                'raw_value' => $totalTerapis
            ],
            [
                'title' => 'Pesanan Selesai',
                'value' => $this->formatNumber($pesananSelesai),
                'color' => 'green',
                'icon' => '<img src="' . asset('images/selesai DB.svg') . '" alt="Pesanan Selesai" width="64" height="64">',
                'route' => route('pesanan'),
                'raw_value' => $pesananSelesai
            ],
            [
                'title' => 'Pesanan Dibatalkan',
                'value' => $this->formatNumber($pesananDibatalkan),
                'color' => 'red',
                'icon' => '<img src="' . asset('images/dibatalkan DB.svg') . '" alt="Pesanan Dibatalkan" width="64" height="64">',
                'route' => route('pesanan'),
                'raw_value' => $pesananDibatalkan
            ]
        ];
        
        // Data chart pemesanan tahunan
        $chartData = $this->getYearlyOrderData();
        
        // Data layanan terpopuler
        $popularServices = $this->getPopularServices();
        
        // Data pesanan terkini
        $recentOrders = $this->getRecentOrders();
        
        return view('pages.SuperAdminDashboard', compact(
            'cards',
            'chartData',
            'popularServices',
            'recentOrders'
        ));
    }
    
    /**
     * Format angka untuk tampilan (1000 -> 1k, 2500 -> 2.5k)
     */
    private function formatNumber($number)
    {
        if ($number >= 1000000) {
            return round($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return round($number / 1000, 1) . 'k';
        }
        return (string) $number;
    }
    
    /**
     * Ambil data pemesanan tahunan untuk chart
     */
    private function getYearlyOrderData()
    {
        $currentYear = Carbon::now()->year;
        
        // Data pesanan selesai per bulan
        $completedOrders = Pesanan::where('status', 'Selesai')
            ->whereYear('bookings_date', $currentYear)
            ->select(
                DB::raw('MONTH(bookings_date) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();
            
        // Data pesanan dibatalkan per bulan
        $cancelledOrders = Pesanan::where('status', 'Dibatalkan')
            ->whereYear('bookings_date', $currentYear)
            ->select(
                DB::raw('MONTH(bookings_date) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();
        
        // Format data untuk 12 bulan
        $monthlyCompleted = [];
        $monthlyCancelled = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $monthlyCompleted[] = $completedOrders[$i] ?? 0;
            $monthlyCancelled[] = $cancelledOrders[$i] ?? 0;
        }
        
        return [
            'completed' => $monthlyCompleted,
            'cancelled' => $monthlyCancelled,
            'year' => $currentYear
        ];
    }
    
    /**
     * Ambil layanan terpopuler
     */
    private function getPopularServices()
    {
        // Asumsi bahwa ada relasi dengan layanan utama
        $popularServices = Pesanan::join('main_services', 'bookings.main_service_id', '=', 'main_services.id')
            ->select(
                'main_services.name as service_name',
                DB::raw('COUNT(*) as booking_count')
            )
            ->where('bookings.status', 'Selesai')
            ->whereMonth('bookings.bookings_date', Carbon::now()->month)
            ->whereYear('bookings.bookings_date', Carbon::now()->year)
            ->groupBy('main_services.id', 'main_services.name')
            ->orderBy('booking_count', 'desc')
            ->limit(3)
            ->get();
        
        // Jika tidak ada data, gunakan data dummy
        if ($popularServices->isEmpty()) {
            return [
                ['name' => 'Full Body Massage', 'rank' => '#1'],
                ['name' => 'Hot Stone Massage', 'rank' => '#2'],
                ['name' => 'Traditional Massage', 'rank' => '#3']
            ];
        }
        
        // Format data dengan ranking
        $formatted = [];
        foreach ($popularServices as $index => $service) {
            $formatted[] = [
                'name' => $service->service_name,
                'rank' => '#' . ($index + 1),
                'count' => $service->booking_count
            ];
        }
        
        return $formatted;
    }
    
    /**
     * Ambil pesanan terkini (hanya hari ini)
     */
    private function getRecentOrders()
    {
        return Pesanan::with(['customer'])
            ->whereDate('created_at', Carbon::today()) // Filter hanya pesanan hari ini
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'date' => Carbon::parse($order->created_at)->format('d/m/Y'),
                    'time' => Carbon::parse($order->created_at)->format('H:i'), // Tambahkan waktu
                    'customer_name' => $order->customer ? $order->customer->name : 'N/A',
                    'status' => $order->status,
                    'booking_code' => $order->booking_code
                ];
            });
    }
    
    /**
     * API endpoint untuk mendapatkan data chart berdasarkan tahun
     */
    public function getChartData(Request $request)
    {
        $year = $request->get('year', Carbon::now()->year);
        
        // Data pesanan selesai per bulan
        $completedOrders = Pesanan::where('status', 'Selesai')
            ->whereYear('bookings_date', $year)
            ->select(
                DB::raw('MONTH(bookings_date) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();
            
        // Data pesanan dibatalkan per bulan
        $cancelledOrders = Pesanan::where('status', 'Dibatalkan')
            ->whereYear('bookings_date', $year)
            ->select(
                DB::raw('MONTH(bookings_date) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();
        
        // Format data untuk 12 bulan
        $monthlyCompleted = [];
        $monthlyCancelled = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $monthlyCompleted[] = $completedOrders[$i] ?? 0;
            $monthlyCancelled[] = $cancelledOrders[$i] ?? 0;
        }
        
        return response()->json([
            'completed' => $monthlyCompleted,
            'cancelled' => $monthlyCancelled,
            'year' => $year
        ]);
    }
}