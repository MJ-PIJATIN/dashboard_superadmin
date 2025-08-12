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
            ->orderBy('booking_code', 'asc')
            ->paginate(10, ['*'], 'transfer_page');

        $cashData = Pesanan::with(['customer', 'mainService'])
            ->where('payment', 'cash')
            ->orderBy('booking_code', 'asc')
            ->paginate(10, ['*'], 'cash_page');

        return view('pages.SuperAdminPesanan', [
            'transfer' => $transferData,
            'cash' => $cashData,
        ]);
    }

    public function detail(Request $request, $tipe, $id)
    {
        if (!in_array($tipe, ['transfer', 'cash'])) {
            abort(404, 'Tipe pesanan tidak valid');
        }

        Log::info("Detail pesanan - Tipe: {$tipe}, ID: {$id}");

        try {
            $pesanan = Pesanan::with(['customer', 'therapist', 'mainService', 'additionalService'])
                ->where('payment', $tipe)
                ->where('id', $id)
                ->first();

            if (!$pesanan) {
                Log::error("Pesanan tidak ditemukan - Tipe: {$tipe}, ID: {$id}");
                abort(404, 'Pesanan tidak ditemukan');
            }


            $terapisQuery = Terapis::query();
            
            if ($pesanan->therapist_id && !in_array($pesanan->status, ['Selesai', 'Dibatalkan'])) {

                $terapisQuery->where('id', '!=', $pesanan->therapist_id);
            }
            
            $terapisList = $terapisQuery->get();

            $pesananData = [
                'id' => $pesanan->id,
                'layanan' => $pesanan->mainService->name ?? 'N/A',
                'nama' => $pesanan->customer->name ?? 'N/A',
                'harga' => $pesanan->mainService->price ?? 0,
                'jadwal' => ($pesanan->bookings_date ?? '') . ', ' . ($pesanan->bookings_time ?? ''),
                'tanggal_pemesanan' => $pesanan->created_at ? $pesanan->created_at->format('d M Y') : 'N/A',
                'alamat' => $pesanan->customer->address ?? 'N/A',
                'gender' => $pesanan->customer->gender ?? 'N/A',
                'ponsel' => $pesanan->customer->phone ?? 'N/A',
                'layanan_tambahan' => $pesanan->additionalService ? [$pesanan->additionalService->name] : [],
                'durasi' => ($pesanan->mainService->duration ?? 0) . ' Menit',
                'total_layanan' => ($pesanan->mainService->price ?? 0) + ($pesanan->additionalService ? ($pesanan->additionalService->price ?? 0) : 0),
                'metode' => $pesanan->payment ?? 'N/A',
                'total_harga' => ($pesanan->mainService->price ?? 0) + ($pesanan->additionalService ? ($pesanan->additionalService->price ?? 0) : 0),
                'status' => $pesanan->status ?? 'N/A',
                'therapist_id' => $pesanan->therapist_id,
                'therapist_name' => $pesanan->therapist->name ?? '',
                'therapist_phone' => $pesanan->therapist->phone ?? '',
                'therapist_gender' => $pesanan->therapist->gender ?? '',
            ];

            $terapisListData = $terapisList->map(function ($terapis) {
                return [
                    'id' => $terapis->id,
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

    public function assignTherapist(Request $request, $tipe, $id)
    {
        // Normalize tipe ke lowercase untuk konsistensi
        $tipe = strtolower($tipe);
        
        // Log semua parameter yang diterima untuk debugging
        Log::info("ASSIGN THERAPIST REQUEST", [
            'tipe' => $tipe,
            'original_tipe' => $request->route('tipe'),
            'id' => $id,
            'request_data' => $request->all(),
            'method' => $request->method(),
            'url' => $request->url()
        ]);

        if (!in_array($tipe, ['transfer', 'cash'])) {
            Log::error("Tipe tidak valid: {$tipe}");
            return response()->json(['success' => false, 'message' => 'Tipe pesanan tidak valid'], 400);
        }

        $therapistId = $request->input('therapist_id');
        
        if (!$therapistId) {
            Log::error("Therapist ID kosong");
            return response()->json(['success' => false, 'message' => 'ID terapis tidak boleh kosong'], 400);
        }

        try {
            // Cari pesanan
            $pesanan = Pesanan::where('payment', $tipe)
                            ->where('id', $id)
                            ->first();

            if (!$pesanan) {
                Log::error("Pesanan tidak ditemukan - Tipe: {$tipe}, ID: {$id}");
                return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan'], 404);
            }

            Log::info("Pesanan ditemukan", ['pesanan' => $pesanan->toArray()]);

            // Cek apakah terapis exist
            $terapis = Terapis::find($therapistId);
            if (!$terapis) {
                Log::error("Terapis tidak ditemukan - ID: {$therapistId}");
                return response()->json(['success' => false, 'message' => 'Terapis tidak ditemukan'], 404);
            }

            Log::info("Terapis ditemukan", ['terapis' => $terapis->toArray()]);

            // Simpan status lama untuk debugging
            $oldStatus = $pesanan->status;
            $oldTherapistId = $pesanan->therapist_id;

            // Update therapist_id dan status
            $pesanan->therapist_id = $therapistId;
            
            // Jika status masih pending atau menunggu, ubah ke dijadwalkan
            if (in_array($pesanan->status, ['Pending', 'Menunggu'])) {
                $pesanan->status = 'Dijadwalkan';
            }

            Log::info("Sebelum save", [
                'old_therapist_id' => $oldTherapistId,
                'new_therapist_id' => $pesanan->therapist_id,
                'old_status' => $oldStatus,
                'new_status' => $pesanan->status
            ]);
            
            $saved = $pesanan->save();

            if (!$saved) {
                Log::error("Gagal menyimpan pesanan");
                return response()->json(['success' => false, 'message' => 'Gagal menyimpan perubahan'], 500);
            }

            Log::info("Terapis berhasil ditugaskan", [
                'pesanan_id' => $id,
                'terapis_id' => $therapistId,
                'status_changed' => $oldStatus !== $pesanan->status
            ]);

            return response()->json([
                'success' => true, 
                'message' => 'Terapis berhasil ditugaskan',
                'data' => [
                    'therapist_name' => $terapis->name,
                    'therapist_phone' => $terapis->phone,
                    'therapist_gender' => $terapis->gender,
                    'new_status' => $pesanan->status,
                    'old_status' => $oldStatus
                ]
            ]);

        } catch (\Exception $e) {
            Log::error("Error assign therapist", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            return response()->json([
                'success' => false, 
                'message' => 'Terjadi kesalahan saat menugaskan terapis: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getAvailableTherapists(Request $request, $tipe, $id)
    {
        try {
            $pesanan = Pesanan::where('payment', $tipe)->where('id', $id)->first();
            
            if (!$pesanan) {
                return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan'], 404);
            }

            $terapisQuery = Terapis::query();
            
            if ($pesanan->therapist_id && !in_array($pesanan->status, ['Selesai', 'Dibatalkan'])) {
                $terapisQuery->where('id', '!=', $pesanan->therapist_id);
            }
            
            $terapisList = $terapisQuery->get();

            $terapisListData = $terapisList->map(function ($terapis, $index) {
                return [
                    'id' => $terapis->id,
                    'nama_terapis' => $terapis->name ?? 'N/A',
                    'ponsel_terapis' => $terapis->phone ?? 'N/A',
                    'gender' => $terapis->gender ?? 'N/A',
                    'index' => $index
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $terapisListData
            ]);

        } catch (\Exception $e) {
            Log::error("Error get available therapists: " . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Terjadi kesalahan saat mengambil daftar terapis'
            ], 500);
        }
    }

    public function destroy($tipe, $id)
    {
        Log::info("DELETE REQUEST - Tipe: {$tipe}, ID: {$id}");
        
        if (!in_array($tipe, ['transfer', 'cash'])) {
            Log::error("Tipe tidak valid: {$tipe}");
            return response()->json(['success' => false, 'message' => 'Tipe pesanan tidak valid'], 400);
        }

        try {
            $allWithId = Pesanan::where('id', $id)->get();
            Log::info("Semua pesanan dengan ID {$id}: " . $allWithId->toJson());
            
            $allWithPayment = Pesanan::where('payment', $tipe)->get(['id', 'payment']);
            Log::info("Semua pesanan dengan payment {$tipe}: " . $allWithPayment->toJson());
            
            $pesanan = Pesanan::where('payment', $tipe)
                            ->where('id', $id)
                            ->first();
                            
            if (!$pesanan) {
                Log::error("Pesanan tidak ditemukan - Tipe: {$tipe}, ID: {$id}");
                
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