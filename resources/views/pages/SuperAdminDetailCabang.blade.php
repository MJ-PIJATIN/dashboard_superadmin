@extends('layouts.cabang')

@section('navtitle')
  <div class="text-base text-gray-700 flex items-center gap-2">
    <span>Cabang</span>
    <span class="text-gray-700 font-semibold">&gt;</span>
    <span class="text-[#469D89] font-semibold">Detail Cabang</span>
  </div>
@endsection

@section('content')
  <div class="ml-[26px] mr-[26px] px-6 pt-[96px] pb-[103px] space-y-6">

    {{-- Header --}}
    <div class="flex justify-between items-center">
      <div class="flex items-center gap-3">
        <a href="{{ route('cabang') }}" title="Kembali ke daftar cabang" class="hover:text-gray-800">
          <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M9.47915 16.9798C9.0833 16.98 8.70301 16.8257 8.41915 16.5498L1.41915 9.54983C0.834242 8.96419 0.834242 8.01546 1.41915 7.42983L8.41915 0.429828C8.79964 0.0511261 9.35326 -0.0958207 9.87147 0.0443407C10.3897 0.184502 10.7937 0.590478 10.9315 1.10934C11.0692 1.6282 10.9196 2.18113 10.5391 2.55983L6.1067 6.99976H17.519C18.3475 6.99976 19.019 7.67133 19.019 8.49976C19.019 9.32818 18.3475 9.99976 17.519 9.99976H6.11161L10.5391 14.4198C10.9676 14.8488 11.0957 15.4935 10.8637 16.0537C10.6318 16.6138 10.0854 16.9793 9.47915 16.9798Z"
              fill="#454545" />
          </svg>
        </a>
        <h2 class="text-xl font-bold text-gray-700">Detail Cabang</h2>
      </div>

      <a href="{{ route('cabang.edit', ['id' => $cabang->branch_code]) }}"
         class="flex items-center gap-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold rounded-lg shadow">
        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M9.0013 0.166016C13.6036 0.166016 17.3346 3.89697 17.3346 8.49935C17.3346 13.1017 13.6036 16.8327 9.0013 16.8327C4.39893 16.8327 0.667969 13.1017 0.667969 8.49935C0.667969 3.89697 4.39893 0.166016 9.0013 0.166016ZM9.0013 4.33268C8.68489 4.33268 8.42339 4.56781 8.38197 4.87287L8.3763 4.95768V7.87435H5.45964C5.11446 7.87435 4.83464 8.15418 4.83464 8.49935C4.83464 8.81577 5.06976 9.07727 5.37483 9.11868L5.45964 9.12435H8.3763V12.041C8.3763 12.3862 8.65614 12.666 9.0013 12.666C9.31772 12.666 9.57922 12.4308 9.62064 12.1258L9.6263 12.041V9.12435H12.543C12.8881 9.12435 13.168 8.84452 13.168 8.49935C13.168 8.18293 12.9328 7.92143 12.6278 7.88002L12.543 7.87435H9.6263V4.95768C9.6263 4.61251 9.34647 4.33268 9.0013 4.33268Z"
            fill="white" />
        </svg>
        Edit Cabang
      </a>
    </div>

    {{-- Kota dan Status --}}
    <div>
      <h3 class="text-xl font-semibold text-[#469D89] mt-10">Kota {{ ucfirst($cabang->city) }}</h3>
      <p class="text-base font-regular text-gray-600 mt-1">
        Status Cabang:
        <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-400 text-base font-semibold px-3 py-1 rounded-[4px]">
          <span class="w-2 h-2 rounded-full {{ $cabang->status === 'Aktif' ? 'bg-gray-400' : 'bg-gray-400' }}"></span>
          {{ $cabang->status }}
        </span>
      </p>
    </div>

    {{-- Informasi Cabang --}}
    <div class="border border-gray-300 rounded-lg p-6 mt-6">
      <h4 class="text-xl font-semibold text-gray-700 mb-6">Informasi Cabang</h4>

      <div class="space-y-5 text-sm text-gray-700 max-w-2xl">
        <div>
          <p class="text-xs text-gray-500">ID Cabang</p>
          <p class="text-base font-bold">{{ $cabang->branch_code }}</p>
        </div>
        <div>
          <p class="text-xs text-gray-500">Jumlah Total Pegawai</p>
          <p class="text-base font-bold">{{ $totalPegawai }} Pegawai</p>
        </div>
        <div>
          <p class="text-xs text-gray-500">Jumlah Pegawai Admin</p>
          <p class="text-base font-bold">{{ $pegawaiAdmin }} Pegawai Admin</p>
        </div>
        <div>
          <p class="text-xs text-gray-500">Jumlah Pegawai Finance</p>
          <p class="text-base font-bold">{{ $pegawaiFinance }} Pegawai Finance</p>
        </div>
        <div>
          <p class="text-xs text-gray-500">Jumlah Total Pengguna</p>
          <p class="text-base font-bold">{{ $totalPengguna }} Pengguna</p>
        </div>
        <div>
          <p class="text-xs text-gray-500">Jumlah Pengguna Terapis</p>
          <p class="text-base font-bold">{{ $penggunaTerapis }} Terapis</p>
        </div>
        <div>
          <p class="text-xs text-gray-500">Jumlah Pengguna Customer</p>
          <p class="text-base font-bold">{{ $penggunaCustomer }} Customer</p>
        </div>
        <div>
          <p class="text-xs text-gray-500">Lokasi Cabang</p>
          <p class="text-base font-bold leading-relaxed">
            {{ $cabang->address }}
          </p>
        </div>
      </div>
    </div>

  </div>
@endsection
