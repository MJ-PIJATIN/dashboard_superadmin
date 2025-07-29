@extends('layouts.app')

@section('title', 'Tambah Data Terapis')
@section('page-title', 'Tambah Data Terapis')
@section('page-description', 'Form untuk menambahkan data terapis baru ke sistem Pijat.in')
@section('navtitle')
    <div class="text-base flex items-center gap-2" style="color: #374151;">
        <span>Terapis</span>
        <span class="text-grey-700 font-semibold">&gt;</span>
        <span class="font-semibold" style="color: #469D89;">Tambah Data Terapis</span>
    </div>
@endsection

@section('content')
<div class="bg-gray-100 min-h-screen">
<div class="max-w-screen-xl bg-gray-100 ml-[25px] pt-[70px] pb-[100px] pr-[25px]">

<div class="min-h-screen bg-gray-100 p-6">
    <!-- Header -->
        <div class="flex items-center mb-6">
            <div class="flex items-center text-sm text-gray-700 font-semibold hover:text-gray-800 transition-colors">
                <img onclick="goBack()" src="{{ asset('images/back.svg') }}" alt="Back Icon" class="w-4 h-4 mr-2 cursor-pointer">
                <span class="font-large text-base">Tambah Data Terapis</span>
            </div>
        </div>

    <!-- Form Content -->
    <div class="bg-white rounded-lg p-6 shadow-lg border border-gray-200">
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Main Content Layout with Full Height Container -->
            <div class="flex gap-8 relative">
                <!-- Left Section Container (includes form fields and area penempatan) -->
                <div class="flex-1" style="max-width: 600px;">
                    <!-- Form Fields -->
                    <div class="grid grid-cols-2 gap-x-8 gap-y-4">
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <!-- Nama Lengkap -->
                            <div>
                                <label for="nama_lengkap" class="block text-sm text-gray-700 mb-1">
                                    Nama Lengkap*
                                </label>
                                <input 
                                    type="text" 
                                    id="nama_lengkap" 
                                    name="nama_lengkap"
                                    class="w-full px-3 py-2 text-sm border border-gray-500 rounded focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500"
                                    placeholder="Masukkan nama lengkap"
                                    required
                                >
                            </div>

                            <!-- Tempat Lahir -->
                            <div>
                                <label for="tempat_lahir" class="block text-sm text-gray-700 mb-1">
                                    Tempat Lahir
                                </label>
                                <input 
                                    type="text" 
                                    id="tempat_lahir" 
                                    name="tempat_lahir"
                                    class="w-full px-3 py-2 text-sm border border-gray-500 rounded focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500"
                                    placeholder="Masukkan tempat lahir"
                                >
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <label class="block text-sm text-gray-700 mb-5">
                                    Jenis Kelamin*
                                </label>
                                <div class="flex space-x-6">
                                    <label class="flex items-center">
                                        <input 
                                            type="radio" 
                                            name="jenis_kelamin" 
                                            value="Laki-laki"
                                            class="w-4 h-4 text-teal-600 border-gray-500 focus:ring-teal-500"
                                            required
                                        >
                                        <span class="ml-2 text-sm text-gray-700">Laki-laki</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input 
                                            type="radio" 
                                            name="jenis_kelamin" 
                                            value="Perempuan"
                                            class="w-4 h-4 text-teal-600 border-gray-500 focus:ring-teal-500"
                                        >
                                        <span class="ml-2 text-sm text-gray-700">Perempuan</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm text-gray-700 mt-[22px] mb-1">
                                    Email
                                </label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email"
                                    class="w-full px-3 py-2 text-sm border border-gray-500 rounded focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500"
                                    placeholder="Masukkan alamat email"
                                >
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-4">
                            <!-- NIK -->
                            <div>
                                <label for="nik" class="block text-sm text-gray-700 mb-1">
                                    NIK*
                                </label>
                                <input 
                                    type="text" 
                                    id="nik" 
                                    name="nik"
                                    class="w-full px-3 py-2 text-sm border border-gray-500 rounded focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500"
                                    placeholder="Masukkan NIK"
                                    required
                                >
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="relative">
                                <label for="tanggal_lahir" class="block text-sm text-gray-700 mb-1">
                                    Tanggal Lahir
                                </label>
                                <div class="flex w-full rounded overflow-hidden border border-gray-500 focus-within:ring-1 focus-within:ring-teal-500 focus-within:border-teal-500">
                                    <!-- Ikon -->
                                    <div class="bg-teal-500 flex items-center justify-center px-3 cursor-pointer" onclick="toggleDatePicker()">
                                        <img src="{{ asset('images/calendar.svg') }}" alt="calendar" class="w-[24px] h-[24px]">
                                    </div>
                                    <!-- Input -->
                                    <input 
                                        type="text" 
                                        id="tanggal_lahir" 
                                        name="tanggal_lahir"
                                        class="w-full px-3 py-2 text-sm text-gray-700 placeholder-gray-400 focus:outline-none"
                                        placeholder="Masukkan tanggal lahir"
                                        readonly
                                        onclick="toggleDatePicker()"
                                    >
                                </div>
                                
                                <!-- Custom Date Picker -->
                                <div id="custom-date-picker" class="absolute top-full left-0 mt-1 bg-white border border-gray-300 rounded-lg shadow-lg z-50 hidden w-64">
                                    <div class="p-3">
                                        <!-- Month/Year Header -->
                                        <div class="flex justify-between items-center mb-3">
                                            <button type="button" class="p-1 hover:bg-gray-100 rounded" onclick="changeMonth(-1)">
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
                                                <select id="year-select" class="text-xs border border-gray-300 rounded px-1 py-1 w-16">
                                                    <!-- Years will be populated by JavaScript -->
                                                </select>
                                            </div>
                                            <button type="button" class="p-1 hover:bg-gray-100 rounded" onclick="changeMonth(1)">
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
                                        <div id="calendar-days" class="grid grid-cols-7 gap-1">
                                            <!-- Days will be populated by JavaScript -->
                                        </div>
                                        
                                        <!-- Action Buttons -->
                                        <div class="flex justify-end space-x-2 mt-3 pt-2 border-t border-gray-200">
                                            <button type="button" class="px-3 py-1 text-xs text-gray-600 hover:bg-gray-100 rounded" onclick="closeDatePicker()">
                                                Batal
                                            </button>
                                            <button type="button" class="px-3 py-1 text-xs bg-teal-500 text-white rounded hover:bg-teal-600" onclick="applySelectedDate()">
                                                Terapkan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div>
                                <label for="alamat" class="block text-sm text-gray-700 mb-1">
                                    Alamat
                                </label>
                                <input 
                                    type="text" 
                                    id="alamat" 
                                    name="alamat"
                                    class="w-full px-3 py-2 text-sm border border-gray-500 rounded focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500"
                                    placeholder="Masukkan alamat lengkap"
                                >
                            </div>

                            <!-- No. Ponsel -->
                            <div>
                                <label for="no_ponsel" class="block text-sm text-gray-700 mb-1">
                                    No. Ponsel
                                </label>
                                <input 
                                    type="tel" 
                                    id="no_ponsel" 
                                    name="no_ponsel"
                                    class="w-full px-3 py-2 text-sm border border-gray-500 rounded focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500"
                                    placeholder="Masukkan nomor ponsel"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Area Penempatan Section -->
                    <div class="mt-8">
                        <h3 class="text-md font-semibold text-gray-900 mb-4">Area Penempatan</h3>
                        <div class="grid grid-cols-2 gap-x-8">
                            <!-- Provinsi -->
                            <div>
                                <label for="provinsi" class="block text-sm text-gray-700 mb-1">
                                    Provinsi*
                                </label>
                                <select
                                    id="provinsi"
                                    name="provinsi"
                                    class="w-full px-3 py-2 text-sm border border-gray-500 rounded focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500 bg-white"
                                    required
                                >
                                    <option value="">Pilih Provinsi</option>
                                    <option value="DKI Jakarta">DKI Jakarta</option>
                                    <option value="Jawa Barat">Jawa Barat</option>
                                    <option value="Jawa Tengah">Jawa Tengah</option>
                                    <option value="Jawa Timur">Jawa Timur</option>
                                    <option value="DI Yogyakarta">DI Yogyakarta</option>
                                    <option value="Banten">Banten</option>
                                    <option value="Sumatera Utara">Sumatera Utara</option>
                                    <option value="Sumatera Barat">Sumatera Barat</option>
                                    <option value="Riau">Riau</option>
                                    <option value="Sumatera Selatan">Sumatera Selatan</option>
                                    <option value="Bali">Bali</option>
                                    <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                </select>
                            </div>
                            <!-- Kota/Kabupaten -->
                            <div>
                                <label for="kota_kabupaten" class="block text-sm text-gray-700 mb-1">
                                    Kota/Kabupaten*
                                </label>
                                <select
                                    id="kota_kabupaten"
                                    name="kota_kabupaten"
                                    class="w-full px-3 py-2 text-sm border border-gray-500 rounded focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500 bg-white"
                                    required
                                >
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
                    <!-- Upload Foto Title -->
                    <h3 class="text-md font-semibold text-gray-900">Upload Foto</h3>
                    
                    <!-- Upload Photo Content -->
                    <div class="flex flex-row space-x-6 items-center">
                        <!-- File Input Section -->
                        <div class="flex items-center space-x-3 border border-gray-500 rounded reactale">
                            <!-- File Status Text -->
                            <span class="text-xs text-gray-400 flex-1 ml-2" id="file-name">File belum dipilih</span>

                            <!-- Upload Button -->
                            <div>
                                <input 
                                    type="file" 
                                    id="foto" 
                                    name="foto" 
                                    accept="image/*"
                                    class="hidden"
                                >
                                <button 
                                    type="button" 
                                    onclick="document.getElementById('foto').click()"
                                    class="px-4 py-2 bg-teal-500 text-white text-sm font-medium rounded hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-colors"
                                >
                                    Pilih file
                                </button>
                            </div>
                        </div>

                        <!-- Photo Preview -->
                        <div class="flex justify-center">
                            <!-- Large circular preview -->
                            <div class="w-24 h-24 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden">
                                <div id="photo-preview" class="w-full h-full flex items-center justify-center">
                                    <!-- Default user icon -->
                                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="mt-[395px]">
                    <button 
                        type="submit"
                        class="px-8 py-2.5 bg-teal-500 text-white text-sm font-medium rounded hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        Tambah Data
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

</div>

@push('scripts')
<script>
    // Global variables for date picker
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();
    let selectedDate = null;

    // Go back function
    function goBack() {
        window.history.back();
    }

    // Initialize date picker
    document.addEventListener('DOMContentLoaded', function() {
        initializeDatePicker();
        
        // Close date picker when clicking outside
        document.addEventListener('click', function(e) {
            const datePicker = document.getElementById('custom-date-picker');
            const dateInput = document.getElementById('tanggal_lahir');
            const calendarIcon = e.target.closest('[onclick="toggleDatePicker()"]');
            
            if (!datePicker.contains(e.target) && e.target !== dateInput && !calendarIcon) {
                closeDatePicker();
            }
        });
        
        // Handle month/year select changes
        document.getElementById('month-select').addEventListener('change', function() {
            currentMonth = parseInt(this.value);
            renderCalendar();
        });
        
        document.getElementById('year-select').addEventListener('change', function() {
            currentYear = parseInt(this.value);
            renderCalendar();
        });
    });

    function initializeDatePicker() {
        // Populate year select
        const yearSelect = document.getElementById('year-select');
        const currentYearValue = new Date().getFullYear();
        
        for (let year = currentYearValue - 50; year <= currentYearValue + 10; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            if (year === currentYearValue) {
                option.selected = true;
            }
            yearSelect.appendChild(option);
        }
        
        // Set initial month
        document.getElementById('month-select').value = currentMonth;
        
        renderCalendar();
    }

    function toggleDatePicker() {
        const datePicker = document.getElementById('custom-date-picker');
        
        if (datePicker.classList.contains('hidden')) {
            datePicker.classList.remove('hidden');
            renderCalendar();
        } else {
            datePicker.classList.add('hidden');
        }
    }

    function closeDatePicker() {
        document.getElementById('custom-date-picker').classList.add('hidden');
    }

    function changeMonth(direction) {
        currentMonth += direction;
        
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        } else if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        
        document.getElementById('month-select').value = currentMonth;
        document.getElementById('year-select').value = currentYear;
        renderCalendar();
    }

    function renderCalendar() {
        const calendarDays = document.getElementById('calendar-days');
        calendarDays.innerHTML = '';
        
        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
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
            
            const cellDate = new Date(currentYear, currentMonth, day);
            
            // Highlight today
            if (cellDate.toDateString() === today.toDateString()) {
                dayCell.classList.add('bg-blue-100', 'text-blue-600');
            }
            
            // Highlight selected date
            if (selectedDate && cellDate.toDateString() === selectedDate.toDateString()) {
                dayCell.classList.add('bg-teal-500', 'text-white');
                dayCell.classList.remove('hover:bg-gray-100');
            }
            
            dayCell.addEventListener('click', function() {
                // Remove previous selection
                document.querySelectorAll('#calendar-days .bg-teal-500').forEach(el => {
                    el.classList.remove('bg-teal-500', 'text-white');
                    el.classList.add('hover:bg-gray-100');
                });
                
                // Add selection to clicked day
                this.classList.add('bg-teal-500', 'text-white');
                this.classList.remove('hover:bg-gray-100');
                
                selectedDate = new Date(currentYear, currentMonth, day);
            });
            
            calendarDays.appendChild(dayCell);
        }
    }

    function applySelectedDate() {
        if (selectedDate) {
            const day = String(selectedDate.getDate()).padStart(2, '0');
            const month = String(selectedDate.getMonth() + 1).padStart(2, '0');
            const year = selectedDate.getFullYear();
            
            document.getElementById('tanggal_lahir').value = `${day}/${month}/${year}`;
        }
        closeDatePicker();
    }

    // Handle file upload preview (updated version)
    document.getElementById('foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const fileNameSpan = document.getElementById('file-name');
        const photoPreview = document.getElementById('photo-preview');
        
        if (file) {
            // Update file name display
            fileNameSpan.textContent = file.name;
            fileNameSpan.classList.remove('text-gray-500');
            fileNameSpan.classList.add('text-gray-700', 'font-medium');
            
            // Check file type
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover rounded-full">`;
                };
                reader.readAsDataURL(file);
            } else {
                // If not an image, show file icon
                photoPreview.innerHTML = `
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                `;
            }
        } else {
            // Reset to default state
            fileNameSpan.textContent = 'File belum dipilih';
            fileNameSpan.classList.remove('text-gray-700', 'font-medium');
            fileNameSpan.classList.add('text-gray-500');
            
            photoPreview.innerHTML = `
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            `;
        }
    });

    // Handle province change for city/regency dropdown
    document.getElementById('provinsi').addEventListener('change', function() {
        const kotaSelect = document.getElementById('kota_kabupaten');
        const provinsi = this.value;
        
        // Clear existing options
        kotaSelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
        
        // Sample data
        const kotaData = {
            'DI Yogyakarta': ['Kota Yogyakarta', 'Kabupaten Bantul', 'Kabupaten Sleman', 'Kabupaten Kulon Progo', 'Kabupaten Gunung Kidul'],
            'DKI Jakarta': ['Jakarta Pusat', 'Jakarta Utara', 'Jakarta Selatan', 'Jakarta Timur', 'Jakarta Barat', 'Kepulauan Seribu'],
            'Jawa Barat': ['Kota Bandung', 'Kota Bekasi', 'Kota Bogor', 'Kota Depok', 'Kota Cimahi', 'Kabupaten Bandung', 'Kabupaten Bogor'],
            'Jawa Tengah': ['Kota Semarang', 'Kota Surakarta', 'Kota Magelang', 'Kabupaten Semarang', 'Kabupaten Boyolali'],
            'Jawa Timur': ['Kota Surabaya', 'Kota Malang', 'Kota Kediri', 'Kabupaten Sidoarjo', 'Kabupaten Gresik'],
            'Banten': ['Kota Tangerang', 'Kota Tangerang Selatan', 'Kota Cilegon', 'Kota Serang', 'Kabupaten Tangerang'],
            'Bali': ['Kota Denpasar', 'Kabupaten Badung', 'Kabupaten Gianyar', 'Kabupaten Tabanan', 'Kabupaten Klungkung']
        };
        
        if (kotaData[provinsi]) {
            kotaData[provinsi].forEach(kota => {
                const option = document.createElement('option');
                option.value = kota;
                option.textContent = kota;
                kotaSelect.appendChild(option);
            });
        }
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const requiredFields = ['nama_lengkap', 'nik', 'provinsi', 'kota_kabupaten'];
        let isValid = true;
        let errorMessage = '';
        
        // Check text inputs
        requiredFields.forEach(field => {
            const element = document.getElementById(field);
            if (!element || !element.value.trim()) {
                isValid = false;
                errorMessage += `- ${field.replace('_', ' ').toUpperCase()} wajib diisi\n`;
            }
        });
        
        // Check radio button for jenis kelamin
        const jenisKelamin = document.querySelector('input[name="jenis_kelamin"]:checked');
        if (!jenisKelamin) {
            isValid = false;
            errorMessage += '- JENIS KELAMIN wajib dipilih\n';
        }
        
        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi field berikut:\n\n' + errorMessage);
        }
    });
</script>
@endpush
@endsection