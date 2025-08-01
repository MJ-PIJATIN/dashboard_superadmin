<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesananController extends Controller
{
    public $cash = [];
    public $transfer = [];

    public function __construct()
    {
        $this->transfer = collect([
            [
                'nama'=>'Salsabila','gender'=>'female','ponsel'=>'081234567891','layanan'=>'Deep Tissue Massage','jadwal'=>'11-30-23','tanggal_pemesanan'=>'11-28-23','alamat'=>'Jl. Mawar No. 12, Jakarta Selatan','status'=>'Menunggu','layanan_tambahan'=>['Aromatherapy','Totok Wajah','Refleksi'],'harga'=>250000,'durasi'=>'90 Menit','total_layanan'=>300000,'metode'=>'Transfer','terapis'=>[]],
                ['nama'=>'Marina Wirna','gender'=>'female','ponsel'=>'082345678912','layanan'=>'Hot Stone Massage','jadwal'=>'11-30-23','tanggal_pemesanan'=>'11-27-23','alamat'=>'Jl. Anggrek No. 7, Jakarta Barat','status'=>'Berlangsung','layanan_tambahan'=>['Refleksi','Kerokan','Aromatherapy'],'harga'=>270000,'durasi'=>'90 Menit','total_layanan'=>310000,'metode'=>'Transfer','terapis'=>[]],
                ['nama'=>'Mamat Yasin','gender'=>'male','ponsel'=>'083356789123','layanan'=>'Deep Tissue Massage','jadwal'=>'08-10-23','tanggal_pemesanan'=>'08-08-23','alamat'=>'Jl. Kenanga No. 5, Jakarta Timur','status'=>'Dijadwalkan','layanan_tambahan'=>['Kerokan','Totok Wajah','Refleksi'],'harga'=>200000,'durasi'=>'60 Menit','total_layanan'=>230000,'metode'=>'Transfer','terapis'=>[]],
                ['nama'=>'Sudaryono','gender'=>'male','ponsel'=>'084467891234','layanan'=>'Thai Massage','jadwal'=>'11-30-23','tanggal_pemesanan'=>'11-29-23','alamat'=>'Jl. Melati No. 10, Jakarta Utara','status'=>'Dijadwalkan','layanan_tambahan'=>['Totok Wajah','Aromatherapy','Refleksi'],'harga'=>180000,'durasi'=>'70 Menit','total_layanan'=>210000,'metode'=>'Transfer','terapis'=>[]],
                ['nama'=>'Muhammad Alfir','gender'=>'male','ponsel'=>'085578912345','layanan'=>'Deep Tissue Massage','jadwal'=>'08-10-23','tanggal_pemesanan'=>'08-09-23','alamat'=>'Jl. Dahlia No. 3, Jakarta Timur','status'=>'Dibatalkan','layanan_tambahan'=>['Refleksi','Kerokan','Aromatherapy'],'harga'=>220000,'durasi'=>'80 Menit','total_layanan'=>220000,'metode'=>'Transfer','terapis'=>[]],
                ['nama'=>'Rizky Bowling','gender'=>'male','ponsel'=>'086689123456','layanan'=>'Swedish Massage','jadwal'=>'08-10-23','tanggal_pemesanan'=>'08-08-23','alamat'=>'Jl. Merpati No. 17, Jakarta Selatan','status'=>'Selesai','layanan_tambahan'=>['Refleksi','Totok Wajah','Kerokan'],'harga'=>240000,'durasi'=>'75 Menit','total_layanan'=>270000,'metode'=>'Transfer','terapis'=>[]],
                ['nama'=>'Tommy Malik','gender'=>'male','ponsel'=>'087791234567','layanan'=>'Thai Massage','jadwal'=>'11-29-23','tanggal_pemesanan'=>'11-28-23','alamat'=>'Jl. Cendana No. 11, Jakarta Barat','status'=>'Dibatalkan','layanan_tambahan'=>['Aromatherapy','Refleksi','Totok Wajah'],'harga'=>190000,'durasi'=>'60 Menit','total_layanan'=>190000,'metode'=>'Transfer','terapis'=>[]],
                ['nama'=>'Salma Rifqana','gender'=>'female','ponsel'=>'088812345678','layanan'=>'Full Body Massage','jadwal'=>'11-29-23','tanggal_pemesanan'=>'11-28-23','alamat'=>'Jl. Kemuning No. 21, Jakarta Selatan','status'=>'Dibatalkan','layanan_tambahan'=>['Kerokan','Totok Wajah','Refleksi'],'harga'=>230000,'durasi'=>'85 Menit','total_layanan'=>230000,'metode'=>'Transfer','terapis'=>[]],
                ['nama'=>'Winda Harmoni','gender'=>'female','ponsel'=>'089923456789','layanan'=>'Hot Stone Massage','jadwal'=>'11-29-23','tanggal_pemesanan'=>'11-27-23','alamat'=>'Jl. Flamboyan No. 4, Jakarta Pusat','status'=>'Selesai','layanan_tambahan'=>['Aromatherapy','Refleksi','Kerokan'],'harga'=>260000,'durasi'=>'90 Menit','total_layanan'=>300000,'metode'=>'Transfer','terapis'=>[]],
                ['nama'=>'Umi Sarimi','gender'=>'female','ponsel'=>'080034567890','layanan'=>'Full Body Massage','jadwal'=>'11-29-23','tanggal_pemesanan'=>'11-28-23','alamat'=>'Jl. Teratai No. 15, Jakarta Barat','status'=>'Selesai','layanan_tambahan'=>['Kerokan','Totok Wajah','Aromatherapy'],'harga'=>240000,'durasi'=>'75 Menit','total_layanan'=>270000,'metode'=>'Transfer','terapis'=>[]
            ],

        ])->map(function ($item, $index) {
            $item['id'] = $index + 1;
            return $item;
        })->toArray();

        $this->cash = collect([
           [
                'nama'=>'Reggy Firmansyah','gender'=>'male','ponsel'=>'081111222333','layanan'=>'Body Treatment','jadwal'=>'07-19-25','tanggal_pemesanan'=>'07-17-25','alamat'=>'Jl. Kenanga No.12, Jakarta','status'=>'Selesai','layanan_tambahan'=>['Totok Wajah','Refleksi','Kerokan'],'harga'=>170000,'durasi'=>'70 Menit','total_layanan'=>110000,'metode'=>'Cash','terapis'=>[]],
                ['nama'=>'Alfa Nisa','gender'=>'female','ponsel'=>'081122334455','layanan'=>'Facial Glow Up','jadwal'=>'07-20-25','tanggal_pemesanan'=>'07-18-25','alamat'=>'Jl. Melati No.7, Bandung','status'=>'Dijadwalkan','layanan_tambahan'=>['Masker Wajah','Totok Wajah','Hair Spa'],'harga'=>150000,'durasi'=>'45 Menit','total_layanan'=>170000,'metode'=>'Cash','terapis'=>[]],
                ['nama'=>'Hana Azmi','gender'=>'female','ponsel'=>'082233445566','layanan'=>'Reflexology','jadwal'=>'07-21-25','tanggal_pemesanan'=>'07-19-25','alamat'=>'Jl. Anggrek No.21, Surabaya','status'=>'Selesai','layanan_tambahan'=>['Refleksi','Totok Wajah','Back Massage'],'harga'=>130000,'durasi'=>'40 Menit','total_layanan'=>130000,'metode'=>'Cash','terapis'=>[]],
                ['nama'=>'Bayu Saputra','gender'=>'male','ponsel'=>'083344556677','layanan'=>'Hair Spa','jadwal'=>'07-22-25','tanggal_pemesanan'=>'07-20-25','alamat'=>'Jl. Mawar No.5, Yogyakarta','status'=>'Dibatalkan','layanan_tambahan'=>['Hair Treatment','Facial Glow Up','Refleksi'],'harga'=>160000,'durasi'=>'50 Menit','total_layanan'=>160000,'metode'=>'Cash','terapis'=>[]],
                ['nama'=>'Putri Aulia','gender'=>'female','ponsel'=>'084455667788','layanan'=>'Aromatherapy Massage','jadwal'=>'07-22-25','tanggal_pemesanan'=>'07-19-25','alamat'=>'Jl. Flamboyan No.3, Semarang','status'=>'Dijadwalkan','layanan_tambahan'=>['Totok Wajah','Masker Wajah','Reflexology'],'harga'=>180000,'durasi'=>'60 Menit','total_layanan'=>210000,'metode'=>'Cash','terapis'=>[]],
                ['nama'=>'Rifqi Adnan','gender'=>'male','ponsel'=>'085566778899','layanan'=>'Full Body Massage','jadwal'=>'07-23-25','tanggal_pemesanan'=>'07-21-25','alamat'=>'Jl. Dahlia No.17, Depok','status'=>'Dibatalkan','layanan_tambahan'=>['Kerokan','Back Massage','Hair Spa'],'harga'=>200000,'durasi'=>'80 Menit','total_layanan'=>200000,'metode'=>'Cash','terapis'=>[]],
                ['nama'=>'Larasati','gender'=>'female','ponsel'=>'086677889900','layanan'=>'Back Massage','jadwal'=>'07-24-25','tanggal_pemesanan'=>'07-22-25','alamat'=>'Jl. Teratai No.6, Bekasi','status'=>'Selesai','layanan_tambahan'=>['Kerokan','Totok Wajah','Refleksi'],'harga'=>140000,'durasi'=>'50 Menit','total_layanan'=>170000,'metode'=>'Cash','terapis'=>[]],
                ['nama'=>'Dimas Prasetyo','gender'=>'male','ponsel'=>'087788990011','layanan'=>'Hair Treatment','jadwal'=>'07-25-25','tanggal_pemesanan'=>'07-23-25','alamat'=>'Jl. Kamboja No.9, Tangerang','status'=>'Dibatalkan','layanan_tambahan'=>['Refleksi','Hair Spa','Totok Wajah'],'harga'=>150000,'durasi'=>'60 Menit','total_layanan'=>150000,'metode'=>'Cash','terapis'=>[]],
                ['nama'=>'Intan Permata','gender'=>'female','ponsel'=>'088899001122','layanan'=>'Facial Glow Up','jadwal'=>'07-26-25','tanggal_pemesanan'=>'07-24-25','alamat'=>'Jl. Sawo No.8, Bogor','status'=>'Selesai','layanan_tambahan'=>['Masker Wajah','Back Massage','Reflexology'],'harga'=>160000,'durasi'=>'50 Menit','total_layanan'=>180000,'metode'=>'Cash','terapis'=>[]],
                ['nama'=>'Yoga Pratama','gender'=>'male','ponsel'=>'089900112233','layanan'=>'Reflexology','jadwal'=>'07-26-25','tanggal_pemesanan'=>'07-24-25','alamat'=>'Jl. Pisang No.15, Cirebon','status'=>'Dijadwalkan','layanan_tambahan'=>['Refleksi','Totok Wajah','Hair Treatment'],'harga'=>130000,'durasi'=>'40 Menit','total_layanan'=>130000,'metode'=>'Cash','terapis'=>[]
            ],
        ])->map(function ($item, $index) {
            $item['id'] = $index + 1;
            return $item;
        })->toArray();
    }

    public function index()
    {
        $terapisList = [
            ['nama_terapis' => 'Tono Winarto', 'gender' => 'male', 'ponsel_terapis' => '081111111111'],
            ['nama_terapis' => 'Bimo Wicaksono', 'gender' => 'male', 'ponsel_terapis' => '081111111112'],
            ['nama_terapis' => 'Andi Saputra', 'gender' => 'male', 'ponsel_terapis' => '081111111113'],
            ['nama_terapis' => 'Dimas Prasetyo', 'gender' => 'male', 'ponsel_terapis' => '081111111114'],
            ['nama_terapis' => 'Eko Wahyudi', 'gender' => 'male', 'ponsel_terapis' => '081111111115'],
            ['nama_terapis' => 'Arif Santoso', 'gender' => 'male', 'ponsel_terapis' => '081111111116'],
            ['nama_terapis' => 'Fajar Nugroho', 'gender' => 'male', 'ponsel_terapis' => '081111111117'],
            ['nama_terapis' => 'Bayu Purnama', 'gender' => 'male', 'ponsel_terapis' => '081111111118'],
            ['nama_terapis' => 'Dinda Ayu', 'gender' => 'female', 'ponsel_terapis' => '081111111119'],
            ['nama_terapis' => 'Melati Putri', 'gender' => 'female', 'ponsel_terapis' => '081111111120'],
            ['nama_terapis' => 'Sinta Maharani', 'gender' => 'female', 'ponsel_terapis' => '081111111121'],
            ['nama_terapis' => 'Dewi Anggraini', 'gender' => 'female', 'ponsel_terapis' => '081111111122'],
            ['nama_terapis' => 'Nadia Rachma', 'gender' => 'female', 'ponsel_terapis' => '081111111123'],
        ];

        return view('pages.SuperAdminPesanan', [
            'transfer' => $this->transfer,
            'cash' => $this->cash,
            'terapisList' => $terapisList,
        ]);
    }

    public function detail($tipe, $id)
    {
        $data = [];

        if ($tipe === 'transfer') {
            $data = $this->transfer;
        } elseif ($tipe === 'cash') {
            $data = $this->cash;
        } else {
            abort(404, 'Jenis pesanan tidak valid.');
        }

        if (!isset($data[$id])) {
            abort(404, 'Pesanan tidak ditemukan.');
        }

        $pesanan = $data[$id];

        $terapisList = [
            ['nama_terapis' => 'Tono Winarto', 'gender' => 'male', 'ponsel_terapis' => '081111111111'],
            ['nama_terapis' => 'Bimo Wicaksono', 'gender' => 'male', 'ponsel_terapis' => '081111111112'],
            ['nama_terapis' => 'Andi Saputra', 'gender' => 'male', 'ponsel_terapis' => '081111111113'],
            ['nama_terapis' => 'Dimas Prasetyo', 'gender' => 'male', 'ponsel_terapis' => '081111111114'],
            ['nama_terapis' => 'Eko Wahyudi', 'gender' => 'male', 'ponsel_terapis' => '081111111115'],
            ['nama_terapis' => 'Arif Santoso', 'gender' => 'male', 'ponsel_terapis' => '081111111116'],
            ['nama_terapis' => 'Fajar Nugroho', 'gender' => 'male', 'ponsel_terapis' => '081111111117'],
            ['nama_terapis' => 'Bayu Purnama', 'gender' => 'male', 'ponsel_terapis' => '081111111118'],
            ['nama_terapis' => 'Dinda Ayu', 'gender' => 'female', 'ponsel_terapis' => '081111111119'],
            ['nama_terapis' => 'Melati Putri', 'gender' => 'female', 'ponsel_terapis' => '081111111120'],
            ['nama_terapis' => 'Sinta Maharani', 'gender' => 'female', 'ponsel_terapis' => '081111111121'],
            ['nama_terapis' => 'Dewi Anggraini', 'gender' => 'female', 'ponsel_terapis' => '081111111122'],
            ['nama_terapis' => 'Nadia Rachma', 'gender' => 'female', 'ponsel_terapis' => '081111111123'],
        ];

        $pesanan['total_harga'] = $pesanan['total_layanan'];

        return view('pages.SuperAdminDetailPesanan', compact('pesanan', 'terapisList'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Pending,Dijadwalkan,Berlangsung,Selesai,Dibatalkan'
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }

}