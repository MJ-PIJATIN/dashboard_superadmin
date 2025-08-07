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
        // Jika menggunakan ENUM dengan nilai singkat
        if ($gender === 'Laki-laki') {
            return 'L'; // atau bisa 'M' untuk Male
        } elseif ($gender === 'Perempuan') {
            return 'P'; // atau bisa 'F' untuk Female
        }
        
        // Jika menggunakan VARCHAR, return nilai asli
        return $gender;
    }

    private function handlePhotoUpload($file, $therapistName)
    {
        try {
            // Validate file
            if (!$file || !$file->isValid()) {
                return null;
            }

            // Create filename with timestamp and therapist name
            $filename = time() . '_' . Str::slug($therapistName) . '.' . $file->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $uploadPath = storage_path('app/public/therapists/photos');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Get the full file path
            $filePath = $uploadPath . '/' . $filename;

            // Option 1: Simple move (recommended for most cases)
            $file->move($uploadPath, $filename);
            // Return the relative path for database storage
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
        // Validasi input
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
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

    try {
        // Generate random ID dengan 6 karakter
        $randomId = $this->generateRandomId();

        // Generate branch_id (format: BRANCH + 6 digit random)
        $branchId = null; // Replace with actual logic to get branch ID if needed

        // Handle photo upload
        $photoPath = null;
        $photoBase64 = null;
        
        if ($request->hasFile('foto')) {
            $photoPath = $this->handlePhotoUpload($request->file('foto'), $request->nama_lengkap);
            
            // If you need base64 format for API or specific requirements
            // $photoBase64 = $this->convertPhotoToBase64($photoPath);
        }

        // Ubah format tanggal lahir
        $birthDate = null;
        if ($request->tanggal_lahir) {
            $birthDate = \DateTime::createFromFormat('d/m/Y', $request->tanggal_lahir);
            if ($birthDate) {
                $birthDate = $birthDate->format('Y-m-d');
            }
        }

        // Process gender value
        $genderValue = $this->processGenderValue($request->jenis_kelamin);

        // Simpan data terapis dengan ID custom
        $terapis = new Terapis();
        $terapis->id = $randomId;
        $terapis->branch_id = $branchId;
        $terapis->name = $request->nama_lengkap;
        $terapis->joining_date = now()->format('Y-m-d');
        $terapis->birth_date = $birthDate;
        $terapis->gender = $genderValue;
        $terapis->phone = $request->no_ponsel;
        
        // Store photo path (or base64 if needed)
        $terapis->photo = $photoPath; // or $photoBase64 if you need base64 format
        
        $terapis->email = $request->email;
        $terapis->NIK = $request->nik;
        $terapis->addres = $request->alamat . ', ' . $request->kota_kabupaten . ', ' . $request->provinsi;
        
        $terapis->save();

        return redirect()->back();

    } catch (\Exception $e) {
        return redirect()->back()->withInput();
    }
    }

    public function getPhotoUrl($photoPath)
    {
        if (!$photoPath) {
            return asset('images/default-avatar.png'); // default avatar
        }

        // If photo path is already a full URL
        if (filter_var($photoPath, FILTER_VALIDATE_URL)) {
            return $photoPath;
        }

        // If photo is base64
        if (strpos($photoPath, 'data:') === 0) {
            return $photoPath;
        }

        // Regular file path
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