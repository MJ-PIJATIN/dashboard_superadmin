<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Terapis;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = Pelanggan::count();
        
        $totalTerapis = Terapis::count();
        
        $pesananSelesai = Pesanan::where('status', 'Selesai')->count();
        
        $pesananDibatalkan = Pesanan::where('status', 'Dibatalkan')->count();
        
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
                'title' => 'Total Pesanan Selesai',
                'value' => $this->formatNumber($pesananSelesai),
                'color' => 'green',
                'icon' => '<img src="' . asset('images/selesai DB.svg') . '" alt="Pesanan Selesai" width="64" height="64">',
                'route' => route('pesanan'),
                'raw_value' => $pesananSelesai
            ],
            [
                'title' => 'Total Pesanan Dibatalkan',
                'value' => $this->formatNumber($pesananDibatalkan),
                'color' => 'red',
                'icon' => '<img src="' . asset('images/dibatalkan DB.svg') . '" alt="Pesanan Dibatalkan" width="64" height="64">',
                'route' => route('pesanan'),
                'raw_value' => $pesananDibatalkan
            ]
        ];
        
        $chartData = $this->getYearlyOrderData();
        
        $popularServices = $this->getPopularServices();
        
        $recentOrders = $this->getRecentOrders();
        
        // Debug log untuk memeriksa data
        Log::info("Dashboard - Recent orders count: " . $recentOrders->count());
        Log::info("Dashboard - Recent orders data: " . $recentOrders->toJson());
        
        return view('pages.SuperAdminDashboard', compact(
            'cards',
            'chartData',
            'popularServices',
            'recentOrders'
        ));
    }
    
    private function formatNumber($number)
    {
        if ($number >= 1000000) {
            return round($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return round($number / 1000, 1) . 'k';
        }
        return (string) $number;
    }
    
    private function getYearlyOrderData()
    {
        $currentYear = Carbon::now()->year;
        
        try {
            $completedOrders = Pesanan::where('status', 'Selesai')
                ->whereYear('bookings_date', $currentYear)
                ->select(
                    DB::raw('MONTH(bookings_date) as month'),
                    DB::raw('COUNT(*) as count')
                )
                ->groupBy('month')
                ->pluck('count', 'month')
                ->toArray();
                
            $cancelledOrders = Pesanan::where('status', 'Dibatalkan')
                ->whereYear('bookings_date', $currentYear)
                ->select(
                    DB::raw('MONTH(bookings_date) as month'),
                    DB::raw('COUNT(*) as count')
                )
                ->groupBy('month')
                ->pluck('count', 'month')
                ->toArray();
        } catch (\Exception $e) {
            Log::error("Error getting yearly data: " . $e->getMessage());
            $completedOrders = [];
            $cancelledOrders = [];
        }
        
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
    
private function getPopularServices()
{
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;
    
    try {
        // Gabungkan data dari main_services dan additional_services
        $mainServices = DB::table('bookings')
            ->join('main_services', 'bookings.main_service_id', '=', 'main_services.id')
            ->select(
                'main_services.name as service_name',
                DB::raw('COUNT(*) as booking_count'),
                DB::raw("'main' as service_type")
            )
            ->where('bookings.status', 'Selesai')
            ->whereMonth('bookings.bookings_date', $currentMonth)
            ->whereYear('bookings.bookings_date', $currentYear)
            ->whereNotNull('bookings.main_service_id')
            ->groupBy('main_services.id', 'main_services.name');

        $additionalServices = DB::table('bookings')
            ->join('additional_services', 'bookings.additional_service_id', '=', 'additional_services.id')
            ->select(
                'additional_services.name as service_name',
                DB::raw('COUNT(*) as booking_count'),
                DB::raw("'additional' as service_type")
            )
            ->where('bookings.status', 'Selesai')
            ->whereMonth('bookings.bookings_date', $currentMonth)
            ->whereYear('bookings.bookings_date', $currentYear)
            ->whereNotNull('bookings.additional_service_id')
            ->groupBy('additional_services.id', 'additional_services.name');

        // Gabungkan kedua query menggunakan UNION
        $popularServices = $mainServices
            ->union($additionalServices)
            ->get()
            ->groupBy('service_name')
            ->map(function ($group) {
                return (object) [
                    'service_name' => $group->first()->service_name,
                    'booking_count' => $group->sum('booking_count'),
                    'service_types' => $group->pluck('service_type')->unique()->toArray()
                ];
            })
            ->sortByDesc('booking_count')
            ->take(3)
            ->values();
            
        // Jika query di atas tidak berhasil, gunakan model sebagai fallback
        if ($popularServices->isEmpty()) {
            // Fallback menggunakan Eloquent
            $mainServiceBookings = Pesanan::with('mainService')
                ->where('status', 'Selesai')
                ->whereMonth('bookings_date', $currentMonth)
                ->whereYear('bookings_date', $currentYear)
                ->whereNotNull('main_service_id')
                ->select('main_service_id', DB::raw('COUNT(*) as booking_count'))
                ->groupBy('main_service_id')
                ->get()
                ->map(function ($booking) {
                    return (object) [
                        'service_name' => $booking->mainService ? $booking->mainService->name : 'N/A',
                        'booking_count' => $booking->booking_count,
                        'service_type' => 'main'
                    ];
                });

            $additionalServiceBookings = Pesanan::with('additionalService')
                ->where('status', 'Selesai')
                ->whereMonth('bookings_date', $currentMonth)
                ->whereYear('bookings_date', $currentYear)
                ->whereNotNull('additional_service_id')
                ->select('additional_service_id', DB::raw('COUNT(*) as booking_count'))
                ->groupBy('additional_service_id')
                ->get()
                ->map(function ($booking) {
                    return (object) [
                        'service_name' => $booking->additionalService ? $booking->additionalService->name : 'N/A',
                        'booking_count' => $booking->booking_count,
                        'service_type' => 'additional'
                    ];
                });

            // Gabungkan dan kelompokkan berdasarkan nama service
            $allServices = $mainServiceBookings->concat($additionalServiceBookings);
            
            $popularServices = $allServices
                ->groupBy('service_name')
                ->map(function ($group) {
                    return (object) [
                        'service_name' => $group->first()->service_name,
                        'booking_count' => $group->sum('booking_count'),
                        'service_types' => $group->pluck('service_type')->unique()->toArray()
                    ];
                })
                ->sortByDesc('booking_count')
                ->take(3)
                ->values();
        }
        
        $formatted = [];
        foreach ($popularServices as $index => $service) {
            // Tambahkan indikator jenis layanan jika diperlukan
            $serviceTypeIndicator = '';
            if (isset($service->service_types)) {
                if (count($service->service_types) > 1) {
                    $serviceTypeIndicator = ' (Main + Add-on)';
                } elseif (in_array('additional', $service->service_types)) {
                    $serviceTypeIndicator = '';
                }
            }
            
            $formatted[] = [
                'name' => $service->service_name . $serviceTypeIndicator,
                'rank' => '#' . ($index + 1),
                'count' => $service->booking_count
            ];
        }
        
        // Jika tidak ada data
        if (empty($formatted)) {
            return [
                ['name' => 'Belum ada pesanan bulan ini', 'rank' => '#1', 'count' => 0],
                ['name' => 'Belum ada pesanan bulan ini', 'rank' => '#2', 'count' => 0],
                ['name' => 'Belum ada pesanan bulan ini', 'rank' => '#3', 'count' => 0]
            ];
        }
        
        // Pastikan selalu ada 3 item
        while (count($formatted) < 3) {
            $formatted[] = [
                'name' => '-',
                'rank' => '#' . (count($formatted) + 1),
                'count' => 0
            ];
        }
        
        return $formatted;
        
    } catch (\Exception $e) {
        Log::error("Error getting popular services: " . $e->getMessage());
        Log::error("Stack trace: " . $e->getTraceAsString());
        return [
            ['name' => 'Error loading data', 'rank' => '#1', 'count' => 0],
            ['name' => 'Error loading data', 'rank' => '#2', 'count' => 0],
            ['name' => 'Error loading data', 'rank' => '#3', 'count' => 0]
        ];
    }
}
    
private function getRecentOrders()
{
    try {
        Log::info("=== DEBUG getRecentOrders - Using bookings_date ===");
        
        // Debug: Cek struktur tabel dan data untuk status tertentu
        $totalCompleted = Pesanan::where('status', 'Selesai')->count();
        $totalCancelled = Pesanan::where('status', 'Dibatalkan')->count();
        
        Log::info("Total pesanan selesai: " . $totalCompleted);
        Log::info("Total pesanan dibatalkan: " . $totalCancelled);
        
        // Ambil pesanan yang selesai atau dibatalkan HANYA untuk tanggal hari ini
        $orders = Pesanan::with(['customer'])
            ->whereIn('status', ['Selesai', 'Dibatalkan'])
            ->whereNotNull('bookings_date')
            ->whereDate('bookings_date', Carbon::today())
            ->orderBy('bookings_date', 'desc')
            ->limit(10)
            ->get();
        
        Log::info("Orders found dengan bookings_date untuk hari ini: " . $orders->count());
        
        // Map data dengan handling yang lebih robust
        return $orders->map(function ($order) {
            try {
                // Ambil nama customer dengan multiple fallback
                $customerName = 'N/A';
                
                if ($order->relationLoaded('customer') && $order->customer) {
                    $customerName = $order->customer->name;
                } elseif (isset($order->customer_id) && $order->customer_id) {
                    // Coba ambil dari database
                    try {
                        $customer = \App\Models\Pelanggan::find($order->customer_id);
                        $customerName = $customer ? $customer->name : 'Customer #' . $order->customer_id;
                    } catch (\Exception $e) {
                        Log::warning("Gagal mengambil customer ID {$order->customer_id}: " . $e->getMessage());
                        $customerName = 'Customer #' . $order->customer_id;
                    }
                }
                
                // Gunakan bookings_date sebagai prioritas untuk tanggal, created_at untuk waktu
                $displayDate = $order->bookings_date ? Carbon::parse($order->bookings_date) : Carbon::parse($order->created_at);
                
                return [
                    'id' => $order->id,
                    'date' => $displayDate->format('d/m/Y'),
                    'customer_name' => $customerName,
                    'status' => $order->status ?? 'Pending',
                    'booking_code' => $order->booking_code ?? 'BC-' . str_pad($order->id, 6, '0', STR_PAD_LEFT)
                ];
                
            } catch (\Exception $e) {
                Log::error("Error mapping order ID {$order->id}: " . $e->getMessage());
                return [
                    'id' => $order->id,
                    'date' => $order->bookings_date ? Carbon::parse($order->bookings_date)->format('d/m/Y') : Carbon::parse($order->created_at)->format('d/m/Y'),
                    'customer_name' => 'Error Loading',
                    'status' => $order->status ?? 'Unknown',
                    'booking_code' => 'BC-' . str_pad($order->id, 6, '0', STR_PAD_LEFT)
                ];
            }
        });
        
    } catch (\Exception $e) {
        Log::error("Error dalam getRecentOrders: " . $e->getMessage());
        Log::error("Stack trace: " . $e->getTraceAsString());
        
        // Return empty collection dengan pesan debug
        return collect([[
            'id' => 0,
            'date' => Carbon::today()->format('d/m/Y'),
            'customer_name' => 'Error: ' . $e->getMessage(),
            'status' => 'Error',
            'booking_code' => 'ERROR'
        ]]);
    }
}
    
    public function getChartData(Request $request)
    {
        $year = $request->get('year', Carbon::now()->year);
        
        try {
            $completedOrders = Pesanan::where('status', 'Selesai')
                ->whereYear('bookings_date', $year)
                ->select(
                    DB::raw('MONTH(bookings_date) as month'),
                    DB::raw('COUNT(*) as count')
                )
                ->groupBy('month')
                ->pluck('count', 'month')
                ->toArray();
                
            $cancelledOrders = Pesanan::where('status', 'Dibatalkan')
                ->whereYear('bookings_date', $year)
                ->select(
                    DB::raw('MONTH(bookings_date) as month'),
                    DB::raw('COUNT(*) as count')
                )
                ->groupBy('month')
                ->pluck('count', 'month')
                ->toArray();
        } catch (\Exception $e) {
            Log::error("Error getting chart data for year {$year}: " . $e->getMessage());
            $completedOrders = [];
            $cancelledOrders = [];
        }
        
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