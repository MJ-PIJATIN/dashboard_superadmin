<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Faker\Factory as Faker;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $faker = Faker::create();
        $statuses = ['Dijadwalkan', 'Pending', 'Berlangsung', 'Menunggu', 'Selesai', 'Dibatalkan'];

        // Dummy data for transfer
        $transferData = [];
        for ($i = 0; $i < 20; $i++) {
            $booking = new \stdClass();
            $booking->id = $i + 1;
            $booking->customer = new \stdClass();
            $booking->customer->name = $faker->name;
            $booking->customer->gender = $faker->randomElement(['male', 'female']);
            $booking->mainService = new \stdClass();
            $booking->mainService->name = $faker->randomElement(['Pijat Full Body', 'Pijat Refleksi', 'Pijat Kepala']);
            $booking->bookings_date = $faker->dateTimeThisMonth();
            $booking->status = $faker->randomElement($statuses);
            $transferData[] = $booking;
        }

        // Dummy data for cash
        $cashData = [];
        for ($i = 0; $i < 25; $i++) {
            $booking = new \stdClass();
            $booking->id = $i + 21;
            $booking->customer = new \stdClass();
            $booking->customer->name = $faker->name;
            $booking->customer->gender = $faker->randomElement(['male', 'female']);
            $booking->mainService = new \stdClass();
            $booking->mainService->name = $faker->randomElement(['Pijat Full Body', 'Pijat Refleksi', 'Pijat Kepala']);
            $booking->bookings_date = $faker->dateTimeThisMonth();
            $booking->status = $faker->randomElement($statuses);
            $cashData[] = $booking;
        }

        $perPage = 10;
        $transferPage = $request->input('transfer_page', 1);
        $cashPage = $request->input('cash_page', 1);

        $transfer = new LengthAwarePaginator(
            array_slice($transferData, ($transferPage - 1) * $perPage, $perPage),
            count($transferData),
            $perPage,
            $transferPage,
            ['path' => $request->url(), 'pageName' => 'transfer_page']
        );

        $cash = new LengthAwarePaginator(
            array_slice($cashData, ($cashPage - 1) * $perPage, $perPage),
            count($cashData),
            $perPage,
            $cashPage,
            ['path' => $request->url(), 'pageName' => 'cash_page']
        );

        return view('pages.SuperAdminPesanan', compact('transfer', 'cash'));
    }

    public function detail($tipe, $id)
    {
        $faker = Faker::create('id_ID');
        $statuses = ['Dijadwalkan', 'Pending', 'Berlangsung', 'Menunggu', 'Selesai', 'Dibatalkan'];

        // Regenerate dummy data to find the booking
        $allData = [];
        for ($i = 0; $i < 25; $i++) {
            $harga = $faker->numberBetween(100000, 200000);
            $total_layanan = $harga + 25000;
            $total_harga = $total_layanan;
            $booking = [
                'id' => $i + 1,
                'layanan' => $faker->randomElement(['Pijat Full Body', 'Pijat Refleksi', 'Pijat Kepala']),
                'nama' => $faker->name,
                'harga' => $harga,
                'jadwal' => $faker->dateTimeThisMonth()->format('d M Y, H:i'),
                'tanggal_pemesanan' => $faker->dateTimeThisMonth()->format('d M Y'),
                'alamat' => $faker->address,
                'gender' => $faker->randomElement(['male', 'female']),
                'ponsel' => $faker->phoneNumber,
                'layanan_tambahan' => $faker->randomElements(['Kerokan', 'Scrub', 'Masker Wajah'], $faker->numberBetween(0, 3)),
                'durasi' => $faker->randomElement(['60 Menit', '90 Menit', '120 Menit']),
                'total_layanan' => $total_layanan,
                'metode' => $faker->randomElement(['cash', 'transfer']),
                'total_harga' => $total_harga,
                'status' => $faker->randomElement($statuses),
            ];
            $allData[] = $booking;
        }

        $pesanan = null;
        foreach ($allData as $data) {
            if ($data['id'] == $id) {
                $pesanan = $data;
                break;
            }
        }

        if (!$pesanan) {
            abort(404);
        }

        // Dummy terapis list
        $terapisList = [];
        for ($i=0; $i < 5; $i++) { 
            $terapisList[] = [
                'nama_terapis' => $faker->name,
                'ponsel_terapis' => $faker->phoneNumber,
                'gender' => $faker->randomElement(['male', 'female'])
            ];
        }

        return view('pages.SuperAdminDetailPesanan', compact('pesanan', 'terapisList'));
    }
}
