<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class SuspendedAccountController extends Controller
{
    /**
     * Display a listing of suspended accounts.
     */
    public function index()
    {
        // Data dummy untuk sementara - nanti bisa diganti dengan database
        $suspendedAccounts = [
            ['id' => 1, 'nama' => 'Karsa Wijaya', 'kelamin' => 'Laki-Laki', 'kota' => 'Bandung', 'durasi' => 'Permanen', 'durasi_class' => 'bg-red-100 text-red-600', 'waktu' => '10:20'],
            ['id' => 2, 'nama' => 'Dandia Rianti', 'kelamin' => 'Perempuan', 'kota' => 'Jakarta Timur', 'durasi' => '30 Hari', 'durasi_class' => 'bg-orange-100 text-orange-600', 'waktu' => '15:00'],
            ['id' => 3, 'nama' => 'Santi Martini', 'kelamin' => 'Perempuan', 'kota' => 'Jakarta Timur', 'durasi' => 'Permanen', 'durasi_class' => 'bg-red-100 text-red-600', 'waktu' => '18:23'],
            ['id' => 4, 'nama' => 'Tono Winarto', 'kelamin' => 'Laki-Laki', 'kota' => 'Jakarta Selatan', 'durasi' => '30 Hari', 'durasi_class' => 'bg-orange-100 text-orange-600', 'waktu' => '20:10'],
            ['id' => 5, 'nama' => 'Chandra Utama', 'kelamin' => 'Laki-Laki', 'kota' => 'Pekalongan', 'durasi' => 'Permanen', 'durasi_class' => 'bg-red-100 text-red-600', 'waktu' => '21:45'],
            ['id' => 6, 'nama' => 'Willy Kusuma', 'kelamin' => 'Laki-Laki', 'kota' => 'Bandung', 'durasi' => '7 Hari', 'durasi_class' => 'bg-yellow-100 text-yellow-600', 'waktu' => '6 Nov'],
            ['id' => 7, 'nama' => 'Willy Kusuma', 'kelamin' => 'Laki-Laki', 'kota' => 'Bandung', 'durasi' => '7 Hari', 'durasi_class' => 'bg-yellow-100 text-yellow-600', 'waktu' => '6 Nov'],
            ['id' => 8, 'nama' => 'Willy Kusuma', 'kelamin' => 'Laki-Laki', 'kota' => 'Bandung', 'durasi' => '7 Hari', 'durasi_class' => 'bg-yellow-100 text-yellow-600', 'waktu' => '6 Nov'],
            ['id' => 9, 'nama' => 'Willy Kusuma', 'kelamin' => 'Laki-Laki', 'kota' => 'Bandung', 'durasi' => '7 Hari', 'durasi_class' => 'bg-yellow-100 text-yellow-600', 'waktu' => '6 Nov'],
            ['id' => 10, 'nama' => 'Kamaria Mandasari', 'kelamin' => 'Perempuan', 'kota' => 'Surakarta', 'durasi' => '14 Hari', 'durasi_class' => 'bg-yellow-100 text-yellow-600', 'waktu' => '2 Nov'],
            ['id' => 11, 'nama' => 'Uda Lazuardi', 'kelamin' => 'Laki-Laki', 'kota' => 'Bandung', 'durasi' => 'Permanen', 'durasi_class' => 'bg-red-100 text-red-600', 'waktu' => '20/12/22'],
        ];

        // Debug untuk memastikan data terkirim
        // dd($suspendedAccounts); // Uncomment untuk debugging

        return view('pages.SuperAdminPenangguhan', compact('suspendedAccounts'));
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
     * Restore a suspended account.
     */
    public function restore(Request $request, $id): JsonResponse
    {
        try {
            // Validasi input
            $request->validate([
                'account_id' => 'sometimes|integer'
            ]);

            // Logic untuk memulihkan akun di sini
            // Contoh: Update status di database
            // $account = SuspendedAccount::findOrFail($id);
            // $account->status = 'active';
            // $account->suspended_until = null;
            // $account->save();

            // Log aktivitas
            Log::info("Account restored", [
                'account_id' => $id,
                'restored_by' => auth()->id() ?? 'system',
                'restored_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Akun berhasil dipulihkan!',
                'data' => [
                    'account_id' => (int)$id,
                    'restored_at' => now()->format('Y-m-d H:i:s')
                ]
            ]);

        } catch (\Exception $e) {
            Log::error("Failed to restore account", [
                'account_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal memulihkan akun. Silakan coba lagi.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
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
            
            // Logic pencarian di sini
            // Untuk sementara return data dummy yang difilter
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