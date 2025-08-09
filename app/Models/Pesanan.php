<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        // pakai nama kolom yang sebenarnya di DB
        'bookings_date',      // <-- kalau DBmu "bookings_date"
        'bookings_time',      // <-- kalau DBmu "bookings_time"
        'customer_id',
        'therapist_id',
        'main_service_id',
        'additional_service_id',
        'status',
        'payment'
    ];

    // Ganti class model di bawah sesuai nama model sebenarnya (Customer/Pelanggan, dll.)
    public function customer()
    {
        return $this->belongsTo(\App\Models\Pelanggan::class, 'customer_id');
        // atau: return $this->belongsTo(\App\Models\Pelanggan::class, 'customer_id');
    }

    public function therapist()
    {
        return $this->belongsTo(\App\Models\Terapis::class, 'therapist_id');
        // atau Terapis::class jika modelmu bernama itu
    }

    public function mainService()
    {
        return $this->belongsTo(\App\Models\LayananUtama::class, 'main_service_id');
        // atau LayananUtama::class
    }

    public function additionalService()
    {
        return $this->belongsTo(\App\Models\LayananTambahan::class, 'additional_service_id');
        // atau LayananTambahan::class
    }
}
