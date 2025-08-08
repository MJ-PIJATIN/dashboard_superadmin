<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Karyawan;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Karyawan::truncate(); // Removed truncate to add more data

        $adminData = [];
        for ($i = 21; $i <= 31; $i++) { // Start from 21 to add 11 new entries
            $adminData[] = [
                'nama' => 'Admin Karyawan ' . $i,
                'tanggal_bergabung' => now()->subDays(rand(1, 365))->format('Y-m-d'),
                'ponsel' => '0812345678' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'jenis_kelamin' => ($i % 2 == 0) ? 'Laki-Laki' : 'Perempuan',
                'area_penempatan' => 'Jakarta',
                'role' => 'admin',
            ];
        }

        $financeData = [];
        for ($i = 21; $i <= 31; $i++) { // Start from 21 to add 11 new entries
            $financeData[] = [
                'nama' => 'Finance Karyawan ' . $i,
                'tanggal_bergabung' => now()->subDays(rand(1, 365))->format('Y-m-d'),
                'ponsel' => '0876543210' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'jenis_kelamin' => ($i % 2 == 0) ? 'Perempuan' : 'Laki-Laki',
                'area_penempatan' => 'Surabaya',
                'role' => 'finance',
            ];
        }

        foreach ($adminData as $data) {
            Karyawan::create($data);
        }

        foreach ($financeData as $data) {
            Karyawan::create($data);
        }
    }
}
