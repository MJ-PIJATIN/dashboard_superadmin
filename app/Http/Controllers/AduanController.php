<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AduanController extends Controller
{
    // Data dummy untuk aduan - dalam implementasi nyata, ini akan diambil dari database
    private function getAduanData()
{
    $baseData = [
        [
            'nama_pelapor' => 'Dandia Rianti',
            'jenis_aduan' => 'Perilaku Tidak Sopan',
            'deskripsi' => 'Selama sesi pijat yang saya terima dari Samsul Alamayah...',
            'waktu' => '17:30',
            'lokasi' => 'Pulogadung, Jakarta Timur',
            'status_pelapor' => 'Pelanggan',
            'nama_terlapor' => 'Samsul Alamayah',
            'area_kerja' => 'Jakarta Timur',
            'jenis_kelamin' => 'Laki-Laki',
            'alamat_terlapor' => 'Kecamatan Pulogadung, Jakarta Timur 13230, Jakarta Timur',
            'detail_aduan' => [
                'Penggunaan bahasa kasar.',
                'Kontak fisik tidak diinginkan.',
                'Sikap tidak menghormati privasi.',
            ],
            'penutup_aduan' => 'Saya merasa sangat tidak nyaman dan dirugikan.'
        ],
        [
            'nama_pelapor' => 'Ahmad Rizki',
            'jenis_aduan' => 'Pelecehan Seksual',
            'deskripsi' => 'Terapis melakukan tindakan yang tidak pantas...',
            'waktu' => '14:20',
            'lokasi' => 'Menteng, Jakarta Pusat',
            'status_pelapor' => 'Pelanggan',
            'nama_terlapor' => 'Budi Santoso',
            'area_kerja' => 'Jakarta Pusat',
            'jenis_kelamin' => 'Laki-Laki',
            'alamat_terlapor' => 'Kecamatan Menteng, Jakarta Pusat',
            'detail_aduan' => [
                'Menyentuh area sensitif.',
                'Komentar tidak pantas.',
                'Mengabaikan permintaan.',
            ],
            'penutup_aduan' => 'Saya berharap tindakan tegas diambil.'
        ],
        [
            'nama_pelapor' => 'Siti Nurhaliza',
            'jenis_aduan' => 'Layanan Tidak Profesional',
            'deskripsi' => 'Terapis datang terlambat dan tidak membawa peralatan...',
            'waktu' => '10:15',
            'lokasi' => 'Kelapa Gading, Jakarta Utara',
            'status_pelapor' => 'Pelanggan',
            'nama_terlapor' => 'Joko Widodo',
            'area_kerja' => 'Jakarta Utara',
            'jenis_kelamin' => 'Laki-Laki',
            'alamat_terlapor' => 'Kelapa Gading, Jakarta Utara',
            'detail_aduan' => [
                'Datang terlambat.',
                'Tidak membawa minyak.',
                'Teknik tidak sesuai.',
            ],
            'penutup_aduan' => 'Harap ada perbaikan kualitas layanan.'
        ],
        [
            'nama_pelapor' => 'Rina Sari',
            'jenis_aduan' => 'Penipuan',
            'deskripsi' => 'Terapis meminta biaya tambahan di luar kesepakatan...',
            'waktu' => '16:45',
            'lokasi' => 'Kebayoran Baru, Jakarta Selatan',
            'status_pelapor' => 'Pelanggan',
            'nama_terlapor' => 'Agus Setiawan',
            'area_kerja' => 'Jakarta Selatan',
            'jenis_kelamin' => 'Laki-Laki',
            'alamat_terlapor' => 'Kebayoran Baru, Jakarta Selatan',
            'detail_aduan' => [
                'Biaya tambahan Rp 100.000.',
                'Biaya transport tidak jelas.',
                'Ancaman penghentian layanan.',
            ],
            'penutup_aduan' => 'Tindakan penipuan yang tidak dapat diterima.'
        ],
        [
            'nama_pelapor' => 'Bambang Pamungkas',
            'jenis_aduan' => 'Kekerasan Mental',
            'deskripsi' => 'Terapis menggunakan tekanan berlebihan...',
            'waktu' => '13:30',
            'lokasi' => 'Cempaka Putih, Jakarta Pusat',
            'status_pelapor' => 'Pelanggan',
            'nama_terlapor' => 'Indra Wijaya',
            'area_kerja' => 'Jakarta Pusat',
            'jenis_kelamin' => 'Laki-Laki',
            'alamat_terlapor' => 'Cempaka Putih, Jakarta Pusat',
            'detail_aduan' => [
                'Tekanan berlebihan.',
                'Mengabaikan keluhan.',
                'Menyebabkan memar.',
            ],
            'penutup_aduan' => 'Saya perlu pengobatan karena memar.'
        ],
    ];

    $aduan = [];
    for ($i = 1; $i <= 200; $i++) {
        $template = $baseData[($i - 1) % count($baseData)];
        $template['id'] = $i;
        $template['nama_pelapor'];
        $template['waktu'] = date("H:i", strtotime("08:00 +". ($i * 7) ." minutes"));
        $template['deskripsi'];
        $aduan[] = $template;
    }

    return $aduan;
}

    public function index(Request $request)
    {
        $aduan = $this->getAduanData();
        $perPage = 10; // Jumlah item per halaman
        $currentPage = $request->get('page', 1);
        
        // Filter berdasarkan pencarian jika ada
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = strtolower($request->search);
            $aduan = array_filter($aduan, function($item) use ($searchTerm) {
                return strpos(strtolower($item['nama_pelapor']), $searchTerm) !== false ||
                       strpos(strtolower($item['jenis_aduan']), $searchTerm) !== false ||
                       strpos(strtolower($item['deskripsi']), $searchTerm) !== false ||
                       strpos(strtolower($item['nama_terlapor']), $searchTerm) !== false;
            });
        }

        // Pagination
        $total = count($aduan);
        $totalPages = ceil($total / $perPage);
        $offset = ($currentPage - 1) * $perPage;
        $paginatedAduan = array_slice($aduan, $offset, $perPage);

        // Add pagination info
        $paginationData = [
            'current_page' => $currentPage,
            'total_pages' => $totalPages,
            'per_page' => $perPage,
            'total' => $total,
            'from' => $offset + 1,
            'to' => min($offset + $perPage, $total)
        ];

        return view('pages.SuperAdminAduanPelanggan', compact('paginatedAduan', 'paginationData'));
    }

    public function show($id)
    {
        $aduan = $this->getAduanData();
        $detailAduan = collect($aduan)->firstWhere('id', (int)$id);
        
        if (!$detailAduan) {
            abort(404, 'Aduan tidak ditemukan');
        }

        return view('pages.SuperAdminDetailAduan', compact('detailAduan'));
    }

    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q', '');
        $aduan = $this->getAduanData();
        
        if (empty($query)) {
            return response()->json([
                'success' => true,
                'data' => $aduan
            ]);
        }

        $searchTerm = strtolower($query);
        $filteredAduan = array_filter($aduan, function($item) use ($searchTerm) {
            return strpos(strtolower($item['nama_pelapor']), $searchTerm) !== false ||
                   strpos(strtolower($item['jenis_aduan']), $searchTerm) !== false ||
                   strpos(strtolower($item['deskripsi']), $searchTerm) !== false ||
                   strpos(strtolower($item['nama_terlapor']), $searchTerm) !== false;
        });

        return response()->json([
            'success' => true,
            'data' => array_values($filteredAduan)
        ]);
    }
}