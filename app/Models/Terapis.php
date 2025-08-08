<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'photo',
        'email',
        'NIK',
        'addres',
        'suspended_duration',
    ];

    protected $casts = [
        'joining_date' => 'date',
        'birth_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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

    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return Storage::disk('public')->url($this->photo);
        }
        return null;
    }

    public function getFormattedBirthDateAttribute()
    {
        if ($this->birth_date) {
            return $this->birth_date->format('d/m/Y');
        }
        return null;
    }

    public function getFormattedJoiningDateAttribute()
    {
        if ($this->joining_date) {
            return $this->joining_date->format('d/m/Y');
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

    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->name);
        $initials = '';
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper($word[0]);
            }
        }
        return substr($initials, 0, 2);
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

        static::deleting(function ($therapist) {
            if ($therapist->photo && Storage::disk('public')->exists($therapist->photo)) {
                Storage::disk('public')->delete($therapist->photo);
            }
        });
    }
}
