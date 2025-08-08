<?php

namespace App\Http\Controllers;

use App\Models\Terapis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class TerapisController extends Controller
{
    public function create()
    {
        return view('pages.SuperAdminTambahTerapis');
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
            \Log::error('Photo upload error: ' . $e->getMessage());
            return null;
        }
    }

    private function convertPhotoToBase64($photoPath)
    {
        try {
            if (!$photoPath) {
                return null;
            }

            $fullPath = storage_path('app/public/' . $photoPath);
            
            if (!file_exists($fullPath)) {
                return null;
            }

            $imageData = file_get_contents($fullPath);
            $mimeType = mime_content_type($fullPath);
            
            return 'data:' . $mimeType . ';base64,' . base64_encode($imageData);
            
        } catch (\Exception $e) {
            \Log::error('Base64 conversion error: ' . $e->getMessage());
            return null;
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:255|unique:therapists,NIK',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date_format:d/m/Y',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_ponsel' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kota_kabupaten' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'nik.required' => 'NIK wajib diisi',
            'nik.unique' => 'NIK sudah terdaftar',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'alamat.required' => 'Alamat wajib diisi',
            'email.required' => 'Email wajib diisi',
            'no_ponsel.required' => 'Nomor ponsel wajib diisi',
            'provinsi.required' => 'Provinsi wajib dipilih',
            'kota_kabupaten.required' => 'Kota/Kabupaten wajib dipilih',
            'foto.required' => 'Foto wajib diunggah',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus jpeg, png, jpg, gif, atau webp',
            'foto.max' => 'Ukuran foto maksimal 5MB',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            sleep(2);

            $randomId = $this->generateRandomId();
            $branchId = null;

            $photoPath = null;
            $photoBase64 = null;
            
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
            $terapis->branch_id = $branchId;
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

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data terapis berhasil ditambahkan',
                    'data' => [
                        'id' => $terapis->id,
                        'name' => $terapis->name
                    ],
                    'redirect_url' => route('terapis')
                ], 200);
            }

            return redirect()->route('terapis')->with('success', 'Data terapis berhasil ditambahkan');

        } catch (\Exception $e) {
            \Log::error('Error saving therapist: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['foto'])
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.',
                    'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.']);
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
