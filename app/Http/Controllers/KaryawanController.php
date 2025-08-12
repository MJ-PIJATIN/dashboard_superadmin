<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
    $role = $request->query('role'); 

    $query = Karyawan::query();

    if ($role) {
        $query->where('role', strtolower($role)); // lowercase biar konsisten
    }

    $karyawan = $query->paginate(10);

    return view('pages.SuperAdminKaryawan', compact('karyawan', 'role'));

        $adminEmployees = Karyawan::where('role', 'admin')->paginate(10, ['*'], 'admin_page');
        $financeEmployees = Karyawan::where('role', 'finance')->paginate(10, ['*'], 'finance_page');
        return view('pages.SuperAdminKaryawan', compact('adminEmployees', 'financeEmployees'));
    }

    public function search(Request $request)
    {
        $filter = $request->input('filter');
        $role = $request->input('role', 'admin');

        $employees = Karyawan::where('role', $role)
            ->where(function ($query) use ($filter) {
                $query->where('first_name', 'like', "%{$filter}%")
                      ->orWhere('last_name', 'like', "%{$filter}%")
                      ->orWhere('phone', 'like', "%{$filter}%");
            })
            ->paginate(10);

        return response()->json($employees);
    }


        public function store(Request $request)
    {
        // Validasi data dan simpan hasilnya di $validated
        $validated = $request->validate([
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'ponsel' => 'nullable|string|max:15',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'role' => 'required|in:admin,finance',
            'password' => 'required|confirmed|min:6',
        ]);

        // Simpan foto kalau ada
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('karyawan_foto', 'public');
        }

        // Enkripsi password
        $validated['password'] = bcrypt($validated['password']);

        // Simpan data ke database
        Karyawan::create($validated);

        return redirect()->route('karyawan')->with('success', 'Karyawan berhasil ditambahkan');
    }

        public function show($id) //yang ini show Deatil AKun Admin
    {
        // Ambil data karyawan
        $karyawan = Karyawan::findOrFail($id);

        return view('pages.SuperAdminKaryawanDetailAkun', compact('karyawan'));
    }

        public function showFinance($id) // Show detail akun finance
    {
        $karyawan = Karyawan::whereRaw('LOWER(role) = ?', ['finance'])
            ->where('id', $id)
            ->firstOrFail();

        return view('pages.SuperAdminKaryawanDetailAkunFinance', compact('karyawan'));
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return response()->json(['success' => true]);
    }


    // You might need methods for create, store, edit, update, delete later
    // For now, focusing on index and search for pagination

    public function show($id)
    {
        $employee = Karyawan::findOrFail($id);
        return view('pages.SuperAdminKaryawanDetailAkun', compact('employee'));
    }

    public function showFinance($id)
    {
        $employee = Karyawan::findOrFail($id);
        return view('pages.SuperAdminKaryawanDetailAkunFinance', compact('employee'));
    }
}
