<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Terapis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $transferData = Pesanan::with(['customer', 'mainService'])
            ->where('payment', 'transfer')
            ->paginate(10, ['*'], 'transfer_page');

        $cashData = Pesanan::with(['customer', 'mainService'])
            ->where('payment', 'cash')
            ->paginate(10, ['*'], 'cash_page');

        return view('pages.SuperAdminPesanan', [
            'transfer' => $transferData,
            'cash' => $cashData,
        ]);
    }

    public function detail(Request $request, $tipe, $id)
    {
        // Validasi tipe terlebih dahulu
        if (!in_array($tipe, ['transfer', 'cash'])) {
            abort(404, 'Tipe pesanan tidak valid');
        }

        // Debug log untuk melihat parameter yang diterima
        Log::info("Detail pesanan - Tipe: {$tipe}, ID: {$id}");

        try {
            // Cari pesanan dengan kondisi gabungan
            $pesanan = Pesanan::with(['customer', 'therapist', 'mainService', 'additionalService'])
                ->where('payment', $tipe)
                ->where('id', $id)
                ->first();

            if (!$pesanan) {
                Log::error("Pesanan tidak ditemukan - Tipe: {$tipe}, ID: {$id}");
                abort(404, 'Pesanan tidak ditemukan');
            }

            $terapisList = Terapis::all();

            $pesananData = [
                'id' => $pesanan->id,
                'layanan' => $pesanan->mainService->name ?? 'N/A',
                'nama' => $pesanan->customer->name ?? 'N/A',
                'harga' => $pesanan->mainService->price ?? 0,
                'jadwal' => ($pesanan->bookings_date ?? '') . ', ' . ($pesanan->bookings_time ?? ''),
                'tanggal_pemesanan' => $pesanan->created_at ? $pesanan->created_at->format('d M Y') : 'N/A',
                'alamat' => $pesanan->customer->kota ?? $pesanan->customer->address ?? 'N/A',
                'gender' => $pesanan->customer->gender ?? 'N/A',
                'ponsel' => $pesanan->customer->phone ?? 'N/A',
                'layanan_tambahan' => $pesanan->additionalService ? [$pesanan->additionalService->name] : [],
                'durasi' => ($pesanan->mainService->duration ?? 0) . ' Menit',
                'total_layanan' => ($pesanan->mainService->price ?? 0) + ($pesanan->additionalService ? ($pesanan->additionalService->price ?? 0) : 0),
                'metode' => $pesanan->payment ?? 'N/A',
                'total_harga' => ($pesanan->mainService->price ?? 0) + ($pesanan->additionalService ? ($pesanan->additionalService->price ?? 0) : 0),
                'status' => $pesanan->status ?? 'N/A',
            ];

            $terapisListData = $terapisList->map(function ($terapis) {
                return [
                    'nama_terapis' => $terapis->name ?? 'N/A',
                    'ponsel_terapis' => $terapis->phone ?? 'N/A',
                    'gender' => $terapis->gender ?? 'N/A',
                ];
            });

            return view('pages.SuperAdminDetailPesanan', [
                'pesanan' => $pesananData,
                'terapisList' => $terapisListData,
                'tipe' => $tipe
            ]);

        } catch (\Exception $e) {
            Log::error("Error dalam detail pesanan: " . $e->getMessage());
            abort(500, 'Terjadi kesalahan server');
        }
    }

    public function updateStatus(Request $request, $tipe, $id)
    {
        if (!in_array($tipe, ['transfer', 'cash'])) {
            return response()->json(['success' => false, 'message' => 'Tipe pesanan tidak valid'], 400);
        }

        $newStatus = $request->input('status');
        
        if (!$newStatus) {
            return response()->json(['success' => false, 'message' => 'Status tidak boleh kosong'], 400);
        }

        try {
            $pesanan = Pesanan::where('payment', $tipe)
                            ->where('id', $id)
                            ->first();

            if (!$pesanan) {
                return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan'], 404);
            }

            $pesanan->status = $newStatus;
            $pesanan->save();

            Log::info("Status pesanan berhasil diupdate - ID: {$id}, Status baru: {$newStatus}");

            return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui']);

        } catch (\Exception $e) {
            Log::error("Error update status: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat mengupdate status'], 500);
        }
    }

    public function destroy($tipe, $id)
    {
        // Log parameter yang diterima
        Log::info("DELETE REQUEST - Tipe: {$tipe}, ID: {$id}");
        
        // Validasi tipe
        if (!in_array($tipe, ['transfer', 'cash'])) {
            Log::error("Tipe tidak valid: {$tipe}");
            return response()->json(['success' => false, 'message' => 'Tipe pesanan tidak valid'], 400);
        }

        try {
            // Debug: Cek semua data dengan ID ini (tanpa filter payment)
            $allWithId = Pesanan::where('id', $id)->get();
            Log::info("Semua pesanan dengan ID {$id}: " . $allWithId->toJson());
            
            // Debug: Cek semua data dengan payment type ini
            $allWithPayment = Pesanan::where('payment', $tipe)->get(['id', 'payment']);
            Log::info("Semua pesanan dengan payment {$tipe}: " . $allWithPayment->toJson());
            
            // Cari pesanan dengan kondisi gabungan
            $pesanan = Pesanan::where('payment', $tipe)
                            ->where('id', $id)
                            ->first();
                            
            if (!$pesanan) {
                Log::error("Pesanan tidak ditemukan - Tipe: {$tipe}, ID: {$id}");
                
                // Coba pencarian alternatif
                $pesananById = Pesanan::where('id', $id)->first();
                if ($pesananById) {
                    Log::info("Pesanan ditemukan dengan ID {$id} tapi payment: {$pesananById->payment}");
                    return response()->json([
                        'success' => false, 
                        'message' => "Pesanan ditemukan dengan payment method: {$pesananById->payment}, bukan {$tipe}"
                    ], 404);
                }
                
                return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan'], 404);
            }
            
            Log::info("Pesanan ditemukan: " . $pesanan->toJson());
            
            $pesanan->delete();

            Log::info("Pesanan berhasil dihapus - ID: {$id}");

            return response()->json(['success' => true, 'message' => 'Pesanan berhasil dihapus']);
            
        } catch (\Exception $e) {
            Log::error("Error deleting pesanan - ID: {$id}, Error: " . $e->getMessage());
            Log::error("Stack trace: " . $e->getTraceAsString());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}