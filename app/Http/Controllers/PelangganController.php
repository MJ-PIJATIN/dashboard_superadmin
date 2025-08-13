<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $customers = Pelanggan::paginate(10);
        return view('pages.SuperAdminPelanggan', compact('customers'));
    }

    public function search(Request $request)
    {
        $filter = $request->input('filter');
        $customers = Pelanggan::where('nama', 'like', "%{$filter}%")
            ->orWhere('email', 'like', "%{$filter}%")
            ->orWhere('kota', 'like', "%{$filter}%")
            ->paginate(10);

        return response()->json($customers);
    }

    public function toggleStatus($id)
    {
        $customer = Pelanggan::findOrFail($id);
        $customer->status = $customer->status === 'Aktif' ? 'Belum aktif' : 'Aktif';
        $customer->save();

        return redirect()->route('pelanggan');
    }

    public function show($id)
    {
        $customer = Pelanggan::findOrFail($id);
        return view('pages.SuperAdminPelangganDetailAkun', compact('customer'));
    }


}
