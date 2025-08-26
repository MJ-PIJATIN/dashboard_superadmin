<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifications = Notification::with('actor')->latest()->get();
        return view('pages.SuperAdminNotifikasi', compact('notifications'));
    }
}
