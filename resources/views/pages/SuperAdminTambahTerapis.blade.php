@extends('layouts.terapis')

@section('head')
    <!-- Add CSRF token meta tag for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('navtitle')
    <div class="text-base flex items-center gap-2" style="color: #374151;">
        <span>Terapis</span>
        <span class="text-grey-700 font-semibold">&gt;</span>
        <span class="font-semibold" style="color: #469D89;">Tambah Data Terapis</span>
    </div>
@endsection

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="bg-gray-100 ml-[25px] pt-[76px] pb-[100px] pr-[25px]">
        <div class="min-h-screen bg-gray-100 p-6">
            <!-- Header -->
            <div class="flex items-center mb-6">
                <a href="{{ route('terapis') }}" title="Kembali ke terapis" class="flex items-center text-gray-600 hover:text-gray-700 transition-colors mr-4">
                    <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                        <path d="M9.47915 16.9798C9.0833 16.98 8.70301 16.8257 8.41915 16.5498L1.41915 9.54983C0.834242 8.96419 0.834242 8.01546 1.41915 7.42983L8.41915 0.429828C8.79964 0.0511261 9.35326 -0.0958207 9.87147 0.0443407C10.3897 0.184502 10.7937 0.590478 10.9315 1.10934C11.0692 1.6282 10.9196 2.18113 10.5391 2.55983L6.1067 6.99976H17.519C18.3475 6.99976 19.019 7.67133 19.019 8.49976C19.019 9.32818 18.3475 9.99976 17.519 9.99976H6.11161L10.5391 14.4198C10.9676 14.8488 11.0957 15.4935 10.8637 16.0537C10.6318 16.6138 10.0854 16.9793 9.47915 16.9798Z" fill="#454545" />
                    </svg>
                </a>
                <h1 class="text-xl font-bold text-gray-700">Tambah Terapis</h1>
            </div>

            <!-- General Error Message Container (will be created by JavaScript) -->
            
            <!-- Form Content -->
            <div class="bg-white rounded-lg p-6 shadow-lg border border-gray-200">
                <form action="{{ route('terapis.store') }}" method="POST" enctype="multipart/form-data" id="terapisForm">
                    @csrf
                    
                    <div class="flex gap-8 relative">
                        <!-- Left Section -->
                        <div class="flex-1" style="max-width: 600px;">
                            <!-- Personal Information Fields -->
                            <div class="grid grid-cols-2 gap-x-8 gap-y-4">
                                <!-- Left Column -->
                                <div class="space-y-4">
                                    <!-- Nama Lengkap -->
                                    <div>
                                        <label for="nama_lengkap" class="block text-sm text-gray-700 mb-1">Nama Lengkap*</label>
                                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                                            class="w-full px-3 py-2 text-sm border border-gray-500 rounded focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500"
                                            placeholder="Masukkan nama lengkap" required>
                                    </div>

                                    <!-- Tempat Lahir -->
                                    <div>
                                        <label for="tempat_lahir" class="block text-sm text-gray-700 mb-1">Tempat Lahir*</label>
                                        <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                            class="w-full px-3 py-2 text-sm border border-gray-500 rounded focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500"
                                            placeholder="Masukkan tempat lahir" required>
                                    </div>

                                    <!-- Jenis Kelamin -->
                                    <div>
                                        <label class="block text-sm text-gray-700 mb-[21.5px]">Jenis Kelamin*</label>
                                        <div class="flex space-x-6">
                                            <label class="flex items-center">
                                                <input type="radio" name="jenis_kelamin" value="Laki-laki"
                                                    {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }}
                                                    class="w-4 h-4 text-teal-600 border-gray-500 focus:ring-teal-500" required>
                                                <span class="ml-2 text-sm text-gray-700">Laki-laki</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="radio" name="jenis_kelamin" value="Perempuan"
                                                    {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}
                                                    class="w-4 h-4 text-teal-600 border-gray-500 focus:ring-teal-500" required>
                                                <span class="ml-2 text-sm text-gray-700">Perempuan</span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label for="email" class="block text-sm text-gray-700 mb-1">Email*</label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                                            class="w-full px-3 py-2 text-sm border border-gray-500 rounded focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500"
                                            placeholder="Masukkan alamat email" required>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="space-y-4">
                                    <!-- NIK -->
                                    <div>
                                        <label for="nik" class="block text-sm text-gray-700 mb-1">NIK*</label>
                                        <input type="text" id="nik" name="nik" value="{{ old('nik') }}"
                                            class="w-full px-3 py-2 text-sm border border-gray-500 rounded focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500"
                                            placeholder="Masukkan NIK (16 digit)" maxlength="16" required>
                                    </div>

                                    <!-- Tanggal Lahir -->
                                    <div class="relative">
                                        <label for="tanggal_lahir" class="block text-sm text-gray-700 mb-1">Tanggal Lahir*</label>
                                        <div class="flex w-full rounded overflow-hidden border border-gray-500 focus-within:ring-1 focus-within:ring-teal-500 focus-within:border-teal-500">
                                            <div class="bg-teal-500 flex items-center justify-center px-3 cursor-pointer" onclick="TerapisForm.datePicker.toggle()">
                                                <img src="{{ asset('images/calendar.svg') }}" alt="calendar" class="w-[24px] h-[24px]">
                                            </div>
                                            <input type="text" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                                class="w-full px-3 py-2 text-sm text-gray-700 placeholder-gray-400 focus:outline-none"
                                                placeholder="dd/mm/yyyy" onkeydown="return false" required>
                                        </div>
                                        
                                        <!-- Custom Date Picker (same as before) -->
                                        <div id="custom-date-picker" class="absolute top-full left-0 mt-1 bg-white border border-gray-300 rounded-lg shadow-lg z-50 hidden w-64">
                                            <div class="p-3">
                                                <!-- Month/Year Header -->
                                                <div class="flex justify-between items-center mb-3">
                                                    <button type="button" class="p-1 hover:bg-gray-100 rounded" onclick="TerapisForm.datePicker.changeMonth(-1)">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                        </svg>
                                                    </button>
                                                    <div class="flex space-x-1">
                                                        <select id="month-select" class="text-xs border border-gray-300 rounded px-1 py-1 w-20">
                                                            <option value="0">Jan</option>
                                                            <option value="1">Feb</option>
                                                            <option value="2">Mar</option>
                                                            <option value="3">Apr</option>
                                                            <option value="4">Mei</option>
                                                            <option value="5">Jun</option>
                                                            <option value="6">Jul</option>
                                                            <option value="7">Agu</option>
                                                            <option value="8">Sep</option>
                                                            <option value="9">Okt</option>
                                                            <option value="10">Nov</option>
                                                            <option value="11">Des</option>
                                                        </select>
                                                        <select id="year-select" class="text-xs border border-gray-300 rounded px-1 py-1 w-16"></select>
                                                    </div>
                                                    <button type="button" class="p-1 hover:bg-gray-100 rounded" onclick="TerapisForm.datePicker.changeMonth(1)">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                
                                                <!-- Days Header -->
                                                <div class="grid grid-cols-7 gap-1 mb-1">
                                                    <div class="text-center text-xs font-medium text-gray-500 py-1">S</div>
                                                    <div class="text-center text-xs font-medium text-gray-500 py-1">S</div>
                                                    <div class="text-center text-xs font-medium text-gray-500 py-1">R</div>
                                                    <div class="text-center text-xs font-medium text-gray-500 py-1">K</div>
                                                    <div class="text-center text-xs font-medium text-gray-500 py-1">J</div>
                                                    <div class="text-center text-xs font-medium text-gray-500 py-1">S</div>
                                                    <div class="text-center text-xs font-medium text-gray-500 py-1">M</div>
                                                </div>
                                                
                                                <!-- Calendar Days -->
                                                <div id="calendar-days" class="grid grid-cols-7 gap-1"></div>
                                                
                                                <!-- Action Buttons -->
                                                <div class="flex justify-end space-x-2 mt-3 pt-2 border-t border-gray-200">
                                                    <button type="button" class="px-3 py-1 text-xs text-gray-600 hover:bg-gray-100 rounded" onclick="TerapisForm.datePicker.close()">
                                                        Batal
                                                    </button>
                                                    <button type="button" class="px-3 py-1 text-xs bg-teal-500 text-white rounded hover:bg-teal-600" onclick="TerapisForm.datePicker.apply()">
                                                        Terapkan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Alamat -->
                                    <div>
                                        <label for="alamat" class="block text-sm text-gray-700 mb-1">Alamat*</label>
                                        <input type="text" id="alamat" name="alamat" value="{{ old('alamat') }}"
                                            class="w-full px-3 py-2 text-sm border border-gray-500 rounded focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500"
                                            placeholder="Masukkan alamat lengkap" required>
                                    </div>

                                    <!-- No. Ponsel -->
                                    <div>
                                        <label for="no_ponsel" class="block text-sm text-gray-700 mb-1">No. Ponsel*</label>
                                        <input type="tel" id="no_ponsel" name="no_ponsel" value="{{ old('no_ponsel') }}"
                                            class="w-full px-3 py-2 text-sm border border-gray-500 rounded focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500"
                                            placeholder="Masukkan nomor ponsel" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Area Penempatan Section -->
                            <div class="mt-8">
                                <h3 class="text-md font-semibold text-gray-900 mb-4">Area Penempatan</h3>
                                <div class="grid grid-cols-2 gap-x-8">
                                    <!-- Provinsi -->
                                    <div>
                                        <label for="provinsi" class="block text-sm text-gray-700 mb-1">Provinsi*</label>
                                        <select id="provinsi" name="provinsi" 
                                            class="w-full px-3 py-2 text-sm border border-gray-500 rounded focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500 bg-white" required>
                                            <option value="">Pilih Provinsi</option>
                                            @php
                                            $provinces = [
                                                'Aceh', 'Sumatera Utara', 'Sumatera Barat', 'Riau', 'Kepulauan Riau', 'Jambi', 'Bengkulu', 'Sumatera Selatan', 'Lampung', 'Kepulauan Bangka Belitung',
                                                'Banten', 'Jawa Barat', 'DKI Jakarta', 'Jawa Tengah', 'DI Yogyakarta', 'Jawa Timur', 'Bali', 'Nusa Tenggara Barat', 'Nusa Tenggara Timur',
                                                'Kalimantan Barat', 'Kalimantan Tengah', 'Kalimantan Selatan', 'Kalimantan Timur', 'Kalimantan Utara', 'Sulawesi Utara', 'Sulawesi Tengah',
                                                'Sulawesi Selatan', 'Sulawesi Tenggara', 'Gorontalo', 'Sulawesi Barat', 'Maluku', 'Maluku Utara', 'Papua', 'Papua Barat', 'Papua Selatan',
                                                'Papua Tengah', 'Papua Pegunungan', 'Papua Barat Daya'
                                            ];
                                            @endphp
                                            @foreach($provinces as $province)
                                                <option value="{{ $province }}" {{ old('provinsi') == $province ? 'selected' : '' }}>{{ $province }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <!-- Kota/Kabupaten -->
                                    <div>
                                        <label for="kota_kabupaten" class="block text-sm text-gray-700 mb-1">Kota/Kabupaten*</label>
                                        <select id="kota_kabupaten" name="kota_kabupaten"
                                            class="w-full px-3 py-2 text-sm border border-gray-500 rounded focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500 bg-white" required>
                                            <option value="">Pilih Kota/Kabupaten</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Vertical Divider -->
                        <div class="border-l-2 border-gray-200 min-h-full"></div>

                        <!-- Right Section - Upload Photo -->
                        <div class="flex flex-col">
                            <h3 class="text-md font-semibold text-gray-900 mb-4">Upload Foto</h3>
                            
                            <div class="flex flex-row space-x-6 items-center">
                                <!-- File Input Section -->
                                <div class="flex items-center space-x-3 border border-gray-500 rounded">
                                    <span class="text-xs text-gray-400 flex-1 ml-2" id="file-name">File belum dipilih</span>
                                    <div>
                                        <input type="file" id="foto" name="foto" accept="image/*" class="hidden">
                                        <button type="button" onclick="TerapisForm.fileUpload.selectFile()"
                                            class="px-4 py-2 bg-teal-500 text-white text-sm font-medium rounded hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-colors">
                                            Pilih file
                                        </button>
                                    </div>
                                </div>

                                <!-- Photo Preview -->
                                <div class="flex justify-center">
                                    <div class="w-24 h-24 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden">
                                        <div id="photo-preview" class="w-full h-full flex items-center justify-center">
                                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-64 ml-[300px]">
                                <button type="submit" id="submit-btn"
                                    class="px-8 py-2.5 bg-teal-500 text-white text-sm font-medium rounded hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200">
                                    Tambah Data
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Loading Spinner Drawer -->
<div id="loading-drawer" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white rounded-lg shadow-lg" style="width: 400px; padding: 70.5px;">
            <div class="flex flex-col items-center mb-4">
                <img src="{{ asset('images/loading.svg') }}" alt="Loading" class="h-30 w-30 animate-spin" />
            </div>
        </div>
    </div>
</div>

    <!-- Success Drawer -->
<div id="success-drawer" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center h-full">
            <div class="bg-white rounded-lg shadow-lg" style="width: 400px; padding: 24px; min-height: 280px;">
                <div class="flex flex-col items-center mb-4">
                    <h2 class="text-2xl font-bold mb-6" style="color: #469D89;">Berhasil!</h2>
                    <img src="{{ asset('images/succed.svg') }}" alt="Success" class="h-30 w-30">
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
// Drawer utility functions
let successTimeout = null;
function showModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
}

function hideModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
}

function showSuccess() {
    hideModal('loading-drawer'); // Hide loading first
    showModal('success-drawer');
    successTimeout = setTimeout(() => {
        hideModal('success-drawer');
        // Redirect to terapis list after success
        window.location.href = "{{ route('terapis') }}";
    }, 1000);
}

function showLoading() {
    showModal('loading-drawer');
}

function hideLoading() {
    hideModal('loading-drawer');
}

// Main TerapisForm object - organized and modular
const TerapisForm = {
    // Province-City data
    kotaData: {
        'Aceh': ['Kota Banda Aceh', 'Kota Langsa', 'Kota Lhokseumawe', 'Kota Sabang', 'Kota Subulussalam', 'Kabupaten Aceh Barat', 'Kabupaten Aceh Barat Daya', 'Kabupaten Aceh Besar', 'Kabupaten Aceh Jaya', 'Kabupaten Aceh Selatan', 'Kabupaten Aceh Singkil', 'Kabupaten Aceh Tamiang', 'Kabupaten Aceh Tengah', 'Kabupaten Aceh Tenggara', 'Kabupaten Aceh Timur', 'Kabupaten Aceh Utara', 'Kabupaten Bener Meriah', 'Kabupaten Bireuen', 'Kabupaten Gayo Lues', 'Kabupaten Nagan Raya', 'Kabupaten Pidie', 'Kabupaten Pidie Jaya', 'Kabupaten Simeulue'],
        'Sumatera Utara': ['Kota Medan', 'Kota Binjai', 'Kota Gunungsitoli', 'Kota Padang Sidimpuan', 'Kota Pematangsiantar', 'Kota Sibolga', 'Kota Tanjungbalai', 'Kota Tebing Tinggi', 'Kabupaten Asahan', 'Kabupaten Batubara', 'Kabupaten Dairi', 'Kabupaten Deli Serdang', 'Kabupaten Humbang Hasundutan', 'Kabupaten Karo', 'Kabupaten Labuhanbatu', 'Kabupaten Labuhanbatu Selatan', 'Kabupaten Labuhanbatu Utara', 'Kabupaten Langkat', 'Kabupaten Mandailing Natal', 'Kabupaten Nias', 'Kabupaten Nias Barat', 'Kabupaten Nias Selatan', 'Kabupaten Nias Utara', 'Kabupaten Padang Lawas', 'Kabupaten Padang Lawas Utara', 'Kabupaten Pakpak Bharat', 'Kabupaten Samosir', 'Kabupaten Serdang Bedagai', 'Kabupaten Simalungun', 'Kabupaten Tapanuli Selatan', 'Kabupaten Tapanuli Tengah', 'Kabupaten Tapanuli Utara', 'Kabupaten Toba Samosir'],
        'Sumatera Barat': ['Kota Padang', 'Kota Bukittinggi', 'Kota Padang Panjang', 'Kota Pariaman', 'Kota Payakumbuh', 'Kota Sawahlunto', 'Kota Solok', 'Kabupaten Agam', 'Kabupaten Dharmasraya', 'Kabupaten Kepulauan Mentawai', 'Kabupaten Lima Puluh Kota', 'Kabupaten Padang Pariaman', 'Kabupaten Pasaman', 'Kabupaten Pasaman Barat', 'Kabupaten Pesisir Selatan', 'Kabupaten Sijunjung', 'Kabupaten Solok', 'Kabupaten Solok Selatan', 'Kabupaten Tanah Datar'],
        'Riau': ['Kota Pekanbaru', 'Kota Dumai', 'Kabupaten Bengkalis', 'Kabupaten Indragiri Hilir', 'Kabupaten Indragiri Hulu', 'Kabupaten Kampar', 'Kabupaten Kepulauan Meranti', 'Kabupaten Kuantan Singingi', 'Kabupaten Pelalawan', 'Kabupaten Rokan Hilir', 'Kabupaten Rokan Hulu', 'Kabupaten Siak'],
        'Kepulauan Riau': ['Kota Batam', 'Kota Tanjung Pinang', 'Kabupaten Bintan', 'Kabupaten Karimun', 'Kabupaten Kepulauan Anambas', 'Kabupaten Lingga', 'Kabupaten Natuna'],
        'Jambi': ['Kota Jambi', 'Kota Sungai Penuh', 'Kabupaten Batanghari', 'Kabupaten Bungo', 'Kabupaten Kerinci', 'Kabupaten Merangin', 'Kabupaten Muaro Jambi', 'Kabupaten Sarolangun', 'Kabupaten Tanjung Jabung Barat', 'Kabupaten Tanjung Jabung Timur', 'Kabupaten Tebo'],
        'Bengkulu': ['Kota Bengkulu', 'Kabupaten Bengkulu Selatan', 'Kabupaten Bengkulu Tengah', 'Kabupaten Bengkulu Utara', 'Kabupaten Kaur', 'Kabupaten Kepahiang', 'Kabupaten Lebong', 'Kabupaten Mukomuko', 'Kabupaten Rejang Lebong', 'Kabupaten Seluma'],
        'Sumatera Selatan': ['Kota Palembang', 'Kota Lubuklinggau', 'Kota Pagar Alam', 'Kota Prabumulih', 'Kabupaten Banyuasin', 'Kabupaten Empat Lawang', 'Kabupaten Lahat', 'Kabupaten Muara Enim', 'Kabupaten Musi Banyuasin', 'Kabupaten Musi Rawas', 'Kabupaten Musi Rawas Utara', 'Kabupaten Ogan Ilir', 'Kabupaten Ogan Komering Ilir', 'Kabupaten Ogan Komering Ulu', 'Kabupaten Ogan Komering Ulu Selatan', 'Kabupaten Ogan Komering Ulu Timur', 'Kabupaten Penukal Abab Lematang Ilir'],
        'Lampung': ['Kota Bandar Lampung', 'Kota Metro', 'Kabupaten Lampung Barat', 'Kabupaten Lampung Selatan', 'Kabupaten Lampung Tengah', 'Kabupaten Lampung Timur', 'Kabupaten Lampung Utara', 'Kabupaten Mesuji', 'Kabupaten Pesawaran', 'Kabupaten Pesisir Barat', 'Kabupaten Pringsewu', 'Kabupaten Tanggamus', 'Kabupaten Tulang Bawang', 'Kabupaten Tulang Bawang Barat', 'Kabupaten Way Kanan'],
        'Kepulauan Bangka Belitung': ['Kota Pangkal Pinang', 'Kabupaten Bangka', 'Kabupaten Bangka Barat', 'Kabupaten Bangka Selatan', 'Kabupaten Bangka Tengah', 'Kabupaten Belitung', 'Kabupaten Belitung Timur'],
        'Banten': ['Kota Tangerang', 'Kota Tangerang Selatan', 'Kota Cilegon', 'Kota Serang', 'Kabupaten Tangerang', 'Kabupaten Lebak', 'Kabupaten Pandeglang', 'Kabupaten Serang'],
        'Jawa Barat': ['Kota Bandung', 'Kota Bekasi', 'Kota Bogor', 'Kota Depok', 'Kota Cimahi', 'Kota Cirebon', 'Kota Sukabumi', 'Kota Tasikmalaya', 'Kota Banjar', 'Kabupaten Bandung', 'Kabupaten Bandung Barat', 'Kabupaten Bogor', 'Kabupaten Ciamis', 'Kabupaten Cianjur', 'Kabupaten Cirebon', 'Kabupaten Garut', 'Kabupaten Indramayu', 'Kabupaten Karawang', 'Kabupaten Kuningan', 'Kabupaten Majalengka', 'Kabupaten Pangandaran', 'Kabupaten Purwakarta', 'Kabupaten Subang', 'Kabupaten Sukabumi', 'Kabupaten Sumedang', 'Kabupaten Tasikmalaya'],
        'DKI Jakarta': ['Jakarta Pusat', 'Jakarta Utara', 'Jakarta Selatan', 'Jakarta Timur', 'Jakarta Barat', 'Kepulauan Seribu'],
        'Jawa Tengah': ['Kota Semarang', 'Kota Surakarta', 'Kota Magelang', 'Kota Pekalongan', 'Kota Salatiga', 'Kota Tegal', 'Kabupaten Semarang', 'Kabupaten Boyolali', 'Kabupaten Banjarnegara', 'Kabupaten Banyumas', 'Kabupaten Batang', 'Kabupaten Blora', 'Kabupaten Brebes', 'Kabupaten Cilacap', 'Kabupaten Demak', 'Kabupaten Grobogan', 'Kabupaten Jepara', 'Kabupaten Karanganyar', 'Kabupaten Kebumen', 'Kabupaten Kendal', 'Kabupaten Klaten', 'Kabupaten Kudus', 'Kabupaten Magelang', 'Kabupaten Pati', 'Kabupaten Pekalongan', 'Kabupaten Pemalang', 'Kabupaten Purbalingga', 'Kabupaten Purworejo', 'Kabupaten Rembang', 'Kabupaten Sragen', 'Kabupaten Sukoharjo', 'Kabupaten Tegal', 'Kabupaten Temanggung', 'Kabupaten Wonogiri', 'Kabupaten Wonosobo'],
        'DI Yogyakarta': ['Kota Yogyakarta', 'Kabupaten Bantul', 'Kabupaten Sleman', 'Kabupaten Kulon Progo', 'Kabupaten Gunung Kidul'],
        'Jawa Timur': ['Kota Surabaya', 'Kota Malang', 'Kota Kediri', 'Kota Blitar', 'Kota Madiun', 'Kota Mojokerto', 'Kota Pasuruan', 'Kota Probolinggo', 'Kota Batu', 'Kabupaten Sidoarjo', 'Kabupaten Gresik', 'Kabupaten Bangkalan', 'Kabupaten Banyuwangi', 'Kabupaten Blitar', 'Kabupaten Bojonegoro', 'Kabupaten Bondowoso', 'Kabupaten Jember', 'Kabupaten Jombang', 'Kabupaten Kediri', 'Kabupaten Lamongan', 'Kabupaten Lumajang', 'Kabupaten Madiun', 'Kabupaten Magetan', 'Kabupaten Malang', 'Kabupaten Mojokerto', 'Kabupaten Nganjuk', 'Kabupaten Ngawi', 'Kabupaten Pacitan', 'Kabupaten Pamekasan', 'Kabupaten Pasuruan', 'Kabupaten Ponorogo', 'Kabupaten Probolinggo', 'Kabupaten Sampang', 'Kabupaten Situbondo', 'Kabupaten Sumenep', 'Kabupaten Trenggalek', 'Kabupaten Tuban', 'Kabupaten Tulungagung'],
        'Bali': ['Kota Denpasar', 'Kabupaten Badung', 'Kabupaten Bangli', 'Kabupaten Buleleng', 'Kabupaten Gianyar', 'Kabupaten Jembrana', 'Kabupaten Karangasem', 'Kabupaten Klungkung', 'Kabupaten Tabanan'],
        'Nusa Tenggara Barat': ['Kota Mataram', 'Kota Bima', 'Kabupaten Bima', 'Kabupaten Dompu', 'Kabupaten Lombok Barat', 'Kabupaten Lombok Tengah', 'Kabupaten Lombok Timur', 'Kabupaten Lombok Utara', 'Kabupaten Sumbawa', 'Kabupaten Sumbawa Barat'],
        'Nusa Tenggara Timur': ['Kota Kupang', 'Kabupaten Alor', 'Kabupaten Belu', 'Kabupaten Ende', 'Kabupaten Flores Timur', 'Kabupaten Kupang', 'Kabupaten Lembata', 'Kabupaten Malaka', 'Kabupaten Manggarai', 'Kabupaten Manggarai Barat', 'Kabupaten Manggarai Timur', 'Kabupaten Nagekeo', 'Kabupaten Ngada', 'Kabupaten Rote Ndao', 'Kabupaten Sabu Raijua', 'Kabupaten Sikka', 'Kabupaten Sumba Barat', 'Kabupaten Sumba Barat Daya', 'Kabupaten Sumba Tengah', 'Kabupaten Sumba Timur', 'Kabupaten Timor Tengah Selatan', 'Kabupaten Timor Tengah Utara'],
        'Kalimantan Barat': ['Kota Pontianak', 'Kota Singkawang', 'Kabupaten Bengkayang', 'Kabupaten Kapuas Hulu', 'Kabupaten Kayong Utara', 'Kabupaten Ketapang', 'Kabupaten Kubu Raya', 'Kabupaten Landak', 'Kabupaten Melawi', 'Kabupaten Mempawah', 'Kabupaten Sambas', 'Kabupaten Sanggau', 'Kabupaten Sekadau', 'Kabupaten Sintang'],
        'Kalimantan Tengah': ['Kota Palangka Raya', 'Kabupaten Barito Selatan', 'Kabupaten Barito Timur', 'Kabupaten Barito Utara', 'Kabupaten Gunung Mas', 'Kabupaten Kapuas', 'Kabupaten Katingan', 'Kabupaten Kotawaringin Barat', 'Kabupaten Kotawaringin Timur', 'Kabupaten Lamandau', 'Kabupaten Murung Raya', 'Kabupaten Pulang Pisau', 'Kabupaten Seruyan', 'Kabupaten Sukamara'],
        'Kalimantan Selatan': ['Kota Banjarmasin', 'Kota Banjarbaru', 'Kabupaten Balangan', 'Kabupaten Banjar', 'Kabupaten Barito Kuala', 'Kabupaten Hulu Sungai Selatan', 'Kabupaten Hulu Sungai Tengah', 'Kabupaten Hulu Sungai Utara', 'Kabupaten Kotabaru', 'Kabupaten Tabalong', 'Kabupaten Tanah Bumbu', 'Kabupaten Tanah Laut', 'Kabupaten Tapin'],
        'Kalimantan Timur': ['Kota Balikpapan', 'Kota Bontang', 'Kota Samarinda', 'Kabupaten Berau', 'Kabupaten Kutai Barat', 'Kabupaten Kutai Kartanegara', 'Kabupaten Kutai Timur', 'Kabupaten Mahakam Ulu', 'Kabupaten Paser', 'Kabupaten Penajam Paser Utara'],
        'Kalimantan Utara': ['Kota Tarakan', 'Kabupaten Bulungan', 'Kabupaten Malinau', 'Kabupaten Nunukan', 'Kabupaten Tana Tidung'],
        'Sulawesi Utara': ['Kota Manado', 'Kota Bitung', 'Kota Kotamobagu', 'Kota Tomohon', 'Kabupaten Bolaang Mongondow', 'Kabupaten Bolaang Mongondow Selatan', 'Kabupaten Bolaang Mongondow Timur', 'Kabupaten Bolaang Mongondow Utara', 'Kabupaten Kepulauan Sangihe', 'Kabupaten Kepulauan Siau Tagulandang Biaro', 'Kabupaten Kepulauan Talaud', 'Kabupaten Minahasa', 'Kabupaten Minahasa Selatan', 'Kabupaten Minahasa Tenggara', 'Kabupaten Minahasa Utara'],
        'Sulawesi Tengah': ['Kota Palu', 'Kabupaten Banggai', 'Kabupaten Banggai Kepulauan', 'Kabupaten Banggai Laut', 'Kabupaten Buol', 'Kabupaten Donggala', 'Kabupaten Morowali', 'Kabupaten Morowali Utara', 'Kabupaten Parigi Moutong', 'Kabupaten Poso', 'Kabupaten Sigi', 'Kabupaten Tojo Una-Una', 'Kabupaten Toli-Toli'],
        'Sulawesi Selatan': ['Kota Makassar', 'Kota Palopo', 'Kota Parepare', 'Kabupaten Bantaeng', 'Kabupaten Barru', 'Kabupaten Bone', 'Kabupaten Bulukumba', 'Kabupaten Enrekang', 'Kabupaten Gowa', 'Kabupaten Jeneponto', 'Kabupaten Kepulauan Selayar', 'Kabupaten Luwu', 'Kabupaten Luwu Timur', 'Kabupaten Luwu Utara', 'Kabupaten Maros', 'Kabupaten Pangkajene dan Kepulauan', 'Kabupaten Pinrang', 'Kabupaten Sidenreng Rappang', 'Kabupaten Sinjai', 'Kabupaten Soppeng', 'Kabupaten Takalar', 'Kabupaten Tana Toraja', 'Kabupaten Toraja Utara', 'Kabupaten Wajo'],
        'Sulawesi Tenggara': ['Kota Kendari', 'Kota Bau-Bau', 'Kabupaten Bombana', 'Kabupaten Buton', 'Kabupaten Buton Selatan', 'Kabupaten Buton Tengah', 'Kabupaten Buton Utara', 'Kabupaten Kolaka', 'Kabupaten Kolaka Timur', 'Kabupaten Kolaka Utara', 'Kabupaten Konawe', 'Kabupaten Konawe Kepulauan', 'Kabupaten Konawe Selatan', 'Kabupaten Konawe Utara', 'Kabupaten Muna', 'Kabupaten Muna Barat', 'Kabupaten Wakatobi'],
        'Gorontalo': ['Kota Gorontalo', 'Kabupaten Boalemo', 'Kabupaten Bone Bolango', 'Kabupaten Gorontalo', 'Kabupaten Gorontalo Utara', 'Kabupaten Pohuwato'],
        'Sulawesi Barat': ['Kabupaten Majene', 'Kabupaten Mamasa', 'Kabupaten Mamuju', 'Kabupaten Mamuju Tengah', 'Kabupaten Mamuju Utara', 'Kabupaten Polewali Mandar'],
        'Maluku': ['Kota Ambon', 'Kota Tual', 'Kabupaten Buru', 'Kabupaten Buru Selatan', 'Kabupaten Kepulauan Aru', 'Kabupaten Maluku Barat Daya', 'Kabupaten Maluku Tengah', 'Kabupaten Maluku Tenggara', 'Kabupaten Maluku Tenggara Barat', 'Kabupaten Seram Bagian Barat', 'Kabupaten Seram Bagian Timur'],
        'Maluku Utara': ['Kota Ternate', 'Kota Tidore Kepulauan', 'Kabupaten Halmahera Barat', 'Kabupaten Halmahera Selatan', 'Kabupaten Halmahera Tengah', 'Kabupaten Halmahera Timur', 'Kabupaten Halmahera Utara', 'Kabupaten Kepulauan Sula', 'Kabupaten Pulau Morotai', 'Kabupaten Pulau Taliabu'],
        'Papua': ['Kota Jayapura', 'Kabupaten Asmat', 'Kabupaten Biak Numfor', 'Kabupaten Boven Digoel', 'Kabupaten Deiyai', 'Kabupaten Dogiyai', 'Kabupaten Intan Jaya', 'Kabupaten Jayapura', 'Kabupaten Jayawijaya', 'Kabupaten Keerom', 'Kabupaten Kepulauan Yapen', 'Kabupaten Lanny Jaya', 'Kabupaten Mamberamo Raya', 'Kabupaten Mamberamo Tengah', 'Kabupaten Mappi', 'Kabupaten Merauke', 'Kabupaten Mimika', 'Kabupaten Nabire', 'Kabupaten Nduga', 'Kabupaten Paniai', 'Kabupaten Pegunungan Bintang', 'Kabupaten Puncak', 'Kabupaten Puncak Jaya', 'Kabupaten Sarmi', 'Kabupaten Supiori', 'Kabupaten Tolikara', 'Kabupaten Waropen', 'Kabupaten Yahukimo', 'Kabupaten Yalimo'],
        'Papua Barat': ['Kota Sorong', 'Kabupaten Fakfak', 'Kabupaten Kaimana', 'Kabupaten Manokwari', 'Kabupaten Manokwari Selatan', 'Kabupaten Maybrat', 'Kabupaten Pegunungan Arfak', 'Kabupaten Raja Ampat', 'Kabupaten Sorong', 'Kabupaten Sorong Selatan', 'Kabupaten Tambrauw', 'Kabupaten Teluk Bintuni', 'Kabupaten Teluk Wondama'],
        'Papua Selatan': ['Kabupaten Asmat', 'Kabupaten Boven Digoel', 'Kabupaten Mappi', 'Kabupaten Merauke'],
        'Papua Tengah': ['Kabupaten Deiyai', 'Kabupaten Dogiyai', 'Kabupaten Intan Jaya', 'Kabupaten Mimika', 'Kabupaten Nabire', 'Kabupaten Paniai', 'Kabupaten Puncak', 'Kabupaten Puncak Jaya'],
        'Papua Pegunungan': ['Kabupaten Jayawijaya', 'Kabupaten Lanny Jaya', 'Kabupaten Mamberamo Tengah', 'Kabupaten Nduga', 'Kabupaten Pegunungan Bintang', 'Kabupaten Tolikara', 'Kabupaten Yahukimo', 'Kabupaten Yalimo'],
        'Papua Barat Daya': ['Kabupaten Fakfak', 'Kabupaten Kaimana', 'Kabupaten Manokwari', 'Kabupaten Manokwari Selatan', 'Kabupaten Maybrat', 'Kabupaten Pegunungan Arfak', 'Kabupaten Raja Ampat', 'Kabupaten Sorong', 'Kabupaten Sorong Selatan', 'Kabupaten Tambrauw', 'Kabupaten Teluk Bintuni', 'Kabupaten Teluk Wondama']
    },

    // Date picker functionality
    datePicker: {
        currentMonth: new Date().getMonth(),
        currentYear: new Date().getFullYear(),
        selectedDate: null,

        init() {
            this.populateYearSelect();
            document.getElementById('month-select').value = this.currentMonth;
            this.renderCalendar();
            this.bindEvents();
        },

        populateYearSelect() {
            const yearSelect = document.getElementById('year-select');
            const currentYear = new Date().getFullYear();
            
            for (let year = currentYear - 50; year <= currentYear + 10; year++) {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                if (year === currentYear) option.selected = true;
                yearSelect.appendChild(option);
            }
        },

        bindEvents() {
            document.getElementById('month-select').addEventListener('change', (e) => {
                this.currentMonth = parseInt(e.target.value);
                this.renderCalendar();
            });

            document.getElementById('year-select').addEventListener('change', (e) => {
                this.currentYear = parseInt(e.target.value);
                this.renderCalendar();
            });

            // Close date picker when clicking outside
            document.addEventListener('click', (e) => {
                const datePicker = document.getElementById('custom-date-picker');
                const dateInput = document.getElementById('tanggal_lahir');
                const calendarIcon = e.target.closest('[onclick*="datePicker.toggle"]');
                
                if (!datePicker.contains(e.target) && e.target !== dateInput && !calendarIcon) {
                    this.close();
                }
            });
        },

        toggle() {
            const datePicker = document.getElementById('custom-date-picker');
            if (datePicker.classList.contains('hidden')) {
                datePicker.classList.remove('hidden');
                this.renderCalendar();
            } else {
                datePicker.classList.add('hidden');
            }
        },

        close() {
            document.getElementById('custom-date-picker').classList.add('hidden');
        },

        changeMonth(direction) {
            this.currentMonth += direction;
            
            if (this.currentMonth > 11) {
                this.currentMonth = 0;
                this.currentYear++;
            } else if (this.currentMonth < 0) {
                this.currentMonth = 11;
                this.currentYear--;
            }
            
            document.getElementById('month-select').value = this.currentMonth;
            document.getElementById('year-select').value = this.currentYear;
            this.renderCalendar();
        },

        renderCalendar() {
            const calendarDays = document.getElementById('calendar-days');
            calendarDays.innerHTML = '';
            
            const firstDay = new Date(this.currentYear, this.currentMonth, 1).getDay();
            const daysInMonth = new Date(this.currentYear, this.currentMonth + 1, 0).getDate();
            const today = new Date();
            
            // Add empty cells for days before the first day of the month
            for (let i = 0; i < firstDay; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.className = 'p-2';
                calendarDays.appendChild(emptyCell);
            }
            
            // Add days of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const dayCell = document.createElement('div');
                dayCell.className = 'p-1 text-center text-xs cursor-pointer hover:bg-gray-100 rounded w-6 h-6 flex items-center justify-center';
                dayCell.textContent = day;
                
                const cellDate = new Date(this.currentYear, this.currentMonth, day);
                
                // Highlight today
                if (cellDate.toDateString() === today.toDateString()) {
                    dayCell.classList.add('bg-blue-100', 'text-blue-600');
                }
                
                // Highlight selected date
                if (this.selectedDate && cellDate.toDateString() === this.selectedDate.toDateString()) {
                    dayCell.classList.add('bg-teal-500', 'text-white');
                    dayCell.classList.remove('hover:bg-gray-100');
                }
                
                dayCell.addEventListener('click', () => {
                    // Remove previous selection
                    document.querySelectorAll('#calendar-days .bg-teal-500').forEach(el => {
                        el.classList.remove('bg-teal-500', 'text-white');
                        el.classList.add('hover:bg-gray-100');
                    });
                    
                    // Add selection to clicked day
                    dayCell.classList.add('bg-teal-500', 'text-white');
                    dayCell.classList.remove('hover:bg-gray-100');
                    
                    this.selectedDate = new Date(this.currentYear, this.currentMonth, day);
                });
                
                calendarDays.appendChild(dayCell);
            }
        },

        apply() {
            if (this.selectedDate) {
                const day = String(this.selectedDate.getDate()).padStart(2, '0');
                const month = String(this.selectedDate.getMonth() + 1).padStart(2, '0');
                const year = this.selectedDate.getFullYear();
                
                document.getElementById('tanggal_lahir').value = `${day}/${month}/${year}`;
            }
            this.close();
        }
    },

    // File upload functionality - Updated version
    fileUpload: {
        maxSize: 5 * 1024 * 1024, // 5MB
        allowedTypes: ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'],

        init() {
            document.getElementById('foto').addEventListener('change', (e) => this.handleFileSelect(e));
            this.initializeDragAndDrop();
        },

        selectFile() {
            document.getElementById('foto').click();
        },

        handleFileSelect(e) {
            const file = e.target.files[0];
            const fileNameSpan = document.getElementById('file-name');
            const photoPreview = document.getElementById('photo-preview');
            
            // Clear any existing error messages for this field
            this.clearPhotoError();
            
            if (file) {
                // Validate file size
                if (file.size > this.maxSize) {
                    this.showPhotoError('Ukuran file terlalu besar. Maksimal 5MB.');
                    e.target.value = '';
                    this.resetFileInput(fileNameSpan, photoPreview);
                    return;
                }
                
                // Validate file type
                if (!this.allowedTypes.includes(file.type)) {
                    this.showPhotoError('Format file tidak didukung. Gunakan JPEG, PNG, JPG, GIF, atau WebP.');
                    e.target.value = '';
                    this.resetFileInput(fileNameSpan, photoPreview);
                    return;
                }
                
                // Update file name display
                fileNameSpan.textContent = file.name;
                fileNameSpan.classList.remove('text-gray-400');
                fileNameSpan.classList.add('text-gray-700', 'font-medium');
                
                // Create file preview
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Preview';
                    img.className = 'w-full h-full object-cover rounded-full';
                    
                    photoPreview.innerHTML = '';
                    photoPreview.appendChild(img);
                };
                
                reader.onerror = () => {
                    this.showPhotoError('Terjadi kesalahan saat membaca file.');
                    this.resetFileInput(fileNameSpan, photoPreview);
                };
                
                reader.readAsDataURL(file);
            } else {
                this.resetFileInput(fileNameSpan, photoPreview);
            }
        },

        resetFileInput(fileNameSpan, photoPreview) {
            fileNameSpan.textContent = 'File belum dipilih';
            fileNameSpan.classList.remove('text-gray-700', 'font-medium');
            fileNameSpan.classList.add('text-gray-400');
            
            photoPreview.innerHTML = `
                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            `;
        },

        // Updated method untuk menampilkan error khusus foto
        showPhotoError(message) {
            // Clear existing error first
            this.clearPhotoError();
            
            // Find the file input container
            const fileInputContainer = document.querySelector('.flex.items-center.space-x-3.border.border-gray-500.rounded');
            
            if (fileInputContainer) {
                // Create error message element
                const errorDiv = document.createElement('p');
                errorDiv.id = 'foto-error';
                errorDiv.className = 'text-red-500 text-xs mt-1';
                errorDiv.textContent = message;
                
                // Insert error message after the file input container
                fileInputContainer.parentNode.insertBefore(errorDiv, fileInputContainer.nextSibling);
                
                // Add error styling to the container
                fileInputContainer.classList.add('border-red-500');
                fileInputContainer.classList.remove('border-gray-500');
            }
        },

        // Method untuk menghapus error foto
        clearPhotoError() {
            const errorElement = document.querySelector('#foto-error');
            if (errorElement) {
                errorElement.remove();
            }
            
            // Remove error styling from container
            const fileInputContainer = document.querySelector('.flex.items-center.space-x-3.border');
            if (fileInputContainer) {
                fileInputContainer.classList.remove('border-red-500');
                fileInputContainer.classList.add('border-gray-500');
            }
        },

        initializeDragAndDrop() {
            const dropZone = document.querySelector('.flex.items-center.space-x-3.border');
            const fileInput = document.getElementById('foto');
            
            if (!dropZone) return;
            
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, this.preventDefaults, false);
            });
            
            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => this.highlight(dropZone), false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => this.unhighlight(dropZone), false);
            });
            
            dropZone.addEventListener('drop', (e) => this.handleDrop(e, fileInput), false);
        },

        preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        },

        highlight(dropZone) {
            dropZone.classList.add('border-teal-500', 'bg-teal-50');
        },

        unhighlight(dropZone) {
            dropZone.classList.remove('border-teal-500', 'bg-teal-50');
        },

        handleDrop(e, fileInput) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 0) {
                fileInput.files = files;
                fileInput.dispatchEvent(new Event('change'));
            }
        }
    },

    // Province-City functionality
    locationSelector: {
        init() {
            const provinsiSelect = document.getElementById('provinsi');
            const kotaSelect = document.getElementById('kota_kabupaten');
            
            // Disable city dropdown initially
            kotaSelect.disabled = true;
            
            // Handle province change
            provinsiSelect.addEventListener('change', (e) => {
                this.updateCities(e.target.value, kotaSelect);
            });
            
            // Set old values if they exist
            this.setOldValues();
        },

        updateCities(selectedProvinsi, kotaSelect) {
            // Clear existing options
            kotaSelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
            
            if (selectedProvinsi && TerapisForm.kotaData[selectedProvinsi]) {
                // Sort cities alphabetically
                const cities = TerapisForm.kotaData[selectedProvinsi].sort();
                
                cities.forEach(kota => {
                    const option = document.createElement('option');
                    option.value = kota;
                    option.textContent = kota;
                    kotaSelect.appendChild(option);
                });
                
                kotaSelect.disabled = false;
            } else {
                kotaSelect.disabled = true;
            }
        },

        setOldValues() {
            const oldProvinsi = "{{ old('provinsi') }}";
            const oldKotaKabupaten = "{{ old('kota_kabupaten') }}";
            
            if (oldProvinsi && oldKotaKabupaten) {
                const provinsiSelect = document.getElementById('provinsi');
                const kotaSelect = document.getElementById('kota_kabupaten');
                
                // Trigger change event to populate kota options
                provinsiSelect.dispatchEvent(new Event('change'));
                
                // Set the old kota value after a small delay
                setTimeout(() => {
                    kotaSelect.value = oldKotaKabupaten;
                }, 100);
            }
        }
    },

    // Form submission functionality - Updated validation method
    formSubmission: {
        init() {
            const form = document.getElementById('terapisForm');
            form.addEventListener('submit', (e) => this.handleSubmit(e));
        },

        handleSubmit(e) {
            e.preventDefault();
            
            const form = e.target;
            const submitButton = document.getElementById('submit-btn');
            
            // Final client-side validation
            if (!this.validateForm(form)) {
                return false;
            }
            
            // Show loading spinner
            showLoading();
            
            // Disable submit button
            const originalText = submitButton.textContent;
            submitButton.textContent = 'Menyimpan...';
            submitButton.disabled = true;
            
            // Prepare form data
            const formData = new FormData(form);
            
            // Make AJAX request
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                const contentType = response.headers.get('Content-Type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    throw new Error('Server returned non-JSON response');
                }
            })
            .then(data => {
                hideLoading();
                
                if (data.success) {
                    showSuccess();
                } else {
                    this.handleErrors(data.errors || {});
                    this.showErrorMessage(data.message || 'Terjadi kesalahan saat menyimpan data.');
                }
            })
            .catch(error => {
                hideLoading();
                console.error('Error:', error);
                this.showErrorMessage('Terjadi kesalahan jaringan. Silakan coba lagi.');
            })
            .finally(() => {
                submitButton.textContent = originalText;
                submitButton.disabled = false;
            });
        },

        validateForm(form) {
            // Clear previous error messages
            this.clearErrorMessages();
            
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    // Special handling for foto field
                    if (field.name === 'foto') {
                        TerapisForm.fileUpload.showPhotoError('Foto wajib diunggah');
                    } else {
                        this.showFieldError(field, 'Field ini wajib diisi');
                    }
                    isValid = false;
                }
            });
            
            // Validate file upload specifically
            const fileInput = document.getElementById('foto');
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                
                // File size validation
                const maxSize = 5 * 1024 * 1024; // 5MB
                if (file.size > maxSize) {
                    TerapisForm.fileUpload.showPhotoError('Ukuran file foto terlalu besar. Maksimal 5MB.');
                    isValid = false;
                }
                
                // File type validation
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
                if (!allowedTypes.includes(file.type)) {
                    TerapisForm.fileUpload.showPhotoError('Format foto tidak didukung.');
                    isValid = false;
                }
            }
            
            // Validate email format
            const emailField = document.getElementById('email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailField.value && !emailRegex.test(emailField.value)) {
                this.showFieldError(emailField, 'Format email tidak valid');
                isValid = false;
            }
            
            // Validate NIK (should be 16 digits)
            const nikField = document.getElementById('nik');
            if (nikField.value && (nikField.value.length !== 16 || !/^\d{16}$/.test(nikField.value))) {
                this.showFieldError(nikField, 'NIK harus berupa 16 digit angka');
                isValid = false;
            }
            
            // Validate phone number
            const phoneField = document.getElementById('no_ponsel');
            if (phoneField.value && !/^[0-9+\-\s()]+$/.test(phoneField.value)) {
                this.showFieldError(phoneField, 'Format nomor ponsel tidak valid');
                isValid = false;
            }
            
            return isValid;
        },

        showFieldError(field, message) {
            // Skip foto field as it's handled separately
            if (field.name === 'foto') {
                return;
            }
            
            // Remove existing error
            const existingError = field.parentNode.querySelector('.field-error');
            if (existingError) {
                existingError.remove();
            }
            
            // Add error class to field
            field.classList.add('border-red-500');
            
            // Create error message
            const errorElement = document.createElement('p');
            errorElement.className = 'text-red-500 text-xs mt-1 field-error';
            errorElement.textContent = message;
            
            // Insert error message after field
            field.parentNode.appendChild(errorElement);
        },

        clearErrorMessages() {
            // Remove all field error messages
            document.querySelectorAll('.field-error').forEach(error => error.remove());
            
            // Clear photo error specifically
            TerapisForm.fileUpload.clearPhotoError();
            
            // Remove error classes from fields
            document.querySelectorAll('.border-red-500').forEach(field => {
                if (field.name !== 'foto') { // Don't reset foto field styling here
                    field.classList.remove('border-red-500');
                }
            });
            
            // Hide general error message
            const generalError = document.getElementById('general-error');
            if (generalError) {
                generalError.classList.add('hidden');
            }
        },

        handleErrors(errors) {
            Object.keys(errors).forEach(fieldName => {
                if (fieldName === 'foto') {
                    // Handle foto errors specially
                    if (errors[fieldName].length > 0) {
                        TerapisForm.fileUpload.showPhotoError(errors[fieldName][0]);
                    }
                } else {
                    // Handle other field errors
                    const field = document.querySelector(`[name="${fieldName}"]`);
                    if (field && errors[fieldName].length > 0) {
                        this.showFieldError(field, errors[fieldName][0]);
                    }
                }
            });
        },

        showErrorMessage(message) {
            // Create or show general error message
            let errorDiv = document.getElementById('general-error');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.id = 'general-error';
                errorDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4';
                
                // Insert at the top of the form
                const form = document.getElementById('terapisForm');
                form.insertBefore(errorDiv, form.firstChild);
            }
            
            errorDiv.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <span>${message}</span>
                </div>
            `;
            errorDiv.classList.remove('hidden');
            
            // Scroll to error message
            errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                if (errorDiv) {
                    errorDiv.classList.add('hidden');
                }
            }, 5000);
        }
    },

    // Initialize all functionality
    init() {
        this.datePicker.init();
        this.fileUpload.init();
        this.locationSelector.init();
        this.formSubmission.init();
    }
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Set up CSRF token for AJAX requests
    if (typeof $ !== 'undefined') {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }
    
    TerapisForm.init();
});
</script>
@endpush

@endsection