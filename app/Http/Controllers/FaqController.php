<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return view('pages.SuperAdminFAQ', compact('faqs'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
            ], [
                'judul.required' => 'Judul wajib diisi',
                'deskripsi.required' => 'Deskripsi wajib diisi',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $faq = Faq::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ]);

            // Membuat notifikasi
            Notification::create([
                'message' => 'Super admin berhasil membuat pertanyaan baru di halaman FAQ',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'FAQ berhasil ditambahkan',
                'data' => $faq
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Faq $faq)
    {
        try {
            $validator = Validator::make($request->all(), [
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
            ], [
                'judul.required' => 'Judul wajib diisi',
                'deskripsi.required' => 'Deskripsi wajib diisi',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $faq->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ]);

            // Membuat notifikasi
            Notification::create([
                'message' => 'Super admin berhasil mengupdate pertanyaan di halaman FAQ',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'FAQ berhasil diubah',
                'data' => $faq
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Faq $faq)
    {
        try {
            $faq->delete();

            // Membuat notifikasi
            Notification::create([
                'message' => 'Super admin berhasil menghapus pertanyaan di halaman FAQ',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'FAQ berhasil dihapus'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
