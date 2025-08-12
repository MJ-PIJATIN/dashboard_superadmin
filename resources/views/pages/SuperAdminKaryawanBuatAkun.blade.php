@extends('layouts.karyawan')
@section('navtitle')   
    <div class="text-medium text-gray-600 mb-4">
        <a href="#" class="text-gray-800 hover:underline">Karyawan</a>
        <span class="mx-2">></span>
        <a href="#" class="text-emerald-600 hover:underline">Buat Akun</a>
    </div> 
@endsection

@section('content')
<div class="px-6 py-20">
    <!-- Back -->
    <div class="text-sm text-gray-600 mb-4">
        <a href="{{ route('karyawan') }}" title="Kembali ke Data Karyawan" class="hover:text-gray-800">
            <span class="text-2xl font-bold text-[#2A9D8F] mr-2">&larr;</span>
            <span class="text-sm font-medium text-gray-800">Karyawan</span>
        </a>
    </div>

    <!-- Page Title -->
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Buat Akun Karyawan</h2>

    <!-- Form Card -->
    <div class="bg-white p-10 rounded-2xl shadow-md">
        <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-3 gap-6">
                <!-- Kolom 1 -->
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-semibold">Nama Depan*</label>
                        <input type="text" name="nama_depan" class="w-full border border-gray-300 rounded-lg px-2 py-2 mt-1 text-sm" placeholder="Masukkan nama depan">
                    </div>
                    <div>
                        <label class="text-sm font-semibold">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 text-sm" placeholder="Masukkan tempat lahir">
                    </div>
                    <div>
                        <label class="text-sm font-semibold">Jenis Kelamin*</label>
                        <div class="flex items-center space-x-6 mt-1">
                            <label class="inline-flex items-center">
                                <input type="radio" name="jenis_kelamin" value="Laki-Laki" class="form-radio text-[#2A9D8F]">
                                <span class="ml-2 text-sm">Laki-Laki</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="jenis_kelamin" value="Perempuan" class="form-radio text-[#2A9D8F]">
                                <span class="ml-2 text-sm">Perempuan</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-semibold">Email</label>
                        <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 text-sm" placeholder="Masukkan alamat email">
                    </div>

                    <div>
                        <p class="text-base font-semibold mt-2">Area Penempatan</p>
                        <div class="mt-2">
                            <label class="text-sm font-semibold">Provinsi*</label>
                            <select name="provinsi" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 text-sm">
                                        <option value="Aceh">Aceh</option>
                                        <option value="Sumatera Utara">Sumatera Utara</option>
                                        <option value="Sumatera Barat">Sumatera Barat</option>
                                        <option value="Riau">Riau</option>
                                        <option value="Kepulauan Riau">Kepulauan Riau</option>
                                        <option value="Jambi">Jambi</option>
                                        <option value="Bengkulu">Bengkulu</option>
                                        <option value="Sumatera Selatan">Sumatera Selatan</option>
                                        <option value="Kepulauan Bangka Belitung">Kepulauan Bangka Belitung</option>
                                        <option value="Lampung">Lampung</option>
                                        <option value="DKI Jakarta">DKI Jakarta</option>
                                        <option value="Jawa Barat">Jawa Barat</option>
                                        <option value="Banten">Banten</option>
                                        <option value="Jawa Tengah">Jawa Tengah</option>
                                        <option value="DI Yogyakarta">DI Yogyakarta</option>
                                        <option value="Jawa Timur">Jawa Timur</option>
                                        <option value="Bali">Bali</option>
                                        <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                        <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                                        <option value="Kalimantan Barat">Kalimantan Barat</option>
                                        <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                                        <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                                        <option value="Kalimantan Timur">Kalimantan Timur</option>
                                        <option value="Kalimantan Utara">Kalimantan Utara</option>
                                        <option value="Sulawesi Utara">Sulawesi Utara</option>
                                        <option value="Gorontalo">Gorontalo</option>
                                        <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                                        <option value="Sulawesi Barat">Sulawesi Barat</option>
                                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                        <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                                        <option value="Maluku">Maluku</option>
                                        <option value="Maluku Utara">Maluku Utara</option>
                                        <option value="Papua">Papua</option>
                                        <option value="Papua Barat">Papua Barat</option>
                                        <option value="Papua Tengah">Papua Tengah</option>
                                        <option value="Papua Pegunungan">Papua Pegunungan</option>
                                        <option value="Papua Selatan">Papua Selatan</option>
                                        <option value="Papua Barat Daya">Papua Barat Daya</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label class="text-sm font-semibold">Kota/Kabupaten*</label>
                            <select name="kota" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 text-sm">
                                <option>Pilih Kota/Kabupaten</option>
                            </select>
                        </div>
                    </div>
                </div>

<script>
    const kotaOptions = {
    'Aceh' : [
        'Banda Aceh',
        'Lhokseumawe',
        'Langsa',
        'Sabang',
        'Subulussalam',
        'Meulaboh',
        'Sigli',
        'Takengon',
        'Aceh Barat',
        'Aceh Barat Daya',
        'Aceh Jaya',
        'Aceh Selatan',
        'Aceh Singkil',
        'Aceh Tamiang',
        'Aceh Tengah',
        'Aceh Tenggara',
        'Aceh Timur',
        'Aceh Utara',
        'Bener Meriah',
        'Gayo Lues',
        'Pidie',
        'Pidie Jaya',
        'Nagan Raya',
        'Simuelue',
        'Kab Subulussalam'
    ],
    'Sumatera Utara' : [
        'Medan',
        'Sibolga',
        'Tanjung Balai',
        'Pematang Siantar',
        'Tebing Tinggi',
        'Binjai',
        'Padangsidimpuan',
        'Gunungsitoli',
        'Nias',
        'Mandailing Natal',
        'Tapanuli Selatan',
        'Tapanuli Tengah',
        'Tapanuli Utara',
        'Toba Samosir',
        'Labuh Batu ',
        'Asahan', //stop
        'Simalungun',
        'Dairi',
        'Karo',
        'Deli Serdang',
        'Langkat',
        'Nias Selatan',
        'Humbang Hasundutan',
        'Pakpak Bharat',
        'Samosir',
        'Serdang Berdagai',
        'Batu Bara',
        'Padang Lawas',
        'Padan Lawa Utara',
        'Labuhan Batu Selatan',
        'Labuhan Batu Utara',
        'Nias Utara',
        'Nias Barat',
    ],
    'Sumatera Barat' : [
        'Padang',
        'Bukittinggi',
        'Payakumbuh',
        'Solok',
        'Sawahlunto',
        'Pariaman',
        'Padang Panjang',
        'Kepulauan Mentawai',
        'Pesisir Selatan',
        'Solok',
        'Sijunjung',
        'Tanah Datar',
        'Padang Pariaman',
        'Agam',
        'Lima Puluh Kota',
        'Pasaman',
        'Solok Selatan',
        'Dharmasraya',
        'Pasaman Barat',
    ],
    'Riau' : [
        'Kuantan Singingi',
        'Indragiri Hulu',
        'Indragiri Hilir',
        'Pelalawan',
        'Siak',
        'Kampar',
        'Rokan Hulu',
        'Rokan Hilir',
        'Bengkalis',
        'Kepulauan Meranti',
        'Pekanbaru',
        'Dumai',
    ],
    'Kepualauan Riau' : [
        'Karimun',
        'Bintan',
        'Natuna',
        'Lingga',
        'Kepulauan Anambas',
        'Batam',
        'Tnajungpinang',
    ],
    'Jambi' : [
        'Kerinci',
        'Merangin',
        'Sorolangun',
        'Batanghari',
        'Muaro Jambi',
        'Tanjung Jabung Timur',
        'Tanjung Jabung Barat',
        'Tebo',
        'Bungo',
        'Jambi',
        'SUngai Penuh',
    ],
    'Bengkulu' : [
        'Bengkulu Selatan',
        'Bengkulu Utara',
        'Rejang Lebong',
        'Kaur',
        'Seluma',
        'Mukomuko',
        'Lebong',
        'Kepahiang',
        'Bengkulu Tengah',
        'Bengkulu',
    ],
    'Sumatra Selatan' : [
        'Lubuklinggau',
        'Pagar Alam',
        'Palembang',
        'Prabumulih',
        'Banguasin',
        'Empat Lawang',
        'Lahat',
        'Muara Enim',
        'Musi Banyuasin',
        'Musi Rawas',
        'Musi Rawas Utara',
        'Ogan Ilir',
        'Ogan Komering Ilir',
        'Ogan Komelir Ulu',
        'Ogan Komering Ulu Selatan',
        'Ogan Komering Ulu Timur',
        'Penukal Abab Lematang Ilir',
    ],
    'Kepulauan Bangka Belitung' : [
        'Pangkalpinang',
        'Bangka',
        'Bangka Barat',
        'Bangka Tengah',
        'Bangka Selatan',
        'Belitung',
        'Belitung Timur',
    ],
    'Lampung' : [
        'Kota Metro',
        'Bandar Lampung',
        'Lampung Barat',
        'Lampung Selatan',
        'Lampung Tengah',
        'Lampung Timur',
        'Lampung Utara',
        'Mesuji',
        'Pesawaran',
        'Pesisir Barat',
        'Pringsewu',
        'Tanggamus',
        'Tulang Bawang',
        'Tulang Bawang Barat',
        'Way Kanan',
    ],
    'DKI Jakarta' : [
        'Jakarta Pusat',
        'Jakarta Utara',
        'Jakarta Barat',
        'Jakarta Timur',
        'Jakarta Selatan',
        'Kepualauan Seribu',
    ],
    'Jawa Barat' : [
        'Kota Bandung',
        'Kota Bekasi',
        'Depok',
        'Kota Bogor',
        'Cimahi',
        'Cirebon',
        'Kota Tasikmalaya',
        'Kota Sukabumi',
        'Banjar',
        'Kab Bandung',
        'Bandung Barat',
        'Kab Bekasi',
        'Kab Bogor',
        'Ciamis',
        'Cianjur',
        'Cirebon',
        'Garut',
        'Indramayu',
        'Karawang',
        'Kuningan',
        'Majalengka',
        'Purwakarta',
        'Subang',
        'Kab Sukabumi',
        'Sumedang',
        'Kab Tasikmalaya',
        'Pangandaran',
    ],
    'Banten' : [
        'Kota Serang',
        'Cilegon',
        'Tangerang',
        'Tangerang Selatan',
        'Kab Serang',
        'Lebak',
        'Pandeglang',
        'Kab Tangerang',
    ],
    'Jawa Tengah' : [
        'Semarang',
        'Surakarta',
        'Magelang',
        'Tegal',
        'Pekalongan',
        'Salatiga',
        'Banyumas',
        'Banjarnegara',
        'Cilacap',
        'Demak',
        'Grobongan',
        'Jepara',
        'Karanganyar',
        'Kebumen',
        'Klaten',
        'Kudus',
        'Magelang',
        'Pati',
        'Kab Pekalongan',
        'Pemalang',
        'Purbalingga',
        'Purworejo',
        'Rembang',
        'Kab Semarang',
        'Sragen',
        'Sukoharjo',
        'Temanggung',
        'Wonogiri',
        'WOnosobo',
        'Brebes',
        'Kab Tegal',
        'Blora',
        'Boyoolali',
        'Kendal',
        'Batang',
    ],
    'DI Yogyakarta' : [
        'Yogyakarta',
        'Sleman',
        'Gunung Kidul',
        'Kulon Progo',
        'Bantul',
    ],
    'Jawa Timur' : [
        'Surabaya',
        'Malang',
        'Kediri',
        'Blitar',
        'Madiun',
        'Mojokerto',
        'Pasuruan',
        'Probolinggo',
        'Batu',
    ],
    'Bali' : [
        'Denpasar',
        'Jembrana',
        'Tabanan',
        'Badung',
        'Gianyar',
        'Klungkung',
        'Bangli',
        'Karangasem',
        'Buleleng',
    ],
    'Nusa Tenggara Barat' : [
        'Kota Bima',
        'Mataram',
        'Kab Bima',
        'Lombok Barat',
        'Lombok Tengah',
        'Lombok Timur',
        'Lombok Utara',
        'Dompu',
        'Sumbawa',
        'Sumbawa Barat'
    ],
    'Nusa Tenggara Timur' : [
        'Kupang',
        'Alor',
        'Belu',
        'Ende',
        'Flores Timur',
        'Kupang',
        'Lembata',
        'Malaka',
        'MEnggarai',
        'Menggarai Barat',
        'Menggarai Timur',
        'Nagekeo',
        'Ngada',
        'Rote Ndao',
        'Sabu Raijua',
        'Sikka',
        'Sumba Barat',
        'Sumba Barat Daya',
        'Sumba Tengah',
        'SUmba Timur',
        'Timor Tengah Selatan',
        'Timur Tengah Utara',
    ],
    'Kalimantan Tengah' : [
        'Palangkaraya',
        'Barito Selatan',
        'Bario Utara',
        'Gunung Mas',
        'Kapuas',
        'Katingan',
        'Kotawaringin Barat',
        'Kotawaringin Timur',
        'Lamandau',
        'Murung Raya',
        'Pulang Pisau',
        'Seruyan',
        'Sukamara',
    ],
    'Kalimantan Barat' : [
        'Pontianak',
        'Singkawang',
        'Sambas',
        'Bengkayang',
        'Landak',
        'Mempawah',
        'Sanggau',
        'Ketapang',
        'Sintang',
        'Kapuas Hulu',
        'Sekadau',
        'Melawi',
        'Kubu Raya',
        'Kayong Utara',
    ],
    'Kalimantar Selatan' : [
        'Banjarbaru',
        'Banjarmasin',
        'Banjar',
        'Barito Kuala',
        'Tapin',
        'Hulu Sungai Selatan',
        'Hulu Sungai Utara',
        'Tabalong',
        'Tanah Bumbu',
        'Balangan',
    ],
    'Kalimantan Timur' : [
        'Samarinda',
        'Balikpapan',
        'Bontang',
        'Tarakan',
        'Kutai Barat',
        'Kutai Kartanegara',
        'Kutai Timur',
        'Paser',
        'Berau',
        'Penajam Paser Utara',
        'Mahakam Ulu',
        'Pasir',
    ],
    'Kalimantan Utara' : [
        'Tarakan',
        'Bulungan',
        'Malinau',
        'Nunukan',
        'Tana Tidung',
    ],
    'Sulawesi Utara' : [
        'Manado',
        'Bitung',
        'Tomohon',
        'Kotamobagu',
        'Bolaang Mongondow',
        'Minahasa',
        'Kepulauan Sangihe',
        'Kepulauan Talaud',
        'Minahasa Selatan',
        'Minahasa Utara',
        'Bolaang Mongondow Utara',
        'Siau Tagulandang Biaro',
        'Minahasa Tenggara',
        'Bolaang Mongondow Selatan',
        'Bolaang Mongondow Timur',
    ],
    'Gorontalo' : [
        'Kota Gorontalo',
        'Kab Gorontalo',
        'Puhowato',
        'Bone Bolango',
        'Gorontalo Utara',
        'Boalemo',
        'Pahuwato',
    ],
    'Sulawesi Tengah' : [
        'Palu',
        'Banggai',
        'Banggai Kepulauan',
        'Banggai Laut',
        'Buol',
        'Donggala',
        'Morowali',
        'Morowali Utara',
        'Parigi Moutong',
        'Poso',
        'Sigi',
        'Tojo Una-Una',
        'Tolitoli',
    ],
    'Sulawesi Barat' : [
        'Majene',
        'Polewali Mandar',
        'Mamasa',
        'Mamuju',
        'Pasangkayu',
        'Mamuju Tengah',
    ],
    'Sulawesi Selatan' : [
        'Makassar',
        'Palopo',
        'Parepare',
        'Bantaeng',
        'Barru',
        'Bone',
        'Bulukumba',
        'Enrekang',
        'Gowa',
        'Jeneponto',
        'Kepulauan Selayar',
        'Luwu',
        'Luwu Timur',
        'Luwu Utara',
        'Maros',
        'Pangkajene dan Kepulauan',
        'Pinrang',
        'Sidenreng Rappang',
        'Sinjai',
        'Soppeng',
        'Takalar',
        'Tana Toraja',
        'Toraja Utara',
        'Wajo',
    ],
    'Sulawesi Tenggara' : [
        'Kendari',
        'Baubau',
        'Bombana',
        'Buton',
        'Buton Selatan',
        'Buotn Tengah',
        'Buton Utara',
        'Konawe',
        'Konawe Kepulauan',
        'Konawe Selatan',
        'Konawe Utara',
        'Kolaka',
        'Kolaka Timur',
        'Kolaka Utara',
        'Muna',
        'Muna Barat',
        'Wakatobi',
    ],
    'Maluku' : [
        'Ambon',
        'Tual',
        'Kepualauan Tanimbar',
        'Maluku Tenggara',
        'Maluku Tnegah',
        'Buru',
        'Kepulauan Aru',
        'Seram Bagian Barat',
        'Seram Bagian Timur',
        'Maluku Barat Daya',
        'Buru Selatan',
    ],
    'Maluku Utara' : [
        'Ternate',
        'Tidore Kepulauan',
        'Hlamahera Brata',
        'Halmahera Tengah',
        'Halmahera Selatan',
        'Halmahera Timur',
        'Halmahera Utara',
        'Pulau Morotai',
        'Pulau Taliabu',
        'Kepulauan Sula',
    ],
    'Papua' : [
        'Kota Jayapura',
        'Kab Jayapura',
        'Kepulauan Yapen',
        'Biak Numfor',
        'Sarmi',
        'Merauke',
        'Boven Digoel',
        'Mappi',
        'Asmat',
    ],
    'Papua Barat' : [
        'Fakfak',
        'Kaimana',
        'Manokwari',
        'Manokwari Selatan',
        'Pegunungan Arfak',
        'Teluk Bintuni',
        'Teluk Wondama',
    ],
    'Papua Tengah' : [
        'Naire',
        'Puncak Jaya',
        'Paniai',
        'Mimika',
        'Puncak',
        'Dogiyai',
        'Intan Jaya',
        'Deiyai',
    ],
    'Papua Pegunungan' : [
        'Jayawijaya',
        'Lanny Jaya',
        'Mamberamo Tengah',
        'Nduga',
        'Pegunungan Bintang',
        'Tolikara',
        'Yahukimo',
        'Yalimo',
    ],
    'Papua Selatan' : [
        'Merauke',
        'Boven Diogel',
        'Mappi',
        'Asmat',
    ],
    'Papua Barat Daya' : [
        'Kota Sorong',
        'Kab Sorong',
        'Sorong Selatan',
        'Maybrat',
        'Tambrauw',
        'Raja Ampat',
    ], 
    };

    document.querySelector('select[name="provinsi"]').addEventListener('change', function() {
        const provinsi = this.value;
        const kotaSelect = document.querySelector('select[name="kota"]');
        kotaSelect.innerHTML = '<option>Pilih Kota/Kabupaten</option>';

        if (kotaOptions[provinsi]) {
            kotaOptions[provinsi].forEach(function(kota) {
                const option = document.createElement('option');
                option.value = kota;
                option.textContent = kota;
                kotaSelect.appendChild(option);
            });
        }
    });
</script>

                <!-- Kolom 2 -->
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-semibold">Nama Belakang*</label>
                        <input type="text" name="nama_belakang" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 text-sm" placeholder="Masukkan nama belakang">
                    </div>
                    <div>
                        <label class="text-sm font-semibold">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 text-sm">
                    </div>
                    <div>
                        <label class="text-sm font-semibold">Alamat</label>
                        <input type="text" name="alamat" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 text-sm" placeholder="Masukkan alamat lengkap">
                    </div>
                    <div>
                        <label class="text-sm font-semibold">No. Ponsel</label>
                        <input type="text" name="ponsel" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 text-sm" placeholder="Masukkan nomor ponsel">
                    </div>
                </div>

                <!-- Kolom 3 -->
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-semibold block mb-1">Upload Foto</label>
                        <div class="flex justify-center mb-3">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <input type="file" name="foto" class="border border-gray-300 rounded-lg px-1 py-2 text-sm w-full">
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Pilih Hak Akses Akun*</label>
                        <select name="role" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 text-sm">
                            <option>Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="finance">Finance</option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <p class="text-base font-semibold">Pembuatan Kata Sandi</p>
                        <div class="mt-2">
                            <label class="text-sm font-semibold">Kata Sandi*</label>
                            <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 text-sm" placeholder="Masukkan kata sandi">
                        </div>
                        <div class="mt-2">
                            <label class="text-sm font-semibold">Konfirmasi Kata Sandi*</label>
                            <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 text-sm" placeholder="Masukkan kata sandi">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="mt-4 bg-[#2A9D8F] text-white px-5 py-2 rounded-lg text-sm shadow hover:bg-[#1E7B6E]">
                            Buat Akun
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
