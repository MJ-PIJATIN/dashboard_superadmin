<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->query('role', 'admin'); // Default to admin
        $karyawan = Karyawan::where('role', $role)->paginate(10);
        return view('pages.SuperAdminKaryawan', compact('karyawan', 'role'));
    }

    public function search(Request $request)
    {
        $filter = $request->input('filter');
        $role = $request->input('role', 'admin');

        $karyawan = Karyawan::where('role', $role)
            ->where(function ($query) use ($filter) {
                $query->where('nama', 'like', "%{$filter}%")
                      ->orWhere('kota', 'like', "%{$filter}%")
                      ->orWhere('ponsel', 'like', "%{$filter}%");
            })
            ->paginate(10);

        return response()->json($karyawan);
    }

    // You might need methods for create, store, edit, update, delete later
    // For now, focusing on index and search for pagination
}
