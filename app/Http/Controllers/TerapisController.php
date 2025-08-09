<?php

namespace App\Http\Controllers;

use App\Models\Terapis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class TerapisController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $perPage = 10;
        
        $query = Terapis::query();
        
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', '%' . $search . '%')
                  ->orWhere('name', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%')
                  ->orWhere('addres', 'like', '%' . $search . '%')
                  ->orWhere('NIK', 'like', '%' . $search . '%');
            });
        }
        
        $terapis = $query->orderBy('joining_date', 'desc')
                        ->paginate($perPage);
        
        $terapis->getCollection()->transform(function ($item) {
            $item->formatted_joining_date = $item->joining_date ? 
                $item->joining_date->format('d M Y') : '-';
            
            $item->formatted_gender = $item->getGenderDisplayAttribute();
            
            $addressParts = explode(', ', $item->addres);
            $item->area_kerja = isset($addressParts[1]) ? $addressParts[1] : 
                               (isset($addressParts[0]) ? $addressParts[0] : '-');
            
            return $item;
        });
        
        return view('pages.SuperAdminTerapis', compact('terapis', 'search'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:255|unique:therapists,NIK',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date_format:d/m/Y',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string|max:500',
            'email' => 'required|email|max:255',
            'no_ponsel' => 'required|string|max:15',
            'provinsi' => 'required|string|max:255',
            'kota_kabupaten' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'nik.required' => 'NIK wajib diisi',
            'nik.unique' => 'NIK sudah terdaftar',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.date_format' => 'Format tanggal lahir harus DD/MM/YYYY',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'alamat.required' => 'Alamat wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'no_ponsel.required' => 'Nomor ponsel wajib diisi',
            'provinsi.required' => 'Provinsi wajib dipilih',
            'kota_kabupaten.required' => 'Kota/Kabupaten wajib dipilih',
            'foto.required' => 'Foto wajib diunggah',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus jpeg, png, jpg, gif, atau webp',
            'foto.max' => 'Ukuran foto maksimal 5MB',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $randomId = $this->generateRandomId();
            
            $photoPath = null;
            if ($request->hasFile('foto')) {
                $photoPath = $this->handlePhotoUpload($request->file('foto'), $request->nama_lengkap);
            }

            $birthDate = null;
            if ($request->tanggal_lahir) {
                $birthDate = \DateTime::createFromFormat('d/m/Y', $request->tanggal_lahir);
                if ($birthDate) {
                    $birthDate = $birthDate->format('Y-m-d');
                }
            }

            $genderValue = $this->processGenderValue($request->jenis_kelamin);

            $terapis = new Terapis();
            $terapis->id = $randomId;
            $terapis->branch_id = null;
            $terapis->name = $request->nama_lengkap;
            $terapis->joining_date = now()->format('Y-m-d');
            $terapis->birth_date = $birthDate;
            $terapis->gender = $genderValue;
            $terapis->phone = $request->no_ponsel;
            $terapis->photo = $photoPath;
            $terapis->email = $request->email;
            $terapis->NIK = $request->nik;
            $terapis->addres = $request->alamat . ', ' . $request->kota_kabupaten . ', ' . $request->provinsi;
            $terapis->save();

            // Format data untuk response
            $addressParts = explode(', ', $terapis->addres);
            $area_kerja = isset($addressParts[1]) ? $addressParts[1] : 
                         (isset($addressParts[0]) ? $addressParts[0] : '-');

            return response()->json([
                'success' => true,
                'message' => 'Data terapis berhasil ditambahkan',
                'id' => $terapis->id,
                'data' => [
                    'id' => $terapis->id,
                    'name' => $terapis->name,
                    'phone' => $terapis->phone,
                    'email' => $terapis->email,
                    'formatted_joining_date' => $terapis->joining_date ? 
                        \Carbon\Carbon::parse($terapis->joining_date)->format('d M Y') : '-',
                    'formatted_gender' => $terapis->getGenderDisplayAttribute(),
                    'area_kerja' => $area_kerja,
                    'address' => $terapis->addres
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error saving therapist: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['foto'])
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
            $id = $data['id'] ?? null;
            
            Log::info('Delete request received', [
                'id' => $id, 
                'request_method' => $request->method(),
                'content_type' => $request->header('Content-Type')
            ]);
            
            if (!$id) {
                Log::error('ID not provided in delete request');
                return response()->json([
                    'success' => false,
                    'message' => 'ID terapis tidak ditemukan dalam request'
                ], 400);
            }
            
            $terapis = Terapis::find($id);
            
            if (!$terapis) {
                Log::error('Therapist not found', ['id' => $id]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'Data terapis tidak ditemukan'
                ], 404);
            }
            
            $terapisName = $terapis->name;
            Log::info('Deleting therapist', ['id' => $id, 'name' => $terapisName]);
            
            // Delete photo if exists
            if ($terapis->photo && Storage::disk('public')->exists($terapis->photo)) {
                try {
                    Storage::disk('public')->delete($terapis->photo);
                    Log::info('Photo deleted', ['photo_path' => $terapis->photo]);
                } catch (\Exception $photoError) {
                    Log::warning('Failed to delete photo', [
                        'photo_path' => $terapis->photo, 
                        'error' => $photoError->getMessage()
                    ]);
                }
            }
            
            // Delete the record
            $deleted = $terapis->delete();
            
            Log::info('Delete operation completed', [
                'deleted' => $deleted, 
                'id' => $id, 
                'name' => $terapisName
            ]);
            
            return response()->json([
                'success' => true,
                'message' => "Data terapis {$terapisName} berhasil dihapus",
                'deleted_id' => $id
            ], 200);
            
        } catch (\Exception $e) {
            Log::error('Error deleting therapist', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getTerapis($id)
    {
        try {
            Log::info('Get therapist request received', ['id' => $id]);
            
            $terapis = Terapis::find($id);
            
            if (!$terapis) {
                Log::error('Therapist not found for get request', ['id' => $id]);
                return response()->json([
                    'success' => false,
                    'message' => 'Data terapis tidak ditemukan'
                ], 404);
            }
            
            // Format data untuk response
            $addressParts = explode(', ', $terapis->addres);
            $area_kerja = isset($addressParts[1]) ? $addressParts[1] : 
                         (isset($addressParts[0]) ? $addressParts[0] : '-');
            
            $data = [
                'id' => $terapis->id,
                'name' => $terapis->name,
                'phone' => $terapis->phone,
                'email' => $terapis->email,
                'nik' => $terapis->NIK,
                'birth_date' => $terapis->birth_date,
                'gender' => $terapis->gender,
                'joining_date' => $terapis->joining_date,
                'photo' => $terapis->photo,
                'address' => $terapis->addres,
                'formatted_joining_date' => $terapis->joining_date ? 
                    \Carbon\Carbon::parse($terapis->joining_date)->format('d M Y') : '-',
                'formatted_gender' => $terapis->getGenderDisplayAttribute(),
                'area_kerja' => $area_kerja
            ];
            
            Log::info('Therapist data retrieved successfully', ['id' => $id, 'name' => $terapis->name]);
            
            return response()->json([
                'success' => true,
                'message' => 'Data terapis berhasil diambil',
                'data' => $data
            ], 200);
            
        } catch (\Exception $e) {
            Log::error('Error getting therapist data', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function create()
    {
        return view('pages.SuperAdminTambahTerapis');
    }

    public function show($id)
    {
        $terapis = Terapis::findOrFail($id);
        return view('pages.SuperAdminDetailTerapis', compact('terapis'));
    }

    private function generateRandomId()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        
        do {
            $randomId = '';
            for ($i = 0; $i < 6; $i++) {
                $randomId .= $characters[mt_rand(0, strlen($characters) - 1)];
            }
        } while (Terapis::where('id', $randomId)->exists());
        
        return $randomId;
    }

    private function processGenderValue($gender)
    {
        if ($gender === 'Laki-laki') {
            return 'L';
        } elseif ($gender === 'Perempuan') {
            return 'P';
        }
        return $gender;
    }

    private function handlePhotoUpload($file, $therapistName)
    {
        try {
            if (!$file || !$file->isValid()) {
                return null;
            }

            $filename = time() . '_' . Str::slug($therapistName) . '.' . $file->getClientOriginalExtension();
            $uploadPath = storage_path('app/public/therapists/photos');
            
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $filePath = $uploadPath . '/' . $filename;
            $file->move($uploadPath, $filename);
            return 'therapists/photos/' . $filename;

        } catch (\Exception $e) {
            Log::error('Photo upload error: ' . $e->getMessage());
            return null;
        }
    }

    public function getPhotoUrl($photoPath)
    {
        if (!$photoPath) {
            return asset('images/default-avatar.png');
        }
        if (filter_var($photoPath, FILTER_VALIDATE_URL)) {
            return $photoPath;
        }
        if (strpos($photoPath, 'data:') === 0) {
            return $photoPath;
        }
        return Storage::url($photoPath);
    }

    public function showPhoto($id)
    {
        $terapis = Terapis::findOrFail($id);
        
        if (!$terapis->photo) {
            abort(404);
        }

        $photoPath = storage_path('app/public/' . $terapis->photo);
        
        if (!file_exists($photoPath)) {
            abort(404);
        }

        return response()->file($photoPath);
    }
}