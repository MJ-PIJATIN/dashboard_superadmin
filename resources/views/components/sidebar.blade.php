<!-- Sidebar -->
<div class="sidebar bg-teal-500 text-white h-screen w-64 fixed left-0 top-0 overflow-y-auto">
    <!-- Logo Header -->
    <div class="p-4">
        <div class="flex justify-center">
            <img src="{{ asset('images/Logo_Aplikasi.svg') }}" alt="Logo" class="h-20 w-80 mt-1">
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="mt-1">
        <ul class="space-y-0.1 px-2.5">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-teal-400 transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-white text-teal-500' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Layanan -->
            <li>
                <a href="{{ route('layanan') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-teal-400 transition-colors duration-200 {{ request()->routeIs('layanan*') ? 'bg-white text-teal-500' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Layanan</span>
                </a>
            </li>

            <!-- Pesanan -->
            <li>
                <a href="{{ route('pesanan') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-teal-400 transition-colors duration-200 {{ request()->routeIs('pesanan*') ? 'bg-white text-teal-500' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span>Pesanan</span>
                </a>
            </li>

            <!-- Cabang -->
            <li>
                <a href="{{ route('cabang') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-teal-400 transition-colors duration-200 {{ request()->routeIs('cabang*') ? 'bg-white text-teal-500' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Cabang</span>
                </a>
            </li>

            <!-- Karyawan -->
            <li>
                <a href="{{ route('karyawan') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-teal-400 transition-colors duration-200 {{ request()->routeIs('karyawan*') ? 'bg-white text-teal-500' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 01-2 2H10a2 2 0 01-2-2V4m8 0H8m0 0v2a2 2 0 002 2h4a2 2 0 002-2V4m-6 16l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <span>Karyawan</span>
                </a>
            </li>

            <!-- Pelanggan -->
            <li>
                <a href="{{ route('pelanggan') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-teal-400 transition-colors duration-200 {{ request()->routeIs('pelanggan*') ? 'bg-white text-teal-500' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    <span>Pelanggan</span>
                </a>
            </li>

            <!-- Terapis -->
            <li>
                <a href="{{ route('terapis') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-teal-400 transition-colors duration-200 {{ request()->routeIs('terapis*') ? 'bg-white text-teal-500' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>Terapis</span>
                </a>
            </li>

            <!-- Penangguhan -->
            <li>
                <a href="{{ route('penangguhan') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-teal-400 transition-colors duration-200 {{ request()->routeIs('penangguhan*') ? 'bg-white text-teal-500' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span>Penangguhan</span>
                </a>
            </li>

            <!-- Aduan Pelanggan -->
            <li>
                <a href="{{ route('aduan-pelanggan') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-teal-400 transition-colors duration-200 {{ request()->routeIs('aduan-pelanggan*') ? 'bg-white text-teal-500' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span>Aduan Pelanggan</span>
                </a>
            </li>

            <!-- FAQ -->
            <li>
                <a href="{{ route('faq') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-teal-400 transition-colors duration-200 {{ request()->routeIs('faq*') ? 'bg-white text-teal-500' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>FAQ</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Logout Button at Bottom -->
    <div class="absolute bottom-4 w-full px-4">
        <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-teal-400 transition-colors duration-200 w-full">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
            <span>Keluar Akun</span>
        </a>
    </div>
</div>