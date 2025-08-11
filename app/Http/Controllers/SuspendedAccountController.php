<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class SuspendedAccountController extends Controller
{
    /**
     * Display a listing of suspended accounts.
     */
    public function index(Request $request)
    {
        $query = DB::table('suspended_accounts')->orderBy('suspension_id', 'asc');
        $paginator = $query->paginate(10);

        // Convert stdClass objects to arrays and format date for the view
        $suspendedAccounts = $paginator->map(function ($item) {
            $item = (array) $item;
            $item['waktu'] = Carbon::parse($item['tanggal_ditangguhkan'])->format('H:i');
            return $item;
        })->all();

        $paginationData = [
            'total' => $paginator->total(),
            'current_page' => $paginator->currentPage(),
            'total_pages' => $paginator->lastPage(),
        ];

        return view('pages.SuperAdminPenangguhan', [
            'suspendedAccounts' => $suspendedAccounts,
            'paginationData' => $paginationData,
        ]);
    }

    /**
     * Display the specified suspended account detail.
     */
    public function detail($suspension_id) // $id is suspension_id
    {
        $account = DB::table('suspended_accounts')->where('suspension_id', $suspension_id)->first();

        if (!$account) {
            abort(404, 'Akun penangguhan tidak ditemukan');
        }

        $account = (array) $account;
        $account['sisa_durasi'] = $account['tanggal_selesai'] ? Carbon::parse($account['tanggal_selesai'])->diffForHumans(null, true) : '-';

        return view('pages.SuperAdminDetailPenangguhan', compact('account'));
    }

    /**
     * Restore suspended account.
     * FIXED: Menggunakan suspension_id yang benar sesuai dengan database
     */
    public function restore($id): JsonResponse // $id is suspension_id (string format PNG001, PNG002, etc.)
    {
        try {
            // Log untuk debugging
            Log::info('Attempting to restore account with suspension_id: ' . $id);
            
            // Gunakan suspension_id sebagai string (bukan integer)
            $deleted = DB::table('suspended_accounts')
                ->where('suspension_id', $id)  // suspension_id adalah string seperti "PNG001"
                ->delete();

            if ($deleted) {
                Log::info('Account restored successfully', ['suspension_id' => $id, 'deleted_rows' => $deleted]);
                return response()->json(['success' => true, 'message' => 'Penangguhan akun berhasil dihapus']);
            } else {
                Log::warning('Account to restore not found', ['suspension_id' => $id]);
                return response()->json(['success' => false, 'message' => 'Akun tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Restore failed', ['suspension_id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Search suspended accounts.
     * FIXED: Menambahkan pencarian berdasarkan suspension_id yang benar
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $query = $request->get('q', '');
            $dbQuery = DB::table('suspended_accounts');

            if (!empty($query)) {
                $dbQuery->where(function($q) use ($query) {
                    $q->where('nama', 'like', '%' . $query . '%')
                      ->orWhere('suspension_id', 'like', '%' . $query . '%')  // suspension_id sebagai string
                      ->orWhere('area_kerja', 'like', '%' . $query . '%')
                      ->orWhere('durasi', 'like', '%' . $query . '%');
                });
            }

            $accounts = $dbQuery->get()->map(function($item) {
                $account = (array) $item;
                // Tambahkan format waktu untuk konsistensi
                $account['waktu'] = Carbon::parse($account['tanggal_ditangguhkan'])->format('H:i');
                return $account;
            });

            return response()->json([
                'success' => true,
                'data' => $accounts,
                'query' => $query,
                'total' => count($accounts)
            ]);

        } catch (\Exception $e) {
            Log::error("Search failed", ['query' => $request->get('q'), 'error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Pencarian gagal: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Suspend a therapist account.
     */
    public function suspend(Request $request, $id): JsonResponse // $id is terapis_id
    {
        try {
            $validatedData = $request->validate([
                'reason' => 'required|string',
                'description' => 'required|string|max:500',
                'duration' => 'required|string',
            ]);

            $terapisData = $this->getTerapisData($id);
            if (!$terapisData) {
                return response()->json(['success' => false, 'message' => 'Data terapis tidak ditemukan.'], 404);
            }

            $durationDaysMap = ['1' => 7, '7' => 14, '14' => 30, '30' => -1];
            $days = $durationDaysMap[$validatedData['duration']] ?? 0;
            $durationMap = ['1' => '7 Hari', '7' => '14 Hari', '14' => '30 Hari', '30' => 'Permanen'];
            $durasi = $durationMap[$validatedData['duration']] ?? $validatedData['duration'];

            $lastSuspension = DB::table('suspended_accounts')->orderBy('id', 'desc')->first();
            $maxId = $lastSuspension ? (int)substr($lastSuspension->suspension_id, 3) : 0;
            $newId = 'PNG' . str_pad($maxId + 1, 3, '0', STR_PAD_LEFT);

            $isPermanent = ($durasi === 'Permanen');

            DB::table('suspended_accounts')->insert([
                'suspension_id' => $newId,
                'terapis_id' => $id,
                'nama' => $terapisData['nama'],
                'kelamin' => $terapisData['jenis_kelamin'],
                'nik' => $terapisData['nik'],
                'email' => $terapisData['email'],
                'ponsel' => $terapisData['ponsel'],
                'alamat' => $terapisData['alamat'],
                'area_kerja' => $terapisData['area_kerja'],
                'photo' => $terapisData['photo'],
                'durasi' => $durasi,
                'alasan' => $validatedData['reason'],
                'deskripsi_alasan' => $validatedData['description'],
                'tanggal_ditangguhkan' => now(),
                'tanggal_selesai' => !$isPermanent ? now()->addDays($days) : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::info('Account suspended and stored in DB', ['terapis_id' => $id, 'new_suspension_id' => $newId]);
            return response()->json(['success' => true, 'message' => 'Akun berhasil ditangguhkan.']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Data tidak valid.', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Suspend failed', ['terapis_id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem.'], 500);
        }
    }

    private function getTerapisData($id)
    {
        // Data dummy, in real app should come from Terapis table
        $allTerapis = [
            1 => [
                'id' => 1, 'nama' => 'Samsul Alamsyah', 'email' => 'samsul.alamayah@gmail.com',
                'ponsel' => '082954627818', 'area_kerja' => 'Jakarta Timur',
                'status_akun' => 'Tidak dalam Penangguhan', 'nik' => '31718958332409040',
                'tempat_lahir' => 'Jakarta', 'tanggal_lahir' => '15 Agustus 1988',
                'jenis_kelamin' => 'Laki-Laki', 'alamat' => 'Jl. Raya Bekasi No. 45, Pulogadung, Jakarta Timur',
                'photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80'
            ],
            2 => [
                'id' => 2, 'nama' => 'Budi Santoso', 'email' => 'budi.santoso@gmail.com',
                'ponsel' => '081234567890', 'area_kerja' => 'Jakarta Pusat',
                'status_akun' => 'Dalam Penangguhan', 'nik' => '31718958332409036',
                'tempat_lahir' => 'Jakarta', 'tanggal_lahir' => '20 Mei 1985',
                'jenis_kelamin' => 'Laki-Laki', 'alamat' => 'Jl. Menteng Raya No. 123, Menteng, Jakarta Pusat',
                'photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80'
            ],
            3 => [
                'id' => 3,
                'nama' => 'Joko Widodo',
                'email' => 'joko.widodo@gmail.com',
                'ponsel' => '089876543210',
                'area_kerja' => 'Jakarta Utara',
                'status_akun' => 'Tidak dalam Penangguhan',
                'nik' => '31718958332409037',
                'tempat_lahir' => 'Surakarta',
                'tanggal_lahir' => '21 Juni 1961',
                'jenis_kelamin' => 'Laki-Laki',
                'alamat' => 'Jl. Kelapa Gading Boulevard No. 88, Kelapa Gading, Jakarta Utara',
                'photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80'
            ],
        ];
        return $allTerapis[$id] ?? null;
    }
}