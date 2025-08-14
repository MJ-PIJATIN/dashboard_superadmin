<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'email',
        'city',
        'status',
        'phone',
        'photo',
        'addres', // Note: typo di database 'addres' bukan 'address'
        'NIK',
        'gender',
        'suspended_duration'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'status' => 'string',
        'gender' => 'string',
        'suspended_duration' => 'string'
    ];

    // Hide photo from JSON by default since it's binary
    protected $hidden = [
        'photo',
    ];

    public function bookings()
    {
        return $this->hasMany(Pesanan::class, 'customer_id');
    }

    /**
     * Relasi dengan reports sebagai reporter
     */
    public function reports()
    {
        return $this->hasMany(Report::class, 'reporter_id');
    }

    /**
     * Relasi dengan reports sebagai target
     */
    public function reportedBy()
    {
        return $this->hasMany(Report::class, 'target_id')
                    ->where('reports.target_type', 'customer');
    }

    /**
     * Check if customer is suspended
     */
    public function isSuspended()
    {
        return !is_null($this->suspended_duration);
    }

    /**
     * Get full address (handling typo in database)
     */
    public function getAddressAttribute()
    {
        return $this->addres; // menggunakan 'addres' karena itu nama kolom di database
    }

    /**
     * Get gender display
     */
    public function getGenderDisplayAttribute()
    {
        switch ($this->gender) {
            case 'LakiLaki':
                return 'Laki-laki';
            case 'Perempuan':
                return 'Perempuan';
            default:
                return $this->gender;
        }
    }

    /**
     * Get status display
     */
    public function getStatusDisplayAttribute()
    {
        return $this->status === 'Aktif' ? 'Aktif' : 'Belum Aktif';
    }

    /**
     * Scope for active customers
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'Aktif');
    }

    /**
     * Scope for search
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('NIK', 'like', '%' . $search . '%');
            });
        }
        return $query;
    }
}
