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
    <!-- Tombol Notifikasi -->
    <a href="{{ route('notifikasi') }}"
       class="relative p-2 mr-[26px] rounded-full transition duration-200
              @if(request()->routeIs('notifikasi'))
                  bg-[#469D89]/65
              @else
                  bg-gray-100 hover:bg-gray-200
              @endif">
        <img src="{{ asset('images/bel.svg') }}" 
             alt="Notifikasi" 
             class="w-6 h-6
                    @if(request()->routeIs('notifikasi'))
                        brightness-0 invert
                    @endif">
    </a>
</div>
</nav>