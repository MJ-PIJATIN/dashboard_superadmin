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
                'deskripsi' => 'Selama sesi pijat yang saya terima dari Samsul Alamsyah, saya merasa tidak nyaman karena terapis menggunakan bahasa kasar dan melakukan kontak fisik yang tidak diinginkan.',
                'waktu' => '17:30',
                'lokasi' => 'Pulogadung, Jakarta Timur',
                'status_pelapor' => 'Pelanggan',
                'nama_terlapor' => 'Karsa Wijaya',
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
            if ($i <= 3) {
                $template['read_at'] = null;
            } else {
                $template['read_at'] = date('Y-m-d H:i:s');
            }
            $aduan[] = $template;
        }

        return $aduan;
    }

    // Data dummy untuk detail terapis - biasanya akan diambil dari database berdasarkan nama_terlapor
    private function getTerapisData($nama_terlapor)
    {
        // Data dummy detail terapis berdasarkan nama terlapor
        $terapisDetails = [
            'Samsul Alamayah' => [
                'id' => 'TRS008031',
                'nama' => 'Samsul Alamayah',
                'email' => 'samsul.alamayah@gmail.com',
                'ponsel' => '082954627818',
                'area_kerja' => 'Jakarta Timur',
                'status_akun' => 'Tidak dalam Penangguhan',
                'nik' => '31718958332409035',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '15 Agustus 1988',
                'jenis_kelamin' => 'Laki-Laki',
                'alamat' => 'Jl. Raya Bekasi No. 45, Pulogadung, Jakarta Timur',
                'tanggal_bergabung' => '10 Januari 2022',
                'total_layanan' => 75,
                'layanan_ditolak' => 3,
                'total_peringatan' => 1
            ],
            'Budi Santoso' => [
                'id' => 'TRS008032',
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@gmail.com',
                'ponsel' => '081234567890',
                'area_kerja' => 'Jakarta Pusat',
                'status_akun' => 'Dalam Penangguhan',
                'nik' => '31718958332409036',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '20 Mei 1985',
                'jenis_kelamin' => 'Laki-Laki',
                'alamat' => 'Jl. Menteng Raya No. 123, Menteng, Jakarta Pusat',
                'tanggal_bergabung' => '15 Maret 2021',
                'total_layanan' => 42,
                'layanan_ditolak' => 8,
                'total_peringatan' => 3
            ],
            'Joko Widodo' => [
                'id' => 'TRS008033',
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
                'tanggal_bergabung' => '05 Juli 2020',
                'total_layanan' => 120,
                'layanan_ditolak' => 2,
                'total_peringatan' => 0
            ],
            'Agus Setiawan' => [
                'id' => 'TRS008034',
                'nama' => 'Agus Setiawan',
                'email' => 'agus.setiawan@gmail.com',
                'ponsel' => '087654321098',
                'area_kerja' => 'Jakarta Selatan',
                'status_akun' => 'Tidak dalam Penangguhan',
                'nik' => '31718958332409038',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '12 Desember 1990',
                'jenis_kelamin' => 'Laki-Laki',
                'alamat' => 'Jl. Kebayoran Baru No. 56, Kebayoran Baru, Jakarta Selatan',
                'tanggal_bergabung' => '20 September 2022',
                'total_layanan' => 30,
                'layanan_ditolak' => 5,
                'total_peringatan' => 2
            ],
            'Indra Wijaya' => [
                'id' => 'TRS008035',
                'nama' => 'Indra Wijaya',
                'email' => 'indra.wijaya@gmail.com',
                'ponsel' => '085432109876',
                'area_kerja' => 'Jakarta Pusat',
                'status_akun' => 'Tidak dalam Penangguhan',
                'nik' => '31718958332409039',
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => '08 Oktober 1987',
                'jenis_kelamin' => 'Laki-Laki',
                'alamat' => 'Jl. Cempaka Putih Tengah No. 22, Cempaka Putih, Jakarta Pusat',
                'tanggal_bergabung' => '12 November 2021',
                'total_layanan' => 65,
                'layanan_ditolak' => 4,
                'total_peringatan' => 1
            ]
        ];

        // Return default data jika nama terlapor tidak ditemukan
        return $terapisDetails[$nama_terlapor] ?? [
            'id' => 'TRS008031',
            'nama' => 'Karsa Wijaya',
            'email' => 'Karsawijaya@gmail.com',
            'ponsel' => '082954627818',
            'area_kerja' => 'Kertasari, Bandung',
            'status_akun' => 'Tidak dalam Penangguhan',
            'nik' => '31718958332409035',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '03 Mei 1994',
            'jenis_kelamin' => 'Laki-Laki',
            'alamat' => 'Jl Tmn Siswa 4, Cibeurem, Kertasari, Bandung, Jawa Barat',
            'tanggal_bergabung' => '02 Maret 2023',
            'total_layanan' => 50,
            'layanan_ditolak' => 2,
            'total_peringatan' => 1
        ];
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

    // TAMBAHAN BARU: Method untuk menampilkan detail terapis dari aduan
    public function showTerapisDetail($aduan_id)
    {
        $aduan = $this->getAduanData();
        $detailAduan = collect($aduan)->firstWhere('id', (int)$aduan_id);
        
        if (!$detailAduan) {
            abort(404, 'Aduan tidak ditemukan');
        }

        // Ambil detail terapis berdasarkan nama terlapor dari aduan
        $detailTerapis = $this->getTerapisData($detailAduan['nama_terlapor']);
        
        // Gabungkan data aduan dengan detail terapis untuk konteks
        $data = [
            'detailTerapis' => $detailTerapis,
            'aduanContext' => $detailAduan // Untuk konteks aduan yang memicu detail ini
        ];

        return view('pages.SuperAdminDetailAkunReportTerapis', $data);
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