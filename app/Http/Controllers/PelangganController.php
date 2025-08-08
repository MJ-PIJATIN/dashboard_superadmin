<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $data = Pelanggan::paginate(10);
        return view('pages.SuperAdminPelanggan', compact('data'));
    }

    public function search(Request $request)
    {
        $filter = $request->input('filter');
        $data = Pelanggan::where('nama', 'like', "%{$filter}%")
            ->orWhere('email', 'like', "%{$filter}%")
            ->orWhere('kota', 'like', "%{$filter}%")
            ->paginate(10);

        return response()->json($data);
    }

    public function toggleStatus($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->status = $pelanggan->status === 'Aktif' ? 'Belum aktif' : 'Aktif';
        $pelanggan->save();

        return redirect()->route('pelanggan');
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pages.SuperAdminPelangganDetailAkun', compact('pelanggan'));
    }
}
