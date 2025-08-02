@extends('layouts.pesanan')
@section('navtitle')
    <div class="text-base text-gray-700 flex items-center gap-2">
        <span>Pesanan</span>
        <span class="text-gray-700 font-semibold">&gt;</span>
        <span class="text-[#469D89] font-semibold">Detail Pesanan</span>
    </div>
@endsection

@section('content')
   <div class="w-full min-h-screen bg-gray-50">
    <div class="ml-[26px] mr-[26px] px-6 pt-[95px] pb-[101px] space-y-6">

            <!-- Heading -->
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <a href="{{ route('pesanan') }}" title="Kembali ke daftar cabang" class="hover:text-gray-800">
                        <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.47915 16.9798C9.0833   16.98 8.70301 16.8257 8.41915 16.5498L1.41915 9.54983C0.834242 8.96419 0.834242 8.01546 1.41915 7.42983L8.41915 0.429828C8.79964 0.0511261 9.35326 -0.0958207 9.87147 0.0443407C10.3897 0.184502 10.7937 0.590478 10.9315 1.10934C11.0692 1.6282 10.9196 2.18113 10.5391 2.55983L6.1067 6.99976H17.519C18.3475 6.99976 19.019 7.67133 19.019 8.49976C19.019 9.32818 18.3475 9.99976 17.519 9.99976H6.11161L10.5391 14.4198C10.9676 14.8488 11.0957 15.4935 10.8637 16.0537C10.6318 16.6138 10.0854 16.9793 9.47915 16.9798Z"
                                fill="#454545" />
                        </svg>
                    </a>
                    <h2 class="text-xl font-bold text-gray-800">Detail Pesanan</h2>
                </div>
                <div class="w-[160px] h-10"></div>
            </div>

            @php
                $isFinalStatus = in_array($pesanan['status'], ['Selesai', 'Dibatalkan']);
            @endphp
            <div class="{{ $isFinalStatus ? 'flex flex-col items-center' : 'grid lg:grid-cols-12 gap-6' }}">

                <div class="{{ $isFinalStatus ? 'w-full max-w-lg' : 'lg:col-span-5' }}">
                    <!-- Dropdown Status -->
                    <div class="flex items-center gap-2 mb-4">
                        <label for="status" class="text-base font-bold text-gray-800 whitespace-nowrap">Ubah status:</label>
                        <select id="status"
                            class="flex-1 border border-gray-300 rounded-xl px-3 py-2 text-sm text-gray-500 focus:outline-none focus:ring-1 focus:ring-teal-400">
                            <option {{ $pesanan['status'] === 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option {{ $pesanan['status'] === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option {{ $pesanan['status'] === 'Dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                            <option {{ $pesanan['status'] === 'Berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                            <option {{ $pesanan['status'] === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option {{ $pesanan['status'] === 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <!-- Card Detail -->
                    <div class="w-full bg-white p-6 rounded-xl shadow-md">
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $pesanan['layanan'] }}</h3>
                        <p class="text-sm font-semibold text-gray-600 mb-4">Pesanan {{ $pesanan['nama'] }}</p>
                        <div class="text-sm text-gray-700 font-semibold mb-4 grid gap-y-1">
                            <div class="py-1 grid grid-cols-[290px_1fr] gap-x-2">
                                <span class="text-green-600">
                                    Harga Layanan {{ $pesanan['layanan'] }} :
                                </span>
                                <span class="text-green-800">
                                    Rp{{ number_format($pesanan['harga'], 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="py-1 grid grid-cols-[290px_1fr] gap-x-2">
                                <span>Jadwal Layanan :</span>
                                <span>{{ $pesanan['jadwal'] ?? '-' }}</span>
                            </div>
                            <div class="py-1 grid grid-cols-[290px_1fr] gap-x-2">
                                <span>Tanggal Pemesanan :</span>
                                <span>{{ $pesanan['tanggal_pemesanan'] ?? ' ' }}</span>
                            </div>
                            <div class="py-1 grid grid-cols-[290px_1fr] gap-x-2 items-start">
                                <span>Alamat Pemesan :</span>
                                <span class="max-w-[280px] text-left">{{ $pesanan['alamat'] ?? ' ' }}</span>
                            </div>
                        </div>

                        <hr class="border-t-4 border-black mt-4 mb-5">

                        <table class="text-sm font-semibold mb-4 w-full">
                            <tbody>
                                <tr>
                                    <td class="py-1 pr-4 text-gray-500 whitespace-nowrap">Nama Customer:</td>
                                    <td class="py-1 text-right text-gray-600 flex justify-end items-center gap-1">
                                        {{ $pesanan['nama'] ?? '-' }}
                                            <div class="flex items-center justify-center w-6 h-6 bg-blue-200 rounded-md">
                                                @if (($pesanan['gender'] ?? '') === 'male')
                                                    <svg width="16" height="16" fill="#2196F3" viewBox="0 0 16 16"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                               d="M10.5865 1.14676C10.5865 0.791723 10.8743 0.503906 11.2294 0.503906H14.6579C15.013 0.503906 15.3008 0.791723 15.3008 1.14676V4.57533C15.3008 4.93038 15.013 5.21819 14.6579 5.21819C14.3029 5.21819 14.0151 4.93038 14.0151 4.57533V2.69483L10.5998 6.0979C11.3955 7.08878 11.8722 8.34824 11.8722 9.71819C11.8722 12.9135 9.28185 15.5039 6.0865 15.5039C2.89113 15.5039 0.300781 12.9135 0.300781 9.71819C0.300781 6.52284 2.89113 3.93248 6.0865 3.93248C7.44815 3.93248 8.70076 4.40349 9.68885 5.19055L13.102 1.78962H11.2294C10.8743 1.78962 10.5865 1.5018 10.5865 1.14676ZM6.0865 5.21819C3.60121 5.21819 1.5865 7.23292 1.5865 9.71819C1.5865 12.2035 3.60121 14.2182 6.0865 14.2182C8.57177 14.2182 10.5865 12.2035 10.5865 9.71819C10.5865 8.47145 10.0804 7.34418 9.26071 6.52849C8.44635 5.718 7.32539 5.21819 6.0865 5.21819Z" />
                                                    </svg>
                                                @elseif (($pesanan['gender'] ?? '') === 'female')
                                                    <svg width="11" height="16" fill="#E6007F" viewBox="0 0 11 16"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0.0078125 5.69621C0.0078125 2.82858 2.33249 0.503906 5.20012 0.503906C8.06775 0.503906 10.3924 2.82858 10.3924 5.69621C10.3924 8.36883 8.37316 10.5698 5.77704 10.8568V12.8116H6.73858C7.05721 12.8116 7.31551 13.0699 7.31551 13.3885C7.31551 13.7071 7.05721 13.9654 6.73858 13.9654H5.77704V14.927C5.77704 15.2456 5.51875 15.5039 5.20012 15.5039C4.88149 15.5039 4.6232 15.2456 4.6232 14.927V13.9654H3.66166C3.34303 13.9654 3.08474 13.7071 3.08474 13.3885C3.08474 13.0699 3.34303 12.8116 3.66166 12.8116H4.6232V10.8568C2.02707 10.5698 0.0078125 8.36883 0.0078125 5.69621ZM5.20012 1.65775C2.96974 1.65775 1.16166 3.46583 1.16166 5.69621C1.16166 7.92659 2.96974 9.73468 5.20012 9.73468C7.43049 9.73468 9.23858 7.92659 9.23858 5.69621C9.23858 3.46583 7.4305 1.65775 5.20012 1.65775Z" />
                                                    </svg>
                                                @endif
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1 pr-4 text-gray-500 whitespace-nowrap">Ponsel Customer:</td>
                                    <td class="py-1 text-right text-gray-600">
                                        {{ $pesanan['ponsel'] ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1 pr-4 text-gray-500 whitespace-nowrap">Nama Terapis:</td>
                                    <td class="py-1 text-right text-gray-600 flex justify-end items-center gap-1">
                                        <span id="terapis-nama"></span>
                                        <div id="terapis-gender-icon"
                                            class="invisible flex items-center justify-center w-6 h-6 bg-blue-200 rounded-md">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1 pr-4 text-gray-500 whitespace-nowrap">Ponsel Terapis:</td>
                                    <td class="py-1 text-right text-gray-600" id="terapis-ponsel"></td>
                                </tr>
                                <tr>
                                    <td class="py-1 align-top text-gray-500">Layanan Tambahan:</td>
                                    <td class="py-1 text-right text-gray-600">
                                        <ul class="space-y-1">
                                            @foreach($pesanan['layanan_tambahan'] ?? [] as $tambahan)
                                                <li>{{ $tambahan }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1 pr-4 text-gray-500 whitespace-nowrap">Harga Layanan:</td>
                                    <td class="py-1 text-right text-gray-600">
                                        Rp{{ number_format($pesanan['harga'], 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td class="py-1 pr-4 text-gray-500 whitespace-nowrap">Durasi:</td>
                                    <td class="py-1 text-right text-gray-600">{{ $pesanan['durasi'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-1 pr-4 text-gray-500 whitespace-nowrap">Total Biaya Layanan:</td>
                                    <td class="py-1 text-right text-gray-600">
                                        Rp{{ number_format($pesanan['total_layanan'], 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div
                                            class="flex justify-between items-center text-sm font-semibold text-gray-700 mt-6">
                                            <div class="flex gap-1">
                                                <span>Metode:</span>
                                                <span>{{ $pesanan['metode'] }}</span>
                                            </div>
                                            <div class="flex gap-1 text-lg font-bold">
                                                <span>Total Harga:</span>
                                                <span class="text-green-800">
                                                    Rp{{ number_format($pesanan['total_harga'] ?? 0, 2, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <hr class="border-t-4 border-black mt-4 mb-5">

                        @php
                            $statusClass = match ($pesanan['status']) {
                                'Menunggu' => 'text-teal-400',
                                'Selesai' => 'text-teal-400',
                                'Dibatalkan' => 'text-red-600',
                                'Pending' => 'text-gray-300',
                                'Dijadwalkan' => 'text-teal-400',
                                'Berlangsung' => 'text-yellow-700',
                                default => 'text-teal-400',
                            };
                        @endphp
                        <div class="text-2xl font-bold text-right {{ $statusClass }}">
                            {{ ucfirst($pesanan['status']) }}
                        </div>
                    </div>
                </div>

                <!-- Card Daftar Terapis -->
                @if (!in_array($pesanan['status'], ['Selesai', 'Dibatalkan']))
                        <div class="lg:col-span-7">
                            <div class="w-full bg-white p-6 rounded-xl shadow-md mt-[-1.25rem]">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Daftar Terapis Sekitar</h3>

                                <!-- Search Bar -->
                                <div class="w-full mb-4">
                                    <div class="flex w-full">
                                        <input type="text"
                                            class="flex-grow px-4 py-2 rounded-l-lg bg-gray-100 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-teal-400 placeholder:text-gray-400"
                                            placeholder="Cari terapis...">
                                        <button class="bg-teal-400 hover:bg-teal-500 text-white px-4 py-2 rounded-r-lg">
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8 0.75C12.0041 0.75 15.25 3.99594 15.25 8C15.25 9.7319 14.6427 11.3219 13.6295 12.5688L18.5303 17.4697C18.8232 17.7626 18.8232 18.2374 18.5303 18.5303C18.2641 18.7966 17.8474 18.8208 17.5538 18.6029L17.4697 18.5303L12.5688 13.6295C11.3219 14.6427 9.7319 15.25 8 15.25C3.99594 15.25 0.75 12.0041 0.75 8C0.75 3.99594 3.99594 0.75 8 0.75ZM8 2.25C4.82436 2.25 2.25 4.82436 2.25 8C2.25 11.1756 4.82436 13.75 8 13.75C11.1756 13.75 13.75 11.1756 13.75 8C13.75 4.82436 11.1756 2.25 8 2.25Z"
                                                    fill="white" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- List Terapis -->
                                <div
                                    class="max-h-[520px] overflow-y-auto pr-1 scrollbar-thin scrollbar-thumb-teal-400 scrollbar-track-gray-100 space-y-2 max-w-[680px] mx-auto">
                                    @foreach($terapisList as $index => $terapis)
                                        <div
                                            class="flex items-center justify-between px-4 py-2 {{ $index % 2 === 1 ? 'bg-teal-100' : 'bg-white' }}">
                                            <div class="flex items-center gap-2 text-sm text-gray-800 font-medium">
                                                <div class="flex items-center justify-center w-6 h-6 bg-blue-200 rounded-md">
                                                    @if ($terapis['gender'] === 'male')
                                                        <svg width="16" height="16" fill="#2196F3" viewBox="0 0 16 16"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M10.5865 1.14676C10.5865 0.791723 10.8743 0.503906 11.2294 0.503906H14.6579C15.013 0.503906 15.3008 0.791723 15.3008 1.14676V4.57533C15.3008 4.93038 15.013 5.21819 14.6579 5.21819C14.3029 5.21819 14.0151 4.93038 14.0151 4.57533V2.69483L10.5998 6.0979C11.3955 7.08878 11.8722 8.34824 11.8722 9.71819C11.8722 12.9135 9.28185 15.5039 6.0865 15.5039C2.89113 15.5039 0.300781 12.9135 0.300781 9.71819C0.300781 6.52284 2.89113 3.93248 6.0865 3.93248C7.44815 3.93248 8.70076 4.40349 9.68885 5.19055L13.102 1.78962H11.2294C10.8743 1.78962 10.5865 1.5018 10.5865 1.14676ZM6.0865 5.21819C3.60121 5.21819 1.5865 7.23292 1.5865 9.71819C1.5865 12.2035 3.60121 14.2182 6.0865 14.2182C8.57177 14.2182 10.5865 12.2035 10.5865 9.71819C10.5865 8.47145 10.0804 7.34418 9.26071 6.52849C8.44635 5.718 7.32539 5.21819 6.0865 5.21819Z" />
                                                        </svg>
                                                    @else
                                                        <svg width="11" height="16" fill="#E6007F" viewBox="0 0 11 16"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M0.0078125 5.69621C0.0078125 2.82858 2.33249 0.503906 5.20012 0.503906C8.06775 0.503906 10.3924 2.82858 10.3924 5.69621C10.3924 8.36883 8.37316 10.5698 5.77704 10.8568V12.8116H6.73858C7.05721 12.8116 7.31551 13.0699 7.31551 13.3885C7.31551 13.7071 7.05721 13.9654 6.73858 13.9654H5.77704V14.927C5.77704 15.2456 5.51875 15.5039 5.20012 15.5039C4.88149 15.5039 4.6232 15.2456 4.6232 14.927V13.9654H3.66166C3.34303 13.9654 3.08474 13.7071 3.08474 13.3885C3.08474 13.0699 3.34303 12.8116 3.66166 12.8116H4.6232V10.8568C2.02707 10.5698 0.0078125 8.36883 0.0078125 5.69621ZM5.20012 1.65775C2.96974 1.65775 1.16166 3.46583 1.16166 5.69621C1.16166 7.92659 2.96974 9.73468 5.20012 9.73468C7.43049 9.73468 9.23858 7.92659 9.23858 5.69621C9.23858 3.46583 7.4305 1.65775 5.20012 1.65775Z" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                {{ $terapis['nama_terapis'] }}
                                            </div>
                                            <button
                                                class="tugaskan-btn bg-teal-400 hover:bg-teal-500 text-white px-4 py-1 rounded-md text-xs font-semibold shadow-sm"
                                                data-nama="{{ $terapis['nama_terapis'] }}"
                                                data-ponsel="{{ $terapis['ponsel_terapis'] }}" data-gender="{{ $terapis['gender'] }}">
                                                Tugaskan
                                            </button>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.tugaskan-btn');

            buttons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const nama = this.dataset.nama;
                    const ponsel = this.dataset.ponsel;
                    const gender = this.dataset.gender;

                    const namaEl = document.getElementById('terapis-nama');
                    const ponselEl = document.getElementById('terapis-ponsel');
                    const genderIcon = document.getElementById('terapis-gender-icon');

                    if (namaEl && ponselEl && genderIcon) {
                        namaEl.textContent = nama;
                        ponselEl.textContent = ponsel;

                        genderIcon.classList.remove('invisible');

                        if (gender === 'male') {
                            genderIcon.innerHTML = `
                                <svg width="16" height="16" fill="#2196F3" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.5865 1.14676C10.5865 0.791723 10.8743 0.503906 11.2294 0.503906H14.6579C15.013 0.503906 15.3008 0.791723 15.3008 1.14676V4.57533C15.3008 4.93038 15.013 5.21819 14.6579 5.21819C14.3029 5.21819 14.0151 4.93038 14.0151 4.57533V2.69483L10.5998 6.0979C11.3955 7.08878 11.8722 8.34824 11.8722 9.71819C11.8722 12.9135 9.28185 15.5039 6.0865 15.5039C2.89113 15.5039 0.300781 12.9135 0.300781 9.71819C0.300781 6.52284 2.89113 3.93248 6.0865 3.93248C7.44815 3.93248 8.70076 4.40349 9.68885 5.19055L13.102 1.78962H11.2294C10.8743 1.78962 10.5865 1.5018 10.5865 1.14676ZM6.0865 5.21819C3.60121 5.21819 1.5865 7.23292 1.5865 9.71819C1.5865 12.2035 3.60121 14.2182 6.0865 14.2182C8.57177 14.2182 10.5865 12.2035 10.5865 9.71819C10.5865 8.47145 10.0804 7.34418 9.26071 6.52849C8.44635 5.718 7.32539 5.21819 6.0865 5.21819Z" />
                                </svg>`;
                        } else if (gender === 'female') {
                            genderIcon.innerHTML = `
                                <svg width="11" height="16" fill="#E6007F" viewBox="0 0 11 16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.0078125 5.69621C0.0078125 2.82858 2.33249 0.503906 5.20012 0.503906C8.06775 0.503906 10.3924 2.82858 10.3924 5.69621C10.3924 8.36883 8.37316 10.5698 5.77704 10.8568V12.8116H6.73858C7.05721 12.8116 7.31551 13.0699 7.31551 13.3885C7.31551 13.7071 7.05721 13.9654 6.73858 13.9654H5.77704V14.927C5.77704 15.2456 5.51875 15.5039 5.20012 15.5039C4.88149 15.5039 4.6232 15.2456 4.6232 14.927V13.9654H3.66166C3.34303 13.9654 3.08474 13.7071 3.08474 13.3885C3.08474 13.0699 3.34303 12.8116 3.66166 12.8116H4.6232V10.8568C2.02707 10.5698 0.0078125 8.36883 0.0078125 5.69621ZM5.20012 1.65775C2.96974 1.65775 1.16166 3.46583 1.16166 5.69621C1.16166 7.92659 2.96974 9.73468 5.20012 9.73468C7.43049 9.73468 9.23858 7.92659 9.23858 5.69621C9.23858 3.46583 7.4305 1.65775 5.20012 1.65775Z" />
                                </svg>`;
                        } else {
                            genderIcon.innerHTML = '';
                        }
                    }
                });
            });
        });
    </script>

@endsection