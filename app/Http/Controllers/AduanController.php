<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Pelanggan;
use App\Models\Terapis;
use App\Models\Pesanan; // Tambahkan import ini
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class AduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Menggunakan model Report dengan relasi customer dan booking
        $query = Report::with(['customer', 'booking'])->latest();

        // Filter berdasarkan pencarian jika ada
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('detail_report', 'like', "%{$searchTerm}%")
                  ->orWhere('reason', 'like', "%{$searchTerm}%")
                  ->orWhereHas('customer', function ($subq) use ($searchTerm) {
                      $subq->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        $reports = $query->paginate(10)->withQueryString();

        // Debug - untuk melihat apakah ada data (opsional)
        if ($reports->count() === 0) {
            Log::info('No reports found. Checking data...');
            Log::info('Total reports in DB: ' . Report::count());
            Log::info('Total customers in DB: ' . Pelanggan::count());
            Log::info('Total therapists in DB: ' . Terapis::count());
        }
        
        return view('pages.SuperAdminAduanPelanggan', ['paginatedAduan' => $reports]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Eager load relasi customer dan booking
        $report = Report::with(['customer', 'booking'])->findOrFail($id);
        
        return view('pages.SuperAdminDetailAduan', ['detailAduan' => $report]);
    }

    /**
     * Menampilkan detail terapis yang terkait dengan aduan.
     */
    public function showTerapisDetail($aduan_id)
    {
        // Eager load the booking and its therapist for the fallback path.
        $report = Report::with('booking.therapist')->findOrFail($aduan_id);

        $therapist = null;

        // Priority 1: Check if the direct target is a therapist.
        // The 'target' attribute will lazy-load the related model (Terapis or Pelanggan).
        if ($report->target_type === 'therapist' && $report->target instanceof \App\Models\Terapis) {
            $therapist = $report->target;
        } 
        // Priority 2: If not, get the therapist from the associated booking.
        elseif ($report->booking && $report->booking->therapist) {
            $therapist = $report->booking->therapist;
        }

        // If no therapist could be found via either method, then we cannot proceed.
        if (!$therapist) {
            return redirect()->route('aduan-pelanggan')
                             ->with('error', 'Tidak dapat menemukan terapis yang terkait dengan aduan ini, baik sebagai target laporan maupun dari pesanan terkait.');
        }

        // Format jenis kelamin untuk ditampilkan
        $therapist->formatted_gender = $this->formatGender($therapist->gender);
        
        return view('pages.SuperAdminDetailAkunReportTerapis', [
            'detailTerapis' => $therapist,
            'detailAduan' => $report
        ]);
    }

    /**
     * Format gender untuk tampilan
     */
    private function formatGender($gender)
    {
        if (!$gender) {
            return '-';
        }

        switch (strtoupper($gender)) {
            case 'L':
                return 'Laki-laki';
            case 'P':
                return 'Perempuan';
            default:
                return $gender; // Return as is jika tidak L atau P
        }
    }

    /**
     * Search for reports via API.
     */
    public function search(Request $request): JsonResponse
    {
        $query = Report::with(['customer', 'booking'])->latest();
        $searchTerm = $request->get('q', '');

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('detail_report', 'like', "%{$searchTerm}%")
                  ->orWhere('reason', 'like', "%{$searchTerm}%")
                  ->orWhereHas('customer', function ($subq) use ($searchTerm) {
                      $subq->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }
        
        $reports = $query->take(50)->get();

        return response()->json([
            'success' => true,
            'data' => $reports
        ]);
    }
}