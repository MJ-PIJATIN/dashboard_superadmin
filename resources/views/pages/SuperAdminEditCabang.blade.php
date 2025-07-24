@extends('layouts.app')

@section('content')
  <div class="ml-64 px-6 pt-28 pb-10 space-y-6">

    {{-- Header --}}
    <div class="flex justify-between items-center">
    <div class="flex items-center gap-3">
      <a  href="{{ route('cabang.detail', ['id' => request()->route('id')]) }}">
      <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
        d="M9.47915 16.9798C9.0833 16.98 8.70301 16.8257 8.41915 16.5498L1.41915 9.54983C0.834242 8.96419 0.834242 8.01546 1.41915 7.42983L8.41915 0.429828C8.79964 0.0511261 9.35326 -0.0958207 9.87147 0.0443407C10.3897 0.184502 10.7937 0.590478 10.9315 1.10934C11.0692 1.6282 10.9196 2.18113 10.5391 2.55983L6.1067 6.99976H17.519C18.3475 6.99976 19.019 7.67133 19.019 8.49976C19.019 9.32818 18.3475 9.99976 17.519 9.99976H6.11161L10.5391 14.4198C10.9676 14.8488 11.0957 15.4935 10.8637 16.0537C10.6318 16.6138 10.0854 16.9793 9.47915 16.9798Z"
        fill="#454545" />
      </svg>
      </a>
      <h2 class="text-2xl font-semibold text-gray-800">Edit Cabang</h2>
    </div>

    <div class="w-[160px] h-10"></div>
    </div>

    {{-- Form Edit Cabang --}}
    <div class="max-w-xl">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Cabang</h2>

    <form action="#" method="POST" class="space-y-5">
      @csrf

      <div>
      <label for="provinsi" class="block text-base font-semibold text-gray-700 mb-1">Provinsi Cabang</label>
      <input type="text" id="provinsi" name="provinsi" maxlength="50"
        class="w-full px-4 py-2 border border-gray-600 rounded-md" placeholder="Daerah Istimewa Yogyakarta">
      </div>

      <div>
      <label for="kota" class="block text-base font-semibold text-gray-700 mb-1">Kota Cabang</label>
      <input type="text" id="kota" name="kota" maxlength="50"
        class="w-full px-4 py-2 border border-gray-600 rounded-md" placeholder="Yogyakarta">
      </div>

      <div>
      <label for="lokasi" class="block text-base font-semibold text-gray-700 mb-1">Detail Lokasi Cabang</label>
      <select id="lokasi" name="lokasi" class="w-full px-4 py-2 border border-gray-600 rounded-md bg-white">
        <option value="">Pilih lokasi cabang</option>
        <option value="Jl. Pahlawan, Kledungsari, No. 32, Yogyakarta">
        Jl. Pahlawan, Kledungsari, No. 32, Yogyakarta
        </option>
        <option value="Jl. Kaliurang KM 6, Sleman">Jl. Kaliurang KM 6, Sleman</option>
      </select>
      </div>

      <div>
      <label for="email" class="block text-base font-semibold text-gray-700 mb-1">Email Cabang</label>
      <select id="email" name="email" class="w-full px-4 py-2 border border-gray-600 rounded-md bg-white">
        <option value="">Pilih email cabang</option>
        <option value="pijatinjogja@gmail.com">pijatinjogja@gmail.com</option>
        <option value="admin@pijatin.com">admin@pijatin.com</option>
      </select>
      </div>

      <div>
      <label for="deskripsi" class="block text-base font-semibold text-gray-700 mb-1">Deskripsi</label>
      <textarea id="deskripsi" name="deskripsi" rows="4" maxlength="512"
        class="w-full px-4 py-2 border border-gray-600 rounded-md"
        placeholder="Penulisan dibatasi hingga 512 karakter"></textarea>
      </div>

      <div class="pt-2">
      <button type="submit"
        class="bg-teal-500 hover:bg-teal-600 text-white px-5 py-2 rounded-md text-base font-medium shadow">
        Tambahkan
      </button>
      </div>
    </form>
    </div>
  </div>
@endsection