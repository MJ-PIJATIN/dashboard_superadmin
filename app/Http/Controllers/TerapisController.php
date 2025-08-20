<?php

namespace App\Http\Controllers;

use App\Models\Terapis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Exception;

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
                ->orWhere('addres', 'like', '%' . $search . '%');
        });
    }

    $terapis = $query->orderByRaw("CAST(SUBSTRING(id, 4) AS UNSIGNED) ASC")->paginate($perPage);

    $terapis->getCollection()->transform(function ($item) {
        $item->formatted_joining_date = $item->joining_date ?
            $item->joining_date->format('d M Y') : '-';
        $item->formatted_gender = $item->getGenderDisplayAttribute();
        
        $item->area_kerja = $this->getDisplayAreaKerja($item);
        
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
            $sequentialId = Terapis::generateSequentialId();

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
            $terapis->id = $sequentialId;
            $terapis->branch_id = null;
            $terapis->name = $request->nama_lengkap;
            $terapis->joining_date = now()->format('Y-m-d');
            $terapis->birth_date = $birthDate;
            $terapis->birth_place = $birthPlace = $request->tempat_lahir;
            $terapis->gender = $genderValue;
            $terapis->phone = $request->no_ponsel;
            $terapis->photo = $photoPath;
            $terapis->email = $request->email;
            $terapis->NIK = $request->nik;
            $terapis->addres = $request->alamat . ', ' . $request->kota_kabupaten . ', ' . $request->provinsi;
            
            $terapis->work_area = $request->kota_kabupaten . ', ' . $request->provinsi;
            
            $terapis->save();

            $area_kerja = $this->getDisplayAreaKerja($terapis);

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

            $area_kerja = $this->getDisplayAreaKerja($terapis);

            $data = [
                'id' => $terapis->id,
                'name' => $terapis->name,
                'phone' => $terapis->phone,
                'email' => $terapis->email,
                'nik' => $terapis->NIK,
                'birth_date' => $terapis->birth_date,
                'birth_place' => $terapis->birth_place,
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
        try {
            $terapis = Terapis::findOrFail($id);

            $terapis->area_kerja = $this->getDisplayAreaKerja($terapis);
            
            $terapis->formatted_gender = $this->getGenderDisplay($terapis->gender);
            $terapis->photo_url = $this->getPhotoUrl($terapis->photo);
            $terapis->status_display = $terapis->is_available ? 'Aktif' : 'Tidak Aktif';

            return view('pages.SuperAdminDetailTerapis', compact('terapis'));
        } catch (\Exception $e) {
            Log::error('Error showing therapist detail', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);

            return redirect()->back()->with('error', 'Data terapis tidak ditemukan.');
        }
    }

    private function generateRandomId()
    {
        return Terapis::generateSequentialId();
    }

    private function generateSequentialId()
    {
        return Terapis::generateSequentialId();
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

    private function getGenderDisplay($gender)
    {
        switch ($gender) {
            case 'L':
                return 'Laki-laki';
            case 'P':
                return 'Perempuan';
            default:
                return $gender ?? '-';
        }
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

    public function warn(Request $request, $id)
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:500',
            'duration' => 'nullable|string',
        ]);

        $terapis = Terapis::findOrFail($id);

        // Logic to send a warning notification should be implemented here.
        // For now, we'll just log it.
        Log::info("Warning sent to therapist {$terapis->name} (ID: {$terapis->id}) with reason: {$validated['reason']}");

        if (!empty($validated['duration'])) {
            $suspendRequest = new Request([
                'reason' => 'warning', // Or a more specific reason
                'description' => $validated['reason'],
                'duration' => $validated['duration'],
            ]);
            app(SuspendedAccountController::class)->suspend($suspendRequest, $id);
            return response()->json(['success' => true, 'message' => 'Peringatan berhasil dikirimkan dan akun ditangguhkan.']);
        }

        return response()->json(['success' => true, 'message' => 'Peringatan berhasil dikirimkan.']);
    }

    private function getDisplayAreaKerja($terapis)
    {
        if (!empty($terapis->work_area)) {
            $workAreaParts = explode(', ', $terapis->work_area);
            return $workAreaParts[0] ?? '-';
        }

        if (!empty($terapis->addres)) {
            $addressParts = explode(', ', $terapis->addres);
            return isset($addressParts[1]) ? $addressParts[1] : 
                (isset($addressParts[0]) ? $addressParts[0] : '-');
        }
        
        return '-';
    }

    public function suspend(Request $request, $id): JsonResponse
    {
        // Log semua yang masuk untuk debugging
        \Log::info('=== SUSPEND REQUEST START ===');
        \Log::info('ID received: ' . $id);
        \Log::info('Request method: ' . $request->method());
        \Log::info('Request data: ', $request->all());
        \Log::info('Headers: ', $request->headers->all());
        
        try {
            // Validasi dasar input
            if (empty($request->reason)) {
                throw new Exception('Reason is required');
            }
            if (empty($request->description)) {
                throw new Exception('Description is required');
            }
            if (empty($request->duration)) {
                throw new Exception('Duration is required');
            }

            \Log::info('Basic validation passed');

            // Coba validasi Laravel
            $validatedData = $request->validate([
                'reason' => 'required|string|in:sexual,threats,inappropriate,violence,warning',
                'description' => 'required|string|max:500',
                'duration' => 'required|string|in:1,7,14,30'
            ]);

            \Log::info('Laravel validation passed: ', $validatedData);

            // Cek apakah model Terapis exists
            $modelClass = 'App\\Models\\Terapis';
            if (!class_exists($modelClass)) {
                \Log::error('Model Terapis tidak ditemukan');
                throw new Exception('Model Terapis tidak ditemukan');
            }

            \Log::info('Model exists, trying to find terapis...');

            // Cari terapis - gunakan beberapa cara berbeda
            try {
                // Cara 1: Langsung dengan model
                $terapis = \App\Models\Terapis::find($id);
                \Log::info('Method 1 result: ' . ($terapis ? 'found' : 'not found'));
                
                // Cara 2: Jika tidak ada, coba dengan where
                if (!$terapis) {
                    $terapis = \App\Models\Terapis::where('id', $id)->first();
                    \Log::info('Method 2 result: ' . ($terapis ? 'found' : 'not found'));
                }
                
                // Cara 3: Coba lihat semua data
                $allTerapis = \App\Models\Terapis::all(['id', 'name']);
                \Log::info('All terapis IDs: ', $allTerapis->pluck('id')->toArray());
                
            } catch (Exception $e) {
                \Log::error('Database error: ' . $e->getMessage());
                throw new Exception('Database error: ' . $e->getMessage());
            }

            if (!$terapis) {
                \Log::error('Terapis not found with ID: ' . $id);
                return response()->json([
                    'success' => false,
                    'message' => "Terapis dengan ID '{$id}' tidak ditemukan"
                ], 404);
            }

            \Log::info('Terapis found: ' . $terapis->name);

            // Mapping durasi
            $durationMapping = [
                '1' => '7 hari',
                '7' => '14 hari', 
                '14' => '30 hari',
                '30' => 'Permanen'
            ];

            $suspendDuration = $durationMapping[$request->duration] ?? $request->duration . ' hari';

            \Log::info('Mapped duration: ' . $suspendDuration);

            // Update terapis - hati-hati dengan nama kolom
            try {
                $updateData = [
                    'suspended_duration' => $suspendDuration,
                    'updated_at' => now(),
                ];

                // Cek kolom mana yang ada di tabel
                $tableColumns = \Schema::getColumnListing('terapis');
                \Log::info('Available columns: ', $tableColumns);

                // Tambahkan kolom tambahan jika ada
                if (in_array('suspend_reason', $tableColumns)) {
                    $updateData['suspend_reason'] = $request->reason;
                }
                if (in_array('suspend_description', $tableColumns)) {
                    $updateData['suspend_description'] = $request->description;
                }
                if (in_array('suspended_at', $tableColumns)) {
                    $updateData['suspended_at'] = now();
                }

                \Log::info('Update data: ', $updateData);

                $updated = $terapis->update($updateData);
                \Log::info('Update result: ' . ($updated ? 'success' : 'failed'));

            } catch (Exception $e) {
                \Log::error('Update error: ' . $e->getMessage());
                throw new Exception('Gagal update database: ' . $e->getMessage());
            }

            \Log::info('=== SUSPEND REQUEST SUCCESS ===');

            return response()->json([
                'success' => true,
                'message' => "Akun terapis '{$terapis->name}' berhasil ditangguhkan untuk {$suspendDuration}",
                'debug' => [
                    'id' => $id,
                    'duration_mapped' => $suspendDuration,
                    'columns_available' => $tableColumns ?? []
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error: ', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);

        } catch (Exception $e) {
            \Log::error('=== SUSPEND REQUEST ERROR ===');
            \Log::error('Error message: ' . $e->getMessage());
            \Log::error('Error trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'debug' => [
                    'id' => $id,
                    'request_data' => $request->all()
                ]
            ], 500);
        }
    }
}