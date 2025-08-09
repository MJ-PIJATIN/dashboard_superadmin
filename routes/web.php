<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\SuspendedAccountController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AduanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TerapisController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KaryawanController;

// Routing ke Landing Page
Route::get('/', function () {
    return view('pages.SuperAdminLandingPage');
});

// Routing Login dan Logout
Route::get('/login', function () {
    return view('pages.SuperAdminLogin');
})->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routing Sidebar Super Admin
Route::get('/dashboard', function () {
    return view('pages.SuperAdminDashboard');
})->name('dashboard');

// Page Layanan
Route::get('/layanan', [App\Http\Controllers\LayananController::class, 'index'])->name('layanan');
Route::post('/layanan-utama/update', [App\Http\Controllers\LayananController::class, 'update'])->name('layanan-utama.update');
Route::post('/layanan-utama/update-status', [App\Http\Controllers\LayananController::class, 'updateStatus'])->name('layanan-utama.updateStatus');
Route::delete('/layanan-utama/delete', [App\Http\Controllers\LayananController::class, 'destroy'])->name('layanan-utama.delete');
Route::post('/layanan-utama/store', [App\Http\Controllers\LayananController::class, 'store'])->name('layanan-utama.store');

Route::post('/layanan-tambahan/store', [App\Http\Controllers\LayananController::class, 'storeTambahan'])->name('layanan-tambahan.store');
Route::post('/layanan-tambahan/update', [App\Http\Controllers\LayananController::class, 'updateTambahan'])->name('layanan-tambahan.update');
Route::delete('/layanan-tambahan/delete', [App\Http\Controllers\LayananController::class, 'destroyTambahan'])->name('layanan-tambahan.delete');

// Page Pesanan
Route::get('/pesanan', function () {
    return view('pages.SuperAdminPesanan');
})->name('pesanan');

// Halaman Cabang
Route::prefix('cabang')->group(function () {
    Route::get('/', [CabangController::class, 'index'])->name('cabang');
    Route::get('/tambah', fn () => view('pages.SuperAdminTambahCabang'))->name('cabang.tambah');
    Route::post('/tambah', [CabangController::class, 'store'])->name('cabang.store');
    Route::get('/{id}', [CabangController::class, 'show'])
        ->where('id', '[A-Za-z0-9]+')
        ->name('cabang.detail');
    Route::patch('/{id}/toggle-status', [CabangController::class, 'toggleStatus'])->name('cabang.toggleStatus');
});

Route::prefix('superadmin/cabang')->group(function () {
    Route::get('/{id}/edit', [CabangController::class, 'edit'])->name('cabang.edit');
    Route::put('/{id}/update', [CabangController::class, 'update'])->name('cabang.update');
});

//Halaman Karyawan
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
Route::get('/karyawan/search', [KaryawanController::class, 'search'])->name('karyawan.search');

//Halaman Pelanggan
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan');
Route::get('/pelanggan/search', [PelangganController::class, 'search'])->name('pelanggan.search');
Route::patch('/pelanggan/{id}/toggle-status', [PelangganController::class, 'toggleStatus'])->name('pelanggan.toggleStatus');
Route::get('/pelanggan/{id}', [PelangganController::class, 'show'])->name('detail.akun.pelanggan');

// Halaman Terapis
Route::get('/terapis', function () {
    return view('pages.SuperAdminTerapis');
})->name('terapis');

// Halaman Detail Terapis
Route::get('/detail-terapis', function () {
    return view('pages.SuperAdminDetailTerapis');
})->name('detail-terapis');

Route::get('/tambah-terapis', [TerapisController::class, 'create'])->name('tambah-terapis');
Route::post('/terapis/store', [TerapisController::class, 'store'])->name('terapis.store');
Route::post('/terapis/{id}/suspend', [SuspendedAccountController::class, 'suspend'])->name('terapis.suspend')->where('id', '[0-9]+');

//Halaman Penangguhan
Route::get('/penangguhan', [SuspendedAccountController::class, 'index'])->name('penangguhan');
Route::delete('/superadmin/penangguhan/{id}/pulihkan', [SuspendedAccountController::class, 'restore'])->name('penangguhan.restore');
Route::prefix('admin')->group(function () {
    
    // Routes untuk akun ditangguhkan
    Route::prefix('akun-ditangguhkan')->name('suspended-account.')->group(function () {

        // Halaman detail akun ditangguhkan
        Route::get('/{id}/detail', [SuspendedAccountController::class, 'detail'])
            ->name('detail')
            ->where('id', '[0-9]+'); // Hanya menerima ID berupa angka
        
        // API untuk memulihkan akun (AJAX)
        Route::post('/{id}/restore', [SuspendedAccountController::class, 'restore'])
            ->name('restore')
            ->where('id', '[0-9]+');
        
        // API untuk pencarian akun
        Route::get('/search', [SuspendedAccountController::class, 'search'])
            ->name('search');
        
    });
});

// Routes untuk Aduan Pelanggan
Route::get('/aduan-pelanggan', [App\Http\Controllers\AduanController::class, 'index'])->name('aduan-pelanggan');
Route::get('/detail-aduan/{id}', [App\Http\Controllers\AduanController::class, 'show'])->name('detiladuan');
Route::get('/aduan/search', [App\Http\Controllers\AduanController::class, 'search'])->name('aduan.search');
Route::get('/detail-report-terapis/{aduan_id}', [App\Http\Controllers\AduanController::class, 'showTerapisDetail'])->name('detail.report.terapis');
Route::post('/suspended-accounts/{id}/restore', [SuspendedAccountController::class, 'restore'])->name('suspended-account.restore');

// Halaman FAQ
Route::resource('faqs', FaqController::class);

//Page Pesanan
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');

Route::get('/pesanan/detail/{tipe}/{id}', [PesananController::class, 'detail'])->name('pesanan.detail');

Route::put('/pesanan/{tipe}/{id}/update-status', [PesananController::class, 'updateStatus'])
    ->name('pesanan.updateStatus');

//PAGE KARYAWAN
//tambah karyawan
Route::get('/tambah/karyawan', function () {
    return view('pages.SuperAdminKaryawanBuatAkun');
})->name('tambah.karyawan');

// detail karyawan admin
Route::get('/karyawan/{id}', function ($id) {
    return view('pages.SuperAdminKaryawanDetailAkun', ['id' => $id]);
})->where('id', '[0-9]+')->name('detail.karyawan');

// detail karyawan finance 
Route::get('/karyawan/finance/{id}', function ($id) {
    return view('pages.SuperAdminKaryawanDetailAkunFInance', ['id' => $id]);
})->where('id', '[0-9]+')->name('detail.akun.finance');

//PAGE PELANGGAN
// detail akun pelanggan
Route::get('/pelanggan/{id}', function ($id) {
    return view('pages.SuperAdminPelangganDetailAkun', ['id' => $id]);
})->where('id', '[0-9]+')->name('detail.akun.pelanggan');

// Tambahkan route ini di web.php (temporary untuk cleaning)
Route::get('/clean-suspended-data', function(Request $request) {
    // Ambil data session saat ini
    $suspended = $request->session()->get('suspended_accounts', []);
    
    echo "<h2>Data Session SEBELUM dibersihkan:</h2>";
    echo "<pre>";
    print_r($suspended);
    echo "</pre>";
    
    // Bersihkan data - hapus yang nama = "Terapis Ditangguhkan"
    $cleaned = [];
    $removed = [];
    
    foreach ($suspended as $index => $account) {
        // Jika nama = "Terapis Ditangguhkan", skip (tidak masukkan ke cleaned)
        if ($account['nama'] === 'Terapis Ditangguhkan') {
            $removed[] = $account;
            continue; // Skip data ini
        }
        
        // Perbaiki format durasi jika masih angka
        if (is_numeric($account['durasi'])) {
            $durationMap = [
                '1' => '7 Hari',
                '7' => '14 Hari',
                '14' => '30 Hari',
                '30' => 'Permanen'
            ];
            $account['durasi'] = $durationMap[$account['durasi']] ?? $account['durasi'];
        }
        
        $cleaned[] = $account;
    }
    
    // Simpan data yang sudah dibersihkan ke session
    $request->session()->put('suspended_accounts', $cleaned);
    $request->session()->save(); // Force save
    
    echo "<h2>Data yang DIHAPUS:</h2>";
    echo "<pre>";
    print_r($removed);
    echo "</pre>";
    
    echo "<h2>Data Session SETELAH dibersihkan:</h2>";
    echo "<pre>";
    print_r($cleaned);
    echo "</pre>";
    
    echo "<h2>Summary:</h2>";
    echo "Data sebelumnya: " . count($suspended) . " akun<br>";
    echo "Data dihapus: " . count($removed) . " akun<br>";
    echo "Data tersisa: " . count($cleaned) . " akun<br>";
    
    echo "<br><a href='/penangguhan' style='background: #469D89; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Lihat Halaman Penangguhan</a>";
    
    return null; // Sudah echo di atas
});

// Route untuk reset session (jika diperlukan)
Route::get('/reset-suspended-data', function(Request $request) {
    // Data default yang bersih
    $defaultCleanData = [
        [
            'id' => 3,
            'nama' => 'Joko Widodo',
            'kelamin' => 'Laki-Laki', 
            'kota' => 'Jakarta Utara',
            'durasi' => 'Permanen',
            'waktu' => '15:53'
        ],
        [
            'id' => 5,
            'nama' => 'Indra Wijaya',
            'kelamin' => 'Laki-Laki',
            'kota' => 'Jakarta Pusat', 
            'durasi' => '14 Hari',
            'waktu' => '15:56'
        ],
        [
            'id' => 2,
            'nama' => 'Budi Santoso',
            'kelamin' => 'Laki-Laki',
            'kota' => 'Jakarta Pusat',
            'durasi' => '30 Hari', 
            'waktu' => '16:04'
        ],
        [
            'id' => 1,
            'nama' => 'Karsa Wijaya',
            'kelamin' => 'Laki-Laki',
            'kota' => 'Kertasari, Bandung',
            'durasi' => '7 Hari',
            'waktu' => '16:08'
        ]
    ];
    
    $request->session()->put('suspended_accounts', $defaultCleanData);
    $request->session()->save();
    
    echo "<h2>Session berhasil direset dengan data bersih!</h2>";
    echo "<pre>";
    print_r($defaultCleanData);
    echo "</pre>";
    
    echo "<br><a href='/penangguhan' style='background: #469D89; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Lihat Halaman Penangguhan</a>";
});

// Route untuk clear semua data suspended (kosongkan)
Route::get('/clear-all-suspended', function(Request $request) {
    $request->session()->forget('suspended_accounts');
    $request->session()->save();
    
    echo "<h2>Semua data penangguhan berhasil dihapus!</h2>";
    echo "Session 'suspended_accounts' telah dikosongkan.";
    echo "<br><br><a href='/penangguhan' style='background: #469D89; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Lihat Halaman Penangguhan</a>";
});