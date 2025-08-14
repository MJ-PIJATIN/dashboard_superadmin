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
        'gender',
        'phone',
        'photo', // BLOB data
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

    public static function generateRandomId()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        
        do {
            $randomId = '';
            for ($i = 0; $i < 6; $i++) {
                $randomId .= $characters[mt_rand(0, strlen($characters) - 1)];
            }
        } while (self::where('id', $randomId)->exists());
        
        return $randomId;
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

    public function getParsedAddressAttribute()
    {
        if ($this->addres) {
            $parts = explode(', ', $this->addres);
            return [
                'full' => $this->addres,
                'street' => $parts[0] ?? '',
                'city' => $parts[1] ?? '',
                'province' => $parts[2] ?? '',
            ];
        }
        return [
            'full' => '',
            'street' => '',
            'city' => '',
            'province' => '',
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
                $therapist->id = self::generateRandomId();
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
     * Override toArray to exclude photo BLOB by default
     */
    public function toArray()
    {
        $array = parent::toArray();
        
        // Remove photo BLOB from array representation
        unset($array['photo']);
        
        // Add useful photo-related attributes instead
        $array['has_photo'] = $this->has_photo;
        $array['photo_url'] = $this->photo_url;
        
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

public function reportedBy()
{
    return $this->hasMany(Report::class, 'target_id')
                ->where('reports.target_type', 'therapist');
}
}