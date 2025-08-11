<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
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
