@extends('layouts.notifikasi')

@section('navtitle')
    <div class="text-base flex items-center gap-2" style="color: #469D89;">
        <span>Notifikasi</span>
    </div>
@endsection

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="bg-gray-100 ml-[50px] pt-[105px] pb-[100px] pr-[25px] mr-[34px]">
        <div class="space-y-5 px-20">

            @forelse ($notifications as $notification)
                <div class="bg-white rounded-xl px-4 py-3 shadow-md">
                    <div class="text-gray-900 font-semibold text-sm mb-1">
                        {{ $notification->message }}
                    </div>
                    <div class="text-gray-500 text-xs">
                        {{ $notification->created_at->format('d F Y • H:i') }}
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl px-4 py-3 shadow-md text-center">
                    <p class="text-gray-500">Tidak ada notifikasi saat ini.</p>
                </div>
            @endforelse

        </div>
    </div>
</div>
@endsection
