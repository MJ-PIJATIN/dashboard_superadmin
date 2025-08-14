<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terapis extends Model
{
    use HasFactory;

    protected $table = 'therapists';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'branch_id',
        'name',
        'joining_date',
        'birth_date',
        'birth_place',
        'gender',
        'phone',
        'photo',
        'email',
        'NIK',
        'addres',
        'work_area',
        'suspended_duration',
    ];

    protected $casts = [
        'joining_date' => 'date',
        'birth_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Don't cast photo as it's binary data (BLOB)
    protected $hidden = [
        'photo', // Hide photo BLOB data from JSON serialization by default
    ];

    public static function generateSequentialId()
    {
        // Ambil ID terakhir dengan format TRP
        $lastTerapis = self::where('id', 'like', 'TRP%')
            ->orderByRaw('CAST(SUBSTRING(id, 4) AS UNSIGNED) DESC')
            ->first();
        
        $nextNumber = 1;
        
        if ($lastTerapis) {
            // Ekstrak nomor dari ID terakhir (contoh: TRP0001 -> 1)
            $lastNumber = intval(substr($lastTerapis->id, 3));
            $nextNumber = $lastNumber + 1;
        }
        
        // Format dengan padding 4 digit: TRP0001, TRP0002, dst.
        return 'TRP' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    // Hapus method generateRandomId() lama dan ganti dengan yang baru
    public static function generateRandomId()
    {
        return self::generateSequentialId();
    }

    public function getGenderDisplayAttribute()
    {
        switch ($this->gender) {
            case 'L':
            case 'M':
                return 'Laki-laki';
            case 'P':
            case 'F':
                return 'Perempuan';
            default:
                return $this->gender;
        }
    }

    /**
     * Get photo URL for BLOB data
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return route('terapis.photo', $this->id);
        }
        return null;
    }

    /**
     * Get photo data URL (base64 encoded) for inline display
     * Use this sparingly as it can be memory intensive
     */
    public function getPhotoDataUrlAttribute()
    {
        if (!$this->photo) {
            return null;
        }

        try {
            // Detect image type
            $imageInfo = getimagesizefromstring($this->photo);
            if (!$imageInfo) {
                return null;
            }

            $mimeType = $imageInfo['mime'];
            $base64 = base64_encode($this->photo);
            
            return "data:{$mimeType};base64,{$base64}";
        } catch (\Exception $e) {
            \Log::warning('Failed to generate photo data URL: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Check if terapis has photo
     */
    public function getHasPhotoAttribute()
    {
        return !empty($this->photo);
    }

    /**
     * Get photo size in bytes
     */
    public function getPhotoSizeAttribute()
    {
        if ($this->photo) {
            return strlen($this->photo);
        }
        return 0;
    }

    /**
     * Get photo size in human readable format
     */
    public function getPhotoSizeFormattedAttribute()
    {
        $bytes = $this->photo_size;
        
        if ($bytes == 0) {
            return '0 B';
        }
        
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = floor(log($bytes, 1024));
        
        return round($bytes / pow(1024, $i), 2) . ' ' . $units[$i];
    }

    public function getFormattedBirthDateAttribute()
    {
        if ($this->birth_date) {
            return $this->birth_date->format('d M Y');
        }
        return null;
    }

    public function getFormattedJoiningDateAttribute()
    {
        if ($this->joining_date) {
            return $this->joining_date->format('d M Y');
        }
        return null;
    }

    public function getAgeAttribute()
    {
        if ($this->birth_date) {
            return $this->birth_date->diffInYears(now());
        }
        return null;
    }

    // Get initials from name
    public function getInitialsAttribute()
    {
        if (!$this->name) {
            return '';
        }
        
        $words = explode(' ', trim($this->name));
        $initials = '';
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper($word[0]);
            }
        }
        
        // Return maximum 2 characters
        return substr($initials, 0, 2);
    }

    /**
     * Get display area kerja (hanya kota/kabupaten)
     */
    public function getDisplayAreaKerjaAttribute()
    {
        // Prioritas 1: Gunakan work_area jika tersedia
        if (!empty($this->work_area)) {
            // Ambil hanya kota/kabupaten (bagian pertama sebelum koma)
            $workAreaParts = explode(', ', $this->work_area);
            return $workAreaParts[0] ?? '-';
        }
        
        // Prioritas 2: Fallback ke parsing addres (untuk data lama)
        if (!empty($this->addres)) {
            $addressParts = explode(', ', $this->addres);
            return isset($addressParts[1]) ? $addressParts[1] : 
                (isset($addressParts[0]) ? $addressParts[0] : '-');
        }
        
        return '-';
    }

    /**
     * Get full work area (kota/kabupaten + provinsi)
     */
    public function getFullWorkAreaAttribute()
    {
        if (!empty($this->work_area)) {
            return $this->work_area;
        }
        
        // Fallback ke parsing dari addres
        if (!empty($this->addres)) {
            $addressParts = explode(', ', $this->addres);
            if (count($addressParts) >= 3) {
                // Ambil kota dan provinsi (skip alamat detail di index 0)
                return $addressParts[1] . ', ' . $addressParts[2];
            }
        }
        
        return '-';
    }

    /**
     * Get work area parts
     */
    public function getWorkAreaPartsAttribute()
    {
        if (!empty($this->work_area)) {
            $parts = explode(', ', $this->work_area);
            return [
                'city' => $parts[0] ?? '',
                'province' => $parts[1] ?? ''
            ];
        }
        
        // Fallback ke parsing dari addres
        if (!empty($this->addres)) {
            $addressParts = explode(', ', $this->addres);
            return [
                'city' => $addressParts[1] ?? '',
                'province' => $addressParts[2] ?? ''
            ];
        }
        
        return [
            'city' => '',
            'province' => ''
        ];
    }

    public function scopeActive($query)
    {
        return $query->whereNull('suspended_duration')->orWhere('suspended_duration', '');
    }

    public function scopeSuspended($query)
    {
        return $query->whereNotNull('suspended_duration')->where('suspended_duration', '!=', '');
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%')
                    ->orWhere('branch_id', 'like', '%' . $search . '%')
                    ->orWhere('NIK', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }
        return $query;
    }

    public function scopeByGender($query, $gender)
    {
        if ($gender) {
            $genderValue = $gender;
            if ($gender === 'Laki-laki') {
                $genderValue = 'L';
            } elseif ($gender === 'Perempuan') {
                $genderValue = 'P';
            }
            return $query->where('gender', $genderValue);
        }
        return $query;
    }

    public function getDisplayNameAttribute()
    {
        if (strlen($this->name) > 20) {
            return substr($this->name, 0, 17) . '...';
        }
        return $this->name;
    }

    /**
     * Update parsed address attribute to include work area
     */
    public function getParsedAddressAttribute()
    {
        $workAreaParts = $this->work_area_parts;
        
        if ($this->addres) {
            $parts = explode(', ', $this->addres);
            return [
                'full' => $this->addres,
                'street' => $parts[0] ?? '',
                'city' => $workAreaParts['city'] ?: ($parts[1] ?? ''),
                'province' => $workAreaParts['province'] ?: ($parts[2] ?? ''),
                'work_area_display' => $this->display_area_kerja
            ];
        }
        
        return [
            'full' => '',
            'street' => '',
            'city' => $workAreaParts['city'],
            'province' => $workAreaParts['province'],
            'work_area_display' => $this->display_area_kerja
        ];
    }

    // Check if terapis is available (not suspended)
    public function getIsAvailableAttribute()
    {
        return empty($this->suspended_duration);
    }

    // Get status display text
    public function getStatusDisplayAttribute()
    {
        return $this->is_available ? 'Tersedia' : 'Ditangguhkan';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($therapist) {
            if (empty($therapist->id)) {
                $therapist->id = self::generateSequentialId();
            }
            if (empty($therapist->branch_id)) {
                $therapist->branch_id = null;
            }
            if (empty($therapist->joining_date)) {
                $therapist->joining_date = now()->format('Y-m-d');
            }
            if (empty($therapist->suspended_duration)) {
                $therapist->suspended_duration = null;
            }
        });

        // No need to delete files when deleting record since photo is stored as BLOB
        static::deleting(function ($therapist) {
            // Photo is stored as BLOB, no file cleanup needed
            \Log::info('Deleting therapist with BLOB photo', [
                'id' => $therapist->id,
                'has_photo' => !empty($therapist->photo),
                'photo_size' => !empty($therapist->photo) ? strlen($therapist->photo) : 0
            ]);
        });
    }

    /**
     * Override toArray to include area kerja display and exclude photo BLOB
     */
    public function toArray()
    {
        $array = parent::toArray();
        
        // Remove photo BLOB from array representation
        unset($array['photo']);
        
        // Add useful photo-related attributes
        $array['has_photo'] = $this->has_photo;
        $array['photo_url'] = $this->photo_url;
        
        // Add area kerja display attributes
        $array['display_area_kerja'] = $this->display_area_kerja;
        $array['full_work_area'] = $this->full_work_area;
        $array['work_area_parts'] = $this->work_area_parts;
        
        return $array;
    }

    /**
     * Get array representation including photo data URL
     * Use carefully as this includes base64 encoded image
     */
    public function toArrayWithPhoto()
    {
        $array = $this->toArray();
        $array['photo_data_url'] = $this->photo_data_url;
        return $array;
    }
}