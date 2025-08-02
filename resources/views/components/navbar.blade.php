<!-- Navbar -->
<nav class="bg-white border-b border-gray-200 fixed top-0 left-64 right-0 z-40 h-20 flex items-center justify-between px-6 shadow-sm">
    <!-- Judul Dinamis -->
    <div class="text-gray-700 text-base font-semibold ml-[26px]">
        @hasSection('navtitle')
            @yield('navtitle')
        @else
            Dashboard <span class="text-[#469D89]">Super Admin</span>
        @endif
    </div>

    <!-- Ikon Notifikasi -->
    <div class="flex items-center space-x-4">
        <!-- Tombol Notifikasi dengan Asset Sendiri dan bg-rounded -->
        <button class="relative p-2 mr-[26px] rounded-full bg-gray-100 hover:bg-gray-200 transition duration-200">
            <img src="{{ asset('images/bel.svg') }}" alt="Notifikasi" class="w-6 h-6">
        </button>
    </div>
</nav>
