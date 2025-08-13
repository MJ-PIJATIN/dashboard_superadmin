@extends('layouts.karyawan')

@section('navtitle')    
<div class="text-medium text-gray-600 mb-4">
    <a href="{{ route('karyawan') }}" class="text-gray-800 hover:underline">Karyawan</a>
    <span class="mx-2">></span>
    <a href="#" class="text-emerald-600 hover:underline">Detail Akun {{ ucfirst($karyawan->role) }}</a>
</div> 
@endsection

@section('content')
<div class="px-6 py-20">
    <!-- Back -->
    <div class="text-s text-gray-400 mb-4">
        <a href="{{ route('karyawan', ['role' => $karyawan->role]) }}" title="Kembali ke Data Karyawan" class="hover:text-gray-800">
            <span class="text-2x2 font-semibold mr-4">&larr;</span>
            <span class="text-s font-semibold text-gray-600">Detail Akun {{ ucfirst($karyawan->role) }}</span>
        </a>
    </div>

    <!-- Kontainer 2 Kartu Horizontal -->
    <div class="flex flex-wrap justify-between">
        <!-- Kartu Kiri -->
        <div class="bg-white rounded-[10px] shadow p-8 w-[530px]">
            <div class="flex flex-col items-center text-center mb-10 h-60">
                <img src="{{ $karyawan->foto ? asset('storage/'.$karyawan->foto) : 'https://via.placeholder.com/150' }}" 
                    alt="Foto Profil"
                    class="w-40 h-40 rounded-full object-cover shadow mb-2">
                <h2 class="text-sm font-semibold text-gray-800">{{ $karyawan->nama_depan }} {{ $karyawan->nama_belakang }}</h2>
                <p class="text-xs text-gray-500">{{ ucfirst($karyawan->role) }}</p>
            </div>

            <h3 class="text-normal font-bold text-gray-800 mb-5">Informasi Akun</h3>
            <div class="space-y-2 text-xs text-gray-700">
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Nomor ID</span>
                    <span class="font-semibold text-gray-800">{{ strtoupper(substr($karyawan->role, 0, 3)) }}{{ $karyawan->id }}</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Peran Akun</span>
                    <span class="font-semibold text-gray-800">{{ ucfirst($karyawan->role) }}</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Email</span>
                    <span class="font-semibold text-gray-800">{{ $karyawan->email }}</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Ponsel</span>
                    <span class="font-semibold text-gray-800">{{ $karyawan->ponsel }}</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Area Penempatan</span>
                    <span class="font-semibold text-gray-800">{{ $karyawan->kota }}, {{ $karyawan->provinsi }}</span>
                </div>
            </div>

            <div class="mt-4 text-end">
                <button 
                    type="button" 
                    onclick="openDeleteDrawer('{{ $karyawan->id }}', '{{ $karyawan->nama_depan }} {{ $karyawan->nama_belakang }}')" 
                    class="text-red-600 border border-red-500 hover:bg-red-50 font-semibold px-3 py-1.5 rounded text-xs">
                    Hapus Akun
                </button>
            </div>
        </div>

        <!-- Kartu Kanan -->
        <div class="bg-white rounded-[10px] shadow p-4 w-[530px] h-60">
            <h3 class="text-normal font-bold text-gray-800 mb-10">Identitas Diri</h3>
            <div class="space-y-2 text-xs text-gray-700">
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Nama Lengkap</span>
                    <span class="font-semibold text-gray-800">{{ $karyawan->nama_depan }} {{ $karyawan->nama_belakang }}</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Tempat Lahir</span>
                    <span class="font-semibold text-gray-800">{{ $karyawan->tempat_lahir ?? '-' }}</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Tanggal Lahir</span>
                    <span class="font-semibold text-gray-800">{{ $karyawan->tanggal_lahir ? \Carbon\Carbon::parse($karyawan->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Jenis Kelamin</span>
                    <span class="font-semibold text-gray-800">{{ $karyawan->jenis_kelamin }}</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-semibold text-gray-500">Alamat</span>
                    <span class="font-semibold text-gray-800">{{ $karyawan->alamat ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Drawer -->
<div id="delete-drawer" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white rounded-lg shadow-lg" style="width: 400px; padding: 24px; min-height: 280px;">
            <div class="flex flex-col items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Hapus Data</h2>
                <img src="{{ asset('images/trash can.svg') }}" alt="Hapus" class="h-20 w-20 mb-6" />
                <p class="text-gray-600 text-center text-base">
                    Apakah Anda yakin ingin menghapus akun <br>
                    <span id="delete-service-name" class="font-semibold text-red-600"></span>?
                </p>
            </div>
            <div class="flex justify-center gap-8 mt-8">
                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white px-6 py-2 rounded-lg hover:opacity-90 transition-colors"
                        style="background-color: #469D89;">
                        Hapus
                    </button>
                </form>
                <button onclick="closeDeleteDrawer()"
                    class="bg-red-500 text-white px-7 py-2 rounded-lg hover:bg-red-600 transition-colors">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openDeleteDrawer(id, name) {
        document.getElementById('delete-drawer').classList.remove('hidden');
        document.getElementById('delete-service-name').textContent = name;
        document.getElementById('delete-form').action = `/karyawan/${id}`;
    }
    function closeDeleteDrawer() {
        document.getElementById('delete-drawer').classList.add('hidden');
    }
</script>
@endsection
