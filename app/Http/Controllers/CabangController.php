<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Karyawan;
use App\Models\Terapis;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CabangController extends Controller
{
    public function index()
    {
        $branches = Cabang::paginate(10);
        return view('pages.SuperAdminCabang', compact('branches'));
    }

    public function show($id)
    {
        $branch = Cabang::findOrFail($id);

        // Karyawan
        $pegawaiAdmin = \App\Models\Karyawan::where('branch_id', $id)->where('role', 'admin')->count();
        $pegawaiFinance = \App\Models\Karyawan::where('branch_id', $id)->where('role', 'finance')->count();
        $totalPegawai = $pegawaiAdmin + $pegawaiFinance;

        // Pengguna
        $penggunaTerapis = \App\Models\Terapis::where('branch_id', $id)->count();
        
        // Find customers who have booked a therapist from this branch
        $therapistIds = \App\Models\Terapis::where('branch_id', $id)->pluck('id');
        $penggunaCustomer = \App\Models\Pesanan::whereIn('therapist_id', $therapistIds)->distinct()->count('customer_id');

        $totalPengguna = $penggunaTerapis + $penggunaCustomer;

        return view('pages.SuperAdminDetailCabang', compact(
            'branch',
            'pegawaiAdmin',
            'pegawaiFinance',
            'totalPegawai',
            'penggunaTerapis',
            'penggunaCustomer',
            'totalPengguna'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'province' => 'required|max:50',
            'city' => 'required|max:50',
            'address' => 'required',
            'email' => 'required|email',
            'description' => 'nullable|max:512',
        ]);

        $last = Cabang::selectRaw('MAX(CAST(SUBSTRING(id, 4) AS UNSIGNED)) as last_id')->first();
        $lastId = $last->last_id ?? 0;
        $newId = 'CAB' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

        Cabang::create([
            'id' => $newId,
            'province' => $validated['province'],
            'city' => $validated['city'],
            'address' => $validated['address'],
            'email' => $validated['email'],
            'description' => $validated['description'] ?? null,
            'branch_code' => $newId,
            'status' =>'Aktif',
        ]);

        return redirect()->route('cabang')->with('success', 'Cabang berhasil ditambahkan!');
    }

    public function toggleStatus($id)
    {
        $branch = Cabang::findOrFail($id);
        $branch->status = $branch->status === 'Aktif' ? 'Nonaktif' : 'Aktif';
        $branch->save();

        return redirect()->back()->with('success', 'Status cabang berhasil diperbarui.');
    }

    public function edit($id)
    {
        $branch = Cabang::where('branch_code', $id)->firstOrFail();

        $alamatList = Cabang::select('address')->distinct()->pluck('address');
        $emailList = Cabang::select('email')->distinct()->pluck('email');

        return view('pages.SuperAdminEditCabang', compact('branch', 'alamatList', 'emailList'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'province' => 'required|max:50',
            'city' => 'required|max:50',
            'address' => 'required',
            'email' => 'required|email',
            'description' => 'nullable|max:512',
        ]);

        $branch = Cabang::findOrFail($id);
        $branch->update([
            'province' => $validated['province'],
            'city' => $validated['city'],
            'address' => $validated['address'],
            'email' => $validated['email'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('cabang', ['id' => $id])->with('success', 'Cabang berhasil diperbarui!');
    }

}
