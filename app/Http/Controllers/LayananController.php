<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\LayananUtama;
use App\Models\LayananTambahan;

class LayananController extends Controller
{
    public function index()
    {
        $layananUtama = \App\Models\LayananUtama::all();
        $layananTambahan = \App\Models\LayananTambahan::all();
        return view('pages.SuperAdminLayanan', compact('layananUtama', 'layananTambahan'));
    }

    public function update(Request $request)
    {
    $request->validate([
        'id' => 'required',
        'name' => 'required|max:50',
        'price' => 'required|numeric',
        'duration' => 'required|in:60 Menit,90 Menit,120 Menit',
        'description' => 'required|max:512',
    ]);

    $layanan = \DB::table('main_services')->where('id', $request->id)->first();
    if (!$layanan) {
        return response()->json(['success' => false, 'message' => 'Layanan tidak ditemukan.'], 404);
    }

    \DB::table('main_services')->where('id', $request->id)->update([
        'name' => $request->name,
        'price' => $request->price,
        'duration' => $request->duration,
        'description' => $request->description,
        'updated_at' => now(),
    ]);

    return response()->json(['success' => true]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required|in:Aktif,Nonaktif,aktif,nonaktif',
        ]);

        $status = strtolower($request->status);

        $layanan = \DB::table('main_services')->where('id', $request->id)->first();
        if (!$layanan) {
            return response()->json(['success' => false, 'message' => 'Layanan tidak ditemukan.'], 404);
        }

        \DB::table('main_services')->where('id', $request->id)->update([
            'status' => $status,
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }

    public function updateTambahan(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|max:50',
            'price' => 'required|numeric',
            'duration' => 'required|in:10 Menit,20 Menit,30 Menit',
            'description' => 'required|max:512',
        ]);

        $layanan = \DB::table('additional_services')->where('id', $request->id)->first();
        if (!$layanan) {
            return response()->json(['success' => false, 'message' => 'Layanan tambahan tidak ditemukan.'], 404);
        }

        \DB::table('additional_services')->where('id', $request->id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'description' => $request->description,
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'price' => 'required|numeric',
            'duration' => 'required|in:60 Menit,90 Menit,120 Menit',
            'description' => 'required|max:512',
        ]);

        $id = $this->generateRandomId(6);

        \DB::table('main_services')->insert([
            'id' => $id,
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'description' => $request->description,
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'id' => $id]);
    }

        public function storeTambahan(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'price' => 'required|numeric',
            'duration' => 'required|in:10 Menit,20 Menit,30 Menit',
            'description' => 'required|max:512',
        ]);

        $id = $this->generateRandomId(6);

        \DB::table('additional_services')->insert([
            'id' => $id,
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'id' => $id]);
    }

    private function generateRandomId($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $deleted = \DB::table('main_services')->where('id', $request->id)->delete();

        if ($deleted) {
            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Layanan tidak ditemukan.'
        ], 404);
    }

        public function destroyTambahan(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $deleted = \DB::table('additional_services')->where('id', $request->id)->delete();

        if ($deleted) {
            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Layanan tidak ditemukan.'
        ], 404);
    }
}