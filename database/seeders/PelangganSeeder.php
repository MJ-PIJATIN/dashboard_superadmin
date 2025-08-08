<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelanggan;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data to ensure only 11 records remain
        Pelanggan::truncate();

        $data = [
            ['nama' => 'Santi', 'email' => 'santi@gmail.com', 'kota' => 'Jakarta Timur', 'status' => 'Belum aktif', 'gender' => '♀️'],
            ['nama' => 'Dandia Rianti', 'email' => 'dandia@gmail.com', 'kota' => 'Jakarta Pusat', 'status' => 'Belum aktif', 'gender' => '♀️'],
            ['nama' => 'Tono Winarto', 'email' => 'tono@gmail.com', 'kota' => 'Jakarta Barat', 'status' => 'Belum aktif', 'gender' => '♂️'],
            ['nama' => 'Salimin Ajaya', 'email' => 'salimin1@gmail.com', 'kota' => 'Kendal', 'status' => 'Aktif', 'gender' => '♂️'],
            ['nama' => 'Willy Kusuma', 'email' => 'willykus@gmail.com', 'kota' => 'Bandung', 'status' => 'Aktif', 'gender' => '♂️'],
            ['nama' => 'Salsabila Riana', 'email' => 'salsabil@gmail.com', 'kota' => 'Bogor', 'status' => 'Aktif', 'gender' => '♀️'],
            ['nama' => 'Erna Puspita', 'email' => 'erna28@gmail.com', 'kota' => 'Denpasar', 'status' => 'Aktif', 'gender' => '♀️'],
            ['nama' => 'Rendy Pangga Lali', 'email' => 'rendy8@gmail.com', 'kota' => 'Gunung Kidul', 'status' => 'Aktif', 'gender' => '♂️'],
            ['nama' => 'Tri Kusnawi', 'email' => 'tri@gmail.com', 'kota' => 'Sleman', 'status' => 'Aktif', 'gender' => '♂️'],
            ['nama' => 'Willy Kusuma', 'email' => 'willykus@gmail.com', 'kota' => 'Malang', 'status' => 'Aktif', 'gender' => '♂️'],
            ['nama' => 'Gohan', 'email' => 'gohan@gmail.com', 'kota' => 'Earth', 'status' => 'Aktif', 'gender' => '♂️'],
        ];

        foreach ($data as $item) {
            Pelanggan::create($item);
        }
    }
}
