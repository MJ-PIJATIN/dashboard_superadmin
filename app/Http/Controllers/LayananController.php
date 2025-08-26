<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananUtama;
use App\Models\LayananTambahan;

class LayananController extends Controller
{
    public function index()
    {
        $layananUtama = LayananUtama::all();
        $layananTambahan = LayananTambahan::all();
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

        $layanan = LayananUtama::find($request->id);
        if (!$layanan) {
            return response()->json(['success' => false, 'message' => 'Layanan tidak ditemukan.'], 404);
        }

        $layanan->update([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'description' => $request->description,
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

        $layanan = LayananUtama::find($request->id);
        if (!$layanan) {
            return response()->json(['success' => false, 'message' => 'Layanan tidak ditemukan.'], 404);
        }

        $layanan->update([
            'status' => $status,
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

        $layanan = LayananTambahan::find($request->id);
        if (!$layanan) {
            return response()->json(['success' => false, 'message' => 'Layanan tambahan tidak ditemukan.'], 404);
        }

        $layanan->update([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'description' => $request->description,
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

        LayananUtama::create([
            'id' => $id,
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'description' => $request->description,
            'status' => 'aktif',
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

        LayananTambahan::create([
            'id' => $id,
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'description' => $request->description,
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

        $layanan = LayananUtama::find($request->id);

        if ($layanan) {
            $layanan->delete();
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

        $layanan = LayananTambahan::find($request->id);

        if ($layanan) {
            $layanan->delete();
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