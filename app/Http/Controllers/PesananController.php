<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 10;

        $transfer = Pesanan::with(['customer', 'therapist', 'mainService', 'additionalService'])
            ->where('payment', 'transfer')
            ->orderBy('bookings_date', 'desc') // ganti kalau nama kolommu "booking_date"
            ->paginate($perPage, ['*'], 'transfer_page');

        $cash = Pesanan::with(['customer', 'therapist', 'mainService', 'additionalService'])
            ->where('payment', 'cash')
            ->orderBy('bookings_date', 'desc') // ganti kalau perlu
            ->paginate($perPage, ['*'], 'cash_page');

        return view('pages.SuperAdminPesanan', compact('transfer', 'cash'));
    }
}
