<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

use Illuminate\Pagination\LengthAwarePaginator;

class SuspendedAccountController extends Controller
{
    /**
     * Display a listing of suspended accounts.
     */
    public function index(Request $request)
    {
        $allSuspendedAccounts = $request->session()->get('suspended_accounts', []);

        $perPage = 10;
        $currentPage = $request->input('page', 1);
        $paginatedData = array_slice($allSuspendedAccounts, ($currentPage - 1) * $perPage, $perPage);
        $paginator = new LengthAwarePaginator($paginatedData, count($allSuspendedAccounts), $perPage, $currentPage, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        $paginationData = [
            'total' => $paginator->total(),
            'current_page' => $paginator->currentPage(),
            'total_pages' => $paginator->lastPage(),
        ];

        return view('pages.SuperAdminPenangguhan', [
            'suspendedAccounts' => $paginator->items(),
            'paginationData' => $paginationData,
        ]);
    }
    /**
     * Display the specified suspended account detail.
     */
    public function detail($id)
    {
        // Data dummy untuk detail akun - nanti bisa diganti dengan database
        $accountDetails = [
            1 => [
                'id' => 1,
                'nama' => 'Karsa Wijaya',
                'kelamin' => 'Laki-Laki',
                'kota' => 'Bandung',
                'durasi' => 'Permanen',
                'nik' => '3273081234567890',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '15 Maret 1985',
                'alamat' => 'Jl. Sudirman No. 123, Bandung, Jawa Barat',
                'email' => 'karsa.wijaya@email.com',
                'ponsel' => '081234567890',
                'area_kerja' => 'Bandung Kota',
                'status' => 'Penangguhan Permanen',
                'status_class' => 'bg-red-100 text-red-600',
                'tanggal_ditangguhkan' => '10 September 2023',
                'tanggal_selesai' => '-',
                'sisa_durasi' => '-',
                'photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80'
            ],
            2 => [
                'id' => 2,
                'nama' => 'Dandia Rianti',
                'kelamin' => 'Perempuan',
                'kota' => 'Jakarta Timur',
                'durasi' => '30 Hari',
                'nik' => '3175081234567891',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '22 Juli 1990',
                'alamat' => 'Jl. Raya Bekasi No. 45, Jakarta Timur, DKI Jakarta',
                'email' => 'dandia.rianti@email.com',
                'ponsel' => '081234567891',
                'area_kerja' => 'Jakarta Timur',
                'status' => 'Penangguhan Sementara',
                'status_class' => 'bg-orange-100 text-orange-600',
                'tanggal_ditangguhkan' => '15 Oktober 2023',
                'tanggal_selesai' => '14 November 2023',
                'sisa_durasi' => '12 Hari, 8 Jam',
                'photo' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80'
            ],
            10 => [
                'id' => 10,
                'nama' => 'Kamaria Mandasari',
                'kelamin' => 'Perempuan',
                'kota' => 'Surakarta',
                'durasi' => '14 Hari',
                'nik' => '3171895833200123',
                'tempat_lahir' => 'Surakarta',
                'tanggal_lahir' => '20 Mei 1998',
                'alamat' => 'Jl Guntur, Ngasrinon, Jebres, Surakarta, Jawa Tengah',
                'email' => 'kamarinda23@gmail.com',
                'ponsel' => '082954627818',
                'area_kerja' => 'Jebres, Surakarta',
                'status' => 'Penangguhan Sementara',
                'status_class' => 'bg-yellow-100 text-yellow-600',
                'tanggal_ditangguhkan' => '20 Oktober 2023',
                'tanggal_selesai' => '03 November 2023',
                'sisa_durasi' => '8 Hari, 16 Jam',
                'photo' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80'
            ]
        ];

        // Ambil data berdasarkan ID, jika tidak ada gunakan data default
        $account = $accountDetails[$id] ?? [
            'id' => $id,
            'nama' => 'Data tidak ditemukan',
            'kelamin' => '-',
            'kota' => '-',
            'durasi' => '-',
            'nik' => '-',
            'tempat_lahir' => '-',
            'tanggal_lahir' => '-',
            'alamat' => '-',
            'email' => '-',
            'ponsel' => '-',
            'area_kerja' => '-',
            'status' => 'Tidak Diketahui',
            'status_class' => 'bg-gray-100 text-gray-600',
            'tanggal_ditangguhkan' => '-',
            'tanggal_selesai' => '-',
            'sisa_durasi' => '-',
            'photo' => 'https://via.placeholder.com/150'
        ];

        return view('pages.SuperAdminDetailPenangguhan', compact('account'));
    }

    /**
     * Restore suspended account.
     */
    public function restore($id, Request $request): JsonResponse
    {
        try {
            Log::info('Restore attempt', ['account_id' => $id]);
            $accountId = (int) $id;

            if ($accountId <= 0) {
                Log::warning('Invalid account ID for restore', ['id' => $id]);
                return response()->json(['success' => false, 'message' => 'ID akun tidak valid'], 400);
            }

            $suspendedAccounts = $request->session()->get('suspended_accounts', []);

            $indexToRemove = null;
            foreach ($suspendedAccounts as $key => $account) {
                if (isset($account['id']) && $account['id'] == $accountId) {
                    $indexToRemove = $key;
                    break;
                }
            }

            if ($indexToRemove !== null) {
                // Remove the item from the array using unset
                unset($suspendedAccounts[$indexToRemove]);

                // Re-index the array
                $updatedSuspendedAccounts = array_values($suspendedAccounts);

                // Put the updated array back into the session and save
                $request->session()->put('suspended_accounts', $updatedSuspendedAccounts);
                $request->session()->save();

                Log::info('Account restored successfully and removed from session', ['account_id' => $accountId]);

                return response()->json([
                    'success' => true,
                    'message' => 'Akun berhasil dipulihkan',
                    'data' => ['account_id' => $accountId]
                ]);
            } else {
                Log::warning('Account to restore not found in session', ['account_id' => $accountId]);
                return response()->json(['success' => false, 'message' => 'Akun dengan ID tersebut tidak ditemukan di daftar penangguhan'], 404);
            }

        } catch (\Exception $e) {
            Log::error('Restore failed', [
                'account_id' => $id,
                'error' => $e->getMessage(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem. Silakan coba lagi.'
            ], 500);
        }
    }

    /**
     * Search suspended accounts.
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $query = $request->get('q', '');
            
            // Data dummy untuk pencarian
            $allAccounts = [
                ['id' => 1, 'nama' => 'Karsa Wijaya', 'kelamin' => 'Laki-Laki', 'kota' => 'Bandung', 'durasi' => 'Permanen'],
                ['id' => 2, 'nama' => 'Dandia Rianti', 'kelamin' => 'Perempuan', 'kota' => 'Jakarta Timur', 'durasi' => '30 Hari'],
                ['id' => 3, 'nama' => 'Santi Martini', 'kelamin' => 'Perempuan', 'kota' => 'Jakarta Timur', 'durasi' => 'Permanen'],
                ['id' => 4, 'nama' => 'Tono Winarto', 'kelamin' => 'Laki-Laki', 'kota' => 'Jakarta Selatan', 'durasi' => '30 Hari'],
                ['id' => 5, 'nama' => 'Chandra Utama', 'kelamin' => 'Laki-Laki', 'kota' => 'Pekalongan', 'durasi' => 'Permanen'],
                ['id' => 6, 'nama' => 'Willy Kusuma', 'kelamin' => 'Laki-Laki', 'kota' => 'Bandung', 'durasi' => '7 Hari'],
                ['id' => 10, 'nama' => 'Kamaria Mandasari', 'kelamin' => 'Perempuan', 'kota' => 'Surakarta', 'durasi' => '14 Hari'],
                ['id' => 11, 'nama' => 'Uda Lazuardi', 'kelamin' => 'Laki-Laki', 'kota' => 'Bandung', 'durasi' => 'Permanen'],
            ];

            $filteredAccounts = array_filter($allAccounts, function($account) use ($query) {
                return empty($query) || 
                       stripos($account['nama'], $query) !== false ||
                       stripos($account['kota'], $query) !== false ||
                       stripos($account['kelamin'], $query) !== false ||
                       stripos($account['durasi'], $query) !== false ||
                       strpos((string)$account['id'], $query) !== false;
            });

            return response()->json([
                'success' => true,
                'data' => array_values($filteredAccounts),
                'query' => $query,
                'total' => count($filteredAccounts)
            ]);

        } catch (\Exception $e) {
            Log::error("Search failed", [
                'query' => $request->get('q'),
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Pencarian gagal. Silakan coba lagi.',
                'error' => config('app.debug') ? $e->getMessage() : 'Search error'
            ], 500);
        }
    }

    private function getTerapisDataById($id)
    {
        $allTerapis = [
            1 => [
                'id' => 1,
                'nama' => 'Karsa Wijaya',
                'jenis_kelamin' => 'Laki-Laki',
                'area_kerja' => 'Kertasari, Bandung',
            ],
            2 => [
                'id' => 2,
                'nama' => 'Budi Santoso',
                'jenis_kelamin' => 'Laki-Laki',
                'area_kerja' => 'Jakarta Pusat',
            ],
            3 => [
                'id' => 3,
                'nama' => 'Joko Widodo',
                'jenis_kelamin' => 'Laki-Laki',
                'area_kerja' => 'Jakarta Utara',
            ],
            4 => [
                'id' => 4,
                'nama' => 'Agus Setiawan',
                'jenis_kelamin' => 'Laki-Laki',
                'area_kerja' => 'Jakarta Selatan',
            ],
            5 => [
                'id' => 5,
                'nama' => 'Indra Wijaya',
                'jenis_kelamin' => 'Laki-Laki',
                'area_kerja' => 'Jakarta Pusat',
            ],
            6 => [
                'id' => 6,
                'nama' => 'Samsul Alamayah',
                'jenis_kelamin' => 'Laki-Laki',
                'area_kerja' => 'Jakarta Timur',
            ]
        ];

        return $allTerapis[$id] ?? null;
    }

    /**
     * Suspend a therapist account.
     */
    public function suspend(Request $request, $id): JsonResponse
    {
        try {
            // Log untuk debugging
            Log::info('Suspend attempt', [
                'terapis_id' => $id,
                'request_data' => $request->all(),
            ]);

            // Validasi data
            $validatedData = $request->validate([
                'reason' => 'required|string',
                'description' => 'required|string|max:500',
                'duration' => 'required|string',
            ]);

            // Ambil data terapis
            $terapisData = $this->getTerapisDataById($id);

            // Fallback jika terapis tidak ditemukan
            if (!$terapisData) {
                $terapisData = [
                    'nama' => 'Terapis Tidak Dikenal',
                    'jenis_kelamin' => '-',
                    'area_kerja' => '-',
                ];
            }

            // Map durasi dari form value ke display text
            $durationMap = [
                '1' => '7 Hari',
                '7' => '14 Hari',
                '14' => '30 Hari',
                '30' => 'Permanen',
            ];
            $durasi = $durationMap[$validatedData['duration']] ?? $validatedData['duration'];

            // Simulasi proses penangguhan
            $suspendedAccounts = $request->session()->get('suspended_accounts', []);
            
            $newSuspendedAccount = [
                'id' => $id,
                'nama' => $terapisData['nama'],
                'kelamin' => $terapisData['jenis_kelamin'],
                'kota' => $terapisData['area_kerja'], // Menggunakan area_kerja sebagai kota
                'durasi' => $durasi,
                'waktu' => now()->format('H:i'),
            ];

            $suspendedAccounts[] = $newSuspendedAccount;
            $request->session()->put('suspended_accounts', $suspendedAccounts);
            
            Log::info('Account suspended successfully', [
                'terapis_id' => $id,
                'validated_data' => $validatedData,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Akun berhasil ditangguhkan.',
                'data' => [
                    'terapis_id' => $id,
                    'suspended_at' => now()->toDateTimeString(),
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Suspend validation failed', [
                'terapis_id' => $id,
                'errors' => $e->errors(),
            ]);
            return response()->json([
                'success' => false, 
                'message' => 'Data tidak valid.', 
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Suspend failed', [
                'terapis_id' => $id,
                'error' => $e->getMessage(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem. Silakan coba lagi.'
            ], 500);
        }
    }
}