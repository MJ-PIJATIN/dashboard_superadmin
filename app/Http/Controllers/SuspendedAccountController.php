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
        // Data dummy untuk sementara - nanti bisa diganti dengan database
        $allSuspendedAccounts = [
            ['id' => 1, 'nama' => 'Karsa Wijaya', 'kelamin' => 'Laki-Laki', 'kota' => 'Bandung', 'durasi' => 'Permanen', 'waktu' => '10:20'],
            ['id' => 2, 'nama' => 'Dandia Rianti', 'kelamin' => 'Perempuan', 'kota' => 'Jakarta Timur', 'durasi' => '30 Hari', 'waktu' => '15:00'],
            ['id' => 3, 'nama' => 'Santi Martini', 'kelamin' => 'Perempuan', 'kota' => 'Jakarta Timur', 'durasi' => 'Permanen', 'waktu' => '18:23'],
            ['id' => 4, 'nama' => 'Tono Winarto', 'kelamin' => 'Laki-Laki', 'kota' => 'Jakarta Selatan', 'durasi' => '30 Hari', 'waktu' => '20:10'],
            ['id' => 5, 'nama' => 'Chandra Utama', 'kelamin' => 'Laki-Laki', 'kota' => 'Pekalongan', 'durasi' => 'Permanen', 'waktu' => '21:45'],
            ['id' => 6, 'nama' => 'Willy Kusuma', 'kelamin' => 'Laki-Laki', 'kota' => 'Bandung', 'durasi' => '7 Hari', 'waktu' => '6 Nov'],
            ['id' => 7, 'nama' => 'Willy Kusuma', 'kelamin' => 'Laki-Laki', 'kota' => 'Bandung', 'durasi' => '7 Hari', 'waktu' => '6 Nov'],
            ['id' => 8, 'nama' => 'Willy Kusuma', 'kelamin' => 'Laki-Laki', 'kota' => 'Bandung', 'durasi' => '7 Hari', 'waktu' => '6 Nov'],
            ['id' => 9, 'nama' => 'Willy Kusuma', 'kelamin' => 'Laki-Laki', 'kota' => 'Bandung', 'durasi' => '7 Hari', 'waktu' => '6 Nov'],
            ['id' => 10, 'nama' => 'Kamaria Mandasari', 'kelamin' => 'Perempuan', 'kota' => 'Surakarta', 'durasi' => '14 Hari', 'waktu' => '2 Nov'],
            ['id' => 11, 'nama' => 'Uda Lazuardi', 'kelamin' => 'Laki-Laki', 'kota' => 'Bandung', 'durasi' => 'Permanen', 'waktu' => '20/12/22'],
        ];

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
            // Log untuk debugging
            Log::info('Restore attempt', [
                'account_id' => $id,
                'request_data' => $request->all(),
                'route_param' => $id
            ]);
            
            // Convert ID to integer dan validasi
            $accountId = (int) $id;
            
            if ($accountId <= 0) {
                Log::warning('Invalid account ID provided', ['id' => $id, 'converted_id' => $accountId]);
                return response()->json([
                    'success' => false,
                    'message' => 'ID akun tidak valid'
                ], 400);
            }
            
            // Data dummy suspended accounts
            $suspendedAccounts = [
                1 => 'Karsa Wijaya',
                2 => 'Dandia Rianti',
                3 => 'Santi Martini',
                4 => 'Tono Winarto',
                5 => 'Chandra Utama',
                6 => 'Willy Kusuma',
                7 => 'Willy Kusuma',
                8 => 'Willy Kusuma',
                9 => 'Willy Kusuma',
                10 => 'Kamaria Mandasari',
                11 => 'Uda Lazuardi'
            ];
            
            // Cek apakah akun dengan ID tersebut ada
            if (!isset($suspendedAccounts[$accountId])) {
                Log::warning('Account not found', ['account_id' => $accountId]);
                return response()->json([
                    'success' => false,
                    'message' => 'Akun dengan ID tersebut tidak ditemukan'
                ], 404);
            }
            
            // Simulasi proses restore
            $accountName = $suspendedAccounts[$accountId];
            
            // Simulasi delay untuk menunjukkan loading
            sleep(1);
            
            // Log sukses
            Log::info('Account restored successfully', [
                'account_id' => $accountId,
                'account_name' => $accountName
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Akun berhasil dipulihkan',
                'data' => [
                    'account_id' => $accountId,
                    'account_name' => $accountName,
                    'restored_at' => now()->toDateTimeString()
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Restore failed', [
                'account_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
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
}