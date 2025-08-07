<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CabangController extends Controller
{
    public function index()
    {
        $cabangs = Cabang::paginate(10);
        return view('pages.SuperAdminCabang', compact('cabangs'));
    }

    public function show($id)
    {
        $cabang = Cabang::findOrFail($id);

        // $users = User::where('cabang_id', $id)->get();

        $pegawaiAdmin = 0;
        $pegawaiFinance = 0;
        $totalPegawai = 0;

        $penggunaTerapis = 0;
        $penggunaCustomer = 0;
        $totalPengguna = 0;

        return view('pages.SuperAdminDetailCabang', compact(
            'cabang',
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
        $newId = 'CAB' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);

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
        $cabang = Cabang::findOrFail($id);
        $cabang->status = $cabang->status === 'Aktif' ? 'Nonaktif' : 'Aktif';
        $cabang->save();

        return redirect()->back()->with('success', 'Status cabang berhasil diperbarui.');
    }

    public function edit($id)
    {
        $cabang = Cabang::where('branch_code', $id)->firstOrFail();

        $alamatList = Cabang::select('address')->distinct()->pluck('address');
        $emailList = Cabang::select('email')->distinct()->pluck('email');

        return view('pages.SuperAdminEditCabang', compact('cabang', 'alamatList', 'emailList'));
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

        $cabang = Cabang::findOrFail($id);
        $cabang->update([
            'province' => $validated['province'],
            'city' => $validated['city'],
            'address' => $validated['address'],
            'email' => $validated['email'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('cabang.detail', ['id' => $id])->with('success', 'Cabang berhasil diperbarui!');
    }

}
