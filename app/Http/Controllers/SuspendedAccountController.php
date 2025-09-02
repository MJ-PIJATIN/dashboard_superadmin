<?php

namespace App\Http\Controllers;

use App\Models\SuspendedAccount;
use App\Models\Terapis;
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
        $query = SuspendedAccount::orderBy('id', 'asc');
        $paginator = $query->paginate(10);

        $suspendedAccounts = $paginator->getCollection()->transform(function ($item) {
            $item->waktu = Carbon::parse($item->suspended_at)->format('H:i');
            return $item;
        });

        Log::info('Fetched suspended accounts:', $suspendedAccounts->toArray());

        $paginationData = [
            'total' => $paginator->total(),
            'current_page' => $paginator->currentPage(),
            'total_pages' => $paginator->lastPage(),
        ];

        if ($request->isMethod('post') && $request->has('success_message')) {
            return redirect()->route('penangguhan')->with('success_message', $request->input('success_message'));
        }

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
        $account = SuspendedAccount::with('therapist')->where('suspension_id', $suspension_id)->first();

        if (!$account) {
            abort(404, 'Akun penangguhan tidak ditemukan');
        }

        $account->sisa_durasi = $account->suspension_ends_at ? Carbon::parse($account->suspension_ends_at)->diffForHumans(null, true) : '-';

        return view('pages.SuperAdminDetailPenangguhan', compact('account'));
    }

    /**
     * Restore suspended account.
     */
    public function restore($suspension_id): JsonResponse
    {
        try {
            Log::info('Attempting to restore account with suspension_id: ' . $suspension_id);
            
            $suspendedAccount = SuspendedAccount::where('suspension_id', $suspension_id)->first();

            if ($suspendedAccount) {
                $therapist = Terapis::find($suspendedAccount->therapist_id);
                if ($therapist) {
                    $therapist->update(['suspended_duration' => null]);
                }
                $suspendedAccount->delete();
                Log::info('Account restored successfully', ['suspension_id' => $suspension_id]);
                return response()->json(['success' => true, 'message' => 'Akun berhasil dipulihkan']);
            } else {
                Log::warning('Account to restore not found', ['suspension_id' => $suspension_id]);
                return response()->json(['success' => false, 'message' => 'Akun tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Restore failed', ['suspension_id' => $suspension_id, 'error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Search suspended accounts.
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $query = $request->get('q', '');
            $dbQuery = SuspendedAccount::query();

            if (!empty($query)) {
                $dbQuery->where(function($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%')
                      ->orWhere('suspension_id', 'like', '%' . $query . '%')
                      ->orWhere('work_area', 'like', '%' . $query . '%')
                      ->orWhere('duration', 'like', '%' . $query . '%');
                });
            }

            $accounts = $dbQuery->get()->map(function($item) {
                $item->waktu = Carbon::parse($item->suspended_at)->format('H:i');
                return $item;
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
            Log::info('Suspend request received', [
                'terapis_id' => $id,
                'request_data' => $request->all()
            ]);

            $validatedData = $request->validate([
                'reason' => 'required|string',
                'description' => 'required|string|max:500',
                'duration' => 'required|string',
            ]);

            $terapis = Terapis::find($id);
            if (!$terapis) {
                Log::error('Terapis not found', ['terapis_id' => $id]);
                return response()->json(['success' => false, 'message' => 'Data terapis tidak ditemukan.'], 404);
            }

            // Cek apakah sudah ada penangguhan aktif
            $existingSuspension = SuspendedAccount::where('therapist_id', $id)->first();
            if ($existingSuspension) {
                Log::warning('Therapist already suspended', ['terapis_id' => $id]);
                return response()->json(['success' => false, 'message' => 'Akun terapis sudah dalam penangguhan.'], 400);
            }

            $durationDaysMap = ['1' => 7, '7' => 14, '14' => 30, '30' => -1];
            $days = $durationDaysMap[$validatedData['duration']] ?? 0;
            $durationMap = ['1' => '7 Hari', '7' => '14 Hari', '14' => '30 Hari', '30' => 'Permanen'];
            $durasi = $durationMap[$validatedData['duration']] ?? $validatedData['duration'];

            // Generate ID penangguhan
            $lastSuspension = SuspendedAccount::orderBy('id', 'desc')->first();
            $maxId = $lastSuspension ? $lastSuspension->id : 0;
            $newId = 'SUSP-' . str_pad($maxId + 1, 5, '0', STR_PAD_LEFT);

            $isPermanent = ($durasi === 'Permanen');

            // Pastikan kolom sesuai dengan yang ada di database dan model
            $suspendedAccountData = [
                'suspension_id' => $newId,
                'therapist_id' => $id,
                'name' => $terapis->name ?? '',
                'gender' => $terapis->gender ?? '',
                'national_id_number' => $terapis->NIK ?? '',
                'email' => $terapis->email ?? '',
                'phone_number' => $terapis->phone ?? '',
                'address' => $terapis->addres ?? '', // Sesuaikan dengan kolom di tabel terapis
                'work_area' => $terapis->work_area ?? '',
                'photo_url' => $terapis->photo ?? '',
                'duration' => $durasi,
                'reason' => $validatedData['reason'],
                'reason_description' => $validatedData['description'],
                'suspended_at' => now(),
                'suspension_ends_at' => !$isPermanent ? now()->addDays($days) : null,
            ];

            Log::info('Creating suspended account with data:', $suspendedAccountData);

            // Buat record penangguhan
            $suspendedAccount = SuspendedAccount::create($suspendedAccountData);
            DB::enableQueryLog();
            Log::info('Database queries:', DB::getQueryLog());
            $check = SuspendedAccount::find($suspendedAccount->id);
            Log::info('Verification check:', ['found' => $check ? 'yes' : 'no', 'data' => $check]);

            if (!$suspendedAccount) {
                Log::error('Failed to create suspended account record');
                return response()->json(['success' => false, 'message' => 'Gagal membuat record penangguhan.'], 500);
            }

            Log::info('Created suspended account successfully:', ['suspension_id' => $newId, 'record_id' => $suspendedAccount->id]);

            // Update status terapis
            $terapisUpdated = $terapis->update(['suspended_duration' => $durasi]);
            
            if (!$terapisUpdated) {
                Log::warning('Failed to update therapist suspended_duration', ['terapis_id' => $id]);
            }

            Log::info('Account suspended and stored in DB successfully', [
                'terapis_id' => $id, 
                'new_suspension_id' => $newId,
                'database_id' => $suspendedAccount->id
            ]);

            return response()->json([
                'success' => true, 
                'message' => 'Akun berhasil ditangguhkan.',
                'suspension_id' => $newId,
                'data' => $suspendedAccount
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false, 
                'message' => 'Data tidak valid.', 
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Suspend failed with exception', [
                'terapis_id' => $id, 
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false, 
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 500);
        }
    }
}