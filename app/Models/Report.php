<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pelanggan; // Menambahkan import yang hilang

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';
    
    protected $fillable = [
        'reporter_id',
        'target_type', 
        'target_id',
        'reason',
        'detail_report'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi dengan customer (reporter)
     * Menggunakan tabel customers
     */
    public function customer()
    {
        return $this->belongsTo(Pelanggan::class, 'reporter_id', 'id');
    }

    /**
     * Relasi dengan reporter (bisa customer atau therapist)
     */
    public function reporter()
    {
        // Asumsi reporter selalu customer berdasarkan context "Aduan Pelanggan"
        return $this->belongsTo(Pelanggan::class, 'reporter_id', 'id');
    }

    /**
     * Relasi dengan target (bisa customer atau therapist)
     */
    public function targetCustomer()
    {
        return $this->belongsTo(Pelanggan::class, 'target_id', 'id');
    }

    public function targetTherapist()
    {
        return $this->belongsTo(Terapis::class, 'target_id', 'id');
    }

    /**
     * Dynamic target relation based on target_type
     */
    public function target()
    {
        if ($this->target_type === 'customer') {
            return $this->targetCustomer();
        } elseif ($this->target_type === 'therapist') {
            return $this->targetTherapist();
        }
        
        return null;
    }

    /**
     * Get target name regardless of type
     */
    public function getTargetNameAttribute()
    {
        if ($this->target_type === 'customer') {
            $target = Pelanggan::find($this->target_id);
            return $target ? $target->name : 'Customer tidak ditemukan';
        } elseif ($this->target_type === 'therapist') {
            $target = Terapis::find($this->target_id);
            return $target ? $target->name : 'Therapist tidak ditemukan';
        }
        
        return 'Target tidak tersedia';
    }

    /**
     * Accessor untuk descript (untuk compatibility dengan view lama)
     */
    public function getDescriptAttribute()
    {
        return $this->detail_report;
    }
}