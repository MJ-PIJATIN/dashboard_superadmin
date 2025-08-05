<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SuperAdmin;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.SuperAdminLogin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mengambil data super admin berdasarkan email
        $super_admins = SuperAdmin::where('email', $request->email)->first();

        // Jika super admin ditemukan, bandingkan password secara langsung
        if ($super_admins && $request->password === $super_admins->password) {
            Auth::login($super_admins);
            return redirect()->route('dashboard'); // Redirect ke halaman dashboard
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}