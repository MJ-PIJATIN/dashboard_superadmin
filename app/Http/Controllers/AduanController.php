<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Pelanggan; // Menggunakan model Pelanggan yang benar
use App\Models\Terapis;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log; // Tambahkan ini untuk logging

class AduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Menggunakan model Report dengan relasi customer saja
        $query = Report::with(['customer'])->latest();

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
        $report = Report::with(['customer'])->findOrFail($id);
        return view('pages.SuperAdminDetailAduan', ['detailAduan' => $report]);
    }

    /**
     * Menampilkan detail terapis yang terkait dengan aduan.
     */
    public function showTerapisDetail($aduan_id)
    {
        $report = Report::findOrFail($aduan_id);
        
        // Load customer relation
        $report->load('customer');
        
        // Load target berdasarkan type
        if ($report->target_type === 'therapist') {
            $report->target = Terapis::find($report->target_id);
        } elseif ($report->target_type === 'customer') {
            $report->target = Pelanggan::find($report->target_id);
        }
        
        return view('pages.SuperAdminDetailTerapisAduan', ['detailAduan' => $report]);
    }

    /**
     * Search for reports via API.
     */
    public function search(Request $request): JsonResponse
    {
        $query = Report::with(['customer'])->latest();
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