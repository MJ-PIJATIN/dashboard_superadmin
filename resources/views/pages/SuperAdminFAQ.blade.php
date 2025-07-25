@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Halaman ini menampilkan daftar pertanyaan yang sering diajukan oleh pengguna.')
@section('navtitle', 'FAQ')

@section('content')
<div class="p-28 pl-50 bg-gray-100 min-h-screen ml-[-50px]">
    <div class="max-w-12xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Daftar Pertanyaan</h1>
            <button onclick="openModal('modalTambah')" 
                class="absolute right-14 text-white px-4 py-2 rounded transition flex items-center gap-2 bg-[#2196F3] hover:bg-[#1976D2]">
                <img src="{{ asset('images/plus.svg') }}" alt="Tambah" class="h-5 w-5">
                Tambah Pertanyaan Baru
            </button>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full table-auto text-sm text-gray-700">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium">Judul</th>
                        <th class="px-6 py-3 text-left font-medium">Deskripsi</th>
                        <th class="px-6 py-3 text-center font-medium"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([
                        ['judul' => 'Apa itu massage?', 'deskripsi' => 'Massage merupakan suatu teknik perawatan...'],
                        ['judul' => 'Bagaimana saya bisa menemukan terapis yang baik?', 'deskripsi' => 'cek kualifikasi dan sertifikasi, cari referensi/ ulasan'],
                        ['judul' => 'Berapa biaya rata-rata untuk layanan massage?', 'deskripsi' => 'Harga mulai dari 100 ribuan bisa mendapatkan...'],
                        ['judul' => 'Seberapa sering saya sebaiknya mendapatkan massage?', 'deskripsi' => '1 minggu 1 kali'],
                        ['judul' => 'Apakah ada risiko atau efek samping dari massage?', 'deskripsi' => 'Ada beberapa risiko seperti memar, nyeri otot...']
                    ] as $faq)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $faq['judul'] }}</td>
                        <td class="px-6 py-4">{{ $faq['deskripsi'] }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <button onclick="openModal('modalEdit')" title="Edit">
                                    <img src="{{ asset('images/edit.svg') }}" alt="Edit" class="h-5 w-5 hover:opacity-80">
                                </button>
                                <button onclick="openModal('modalHapus')" title="Hapus">
                                    <img src="{{ asset('images/delete.svg') }}" alt="Hapus" class="h-5 w-5 hover:opacity-80">
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah FAQ -->
<div id="modalTambah" class="fixed inset-0 hidden bg-black bg-opacity-30 flex items-center justify-center z-50">
  <div class="relative bg-white rounded-lg p-6 w-[600px] shadow-lg">
    
    <!-- Tombol X -->
    <button onclick="closeModal('modalTambah')" class="absolute top-4 right-4 text-gray-600 hover:text-black text-xl font-bold">
      <img src="{{ asset('images/X.svg') }}" alt="Close" class="w-5 h-5">
    </button>

    <h3 class="text-lg font-semibold mb-4">Tambah Pertanyaan</h3>

    <label class="block font-semibold text-sm mb-1">Judul</label>
    <input type="text" class="w-full border p-2 rounded mb-4" placeholder="Masukkan judul pertanyaan">

    <label class="block font-semibold text-sm mb-1">Deskripsi</label>
    <textarea class="w-full border p-2 rounded mb-4" rows="3" placeholder="Tulis deskripsi pertanyaan"></textarea>

    <!-- Tombol Simpan -->
    <div class="flex justify-end">
      <button class="bg-[#32C3C9] text-white px-4 py-2 rounded hover:bg-[#29b1b7] transition">
        Simpan
      </button>
    </div>
  </div>
</div>


<!-- Modal Edit FAQ -->
<div id="modalEdit" class="fixed inset-0 hidden bg-black bg-opacity-30 flex items-center justify-center z-50">
  <div class="relative bg-white rounded-lg p-6 w-[600px] shadow-lg">
    <!-- Tombol X -->
    <button onclick="closeModal('modalEdit')" class="absolute top-4 right-4 text-gray-600 hover:text-black text-xl font-bold">
      <img src="{{ asset('images/X.svg') }}" alt="Close" class="w-5 h-5">
    </button>

    <h1 class="text-lg font-semibold mb-4">Ubah Pertanyaan</h1>

    <label class="block font-semibold text-sm mb-1">Judul</label>
    <input type="text" class="w-full border p-2 rounded mb-4" value="Apa itu massage?">

    <label class="block font-semibold text-sm mb-1">Deskripsi</label>
    <textarea class="w-full border p-2 rounded mb-4" rows="3">Massage merupakan suatu teknik perawatan seluruh tubuh...</textarea>

    <!-- Tombol Ubah -->
    <div class="flex justify-end">
      <button class="bg-[#32C3C9] text-white px-4 py-2 rounded hover:bg-[#29b1b7] transition">
        Ubah
      </button>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="modalHapus" class="fixed inset-0 hidden bg-black bg-opacity-30 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg p-6 w-[500px] shadow-lg text-center">

    <!-- Judul -->
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Peringatan Sistem</h3>

    <!-- Ikon Peringatan -->
    <div class="flex justify-center mb-4">
      <img src="{{ asset('images/peringatan.svg') }}" alt="Close" class="w-15 h-15">
    </div>

    <!-- Teks konfirmasi -->
    <p class="text-gray-700 mb-6">Apakah anda yakin ingin menghapus pertanyaan tersebut?</p>

    <!-- Tombol aksi -->
    <div class="flex justify-center gap-10">
      <!-- Tombol Batal -->
    <button onclick="closeModal('modalHapus')" 
            class="flex items-center gap-x-2 px-8 py-1 rounded text-white bg-[#32C3C9] hover:bg-[#2aaeb3] transition">
    Batal
    </button> 

    <!-- Tombol Hapus -->
    <button class="flex items-center gap-x-2 px-8 py-1 rounded text-white bg-[#F44336] hover:bg-[#d32f2f] transition">
    Hapus
    </button>

    </div>

  </div>
</div>


<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>
@endsection