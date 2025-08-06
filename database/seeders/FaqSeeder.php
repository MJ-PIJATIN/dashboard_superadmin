<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::create([
            'judul' => 'Apa itu massage?',
            'deskripsi' => 'Massage merupakan suatu teknik perawatan tubuh yang menggunakan gerakan tangan, tekanan, dan manipulasi jaringan lunak untuk memberikan relaksasi, mengurangi stres, dan meningkatkan kesehatan secara keseluruhan.'
        ]);

        Faq::create([
            'judul' => 'Bagaimana saya bisa menemukan terapis yang baik?',
            'deskripsi' => 'Untuk menemukan terapis yang baik, pastikan untuk mengecek kualifikasi dan sertifikasi mereka, cari referensi atau ulasan dari pelanggan sebelumnya, tanyakan pengalaman mereka, dan pastikan mereka terdaftar secara resmi.'
        ]);

        Faq::create([
            'judul' => 'Berapa biaya rata-rata untuk layanan massage?',
            'deskripsi' => 'Harga layanan massage bervariasi tergantung jenis treatment, lokasi, dan kualitas tempat. Umumnya harga mulai dari 100 ribu rupiah untuk massage tradisional hingga 500 ribu rupiah untuk treatment premium di spa mewah.'
        ]);

        Faq::create([
            'judul' => 'Seberapa sering saya sebaiknya mendapatkan massage?',
            'deskripsi' => 'Frekuensi massage tergantung pada kebutuhan individu. Untuk relaksasi umum, 1 minggu sekali sudah cukup, namun untuk kondisi tertentu atau stress tinggi bisa 2-3 kali seminggu sesuai anjuran terapis.'
        ]);

        Faq::create([
            'judul' => 'Apakah ada risiko atau efek samping dari massage?',
            'deskripsi' => 'Meskipun umumnya aman, massage dapat menimbulkan beberapa risiko seperti memar ringan, nyeri otot sementara, atau reaksi alergi terhadap minyak. Hindari massage jika memiliki kondisi medis tertentu tanpa konsultasi dokter.'
        ]);
    }
}