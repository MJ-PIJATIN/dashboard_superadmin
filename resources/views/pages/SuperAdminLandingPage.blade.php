@extends('layouts.login')

@section('content')
    <div class="h-screen w-screen overflow-hidden relative">
        <img src="{{ asset('images/landing page.svg') }}" alt="Landing" class="w-full h-full object-cover">
    </div>

    <script>
        setTimeout(function () {
            window.location.href = "{{ url('/login') }}";
        }, 2000);
    </script>
@endsection
