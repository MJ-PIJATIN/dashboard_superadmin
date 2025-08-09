<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'bookings_date', 
        'bookings_time',    
        'customer_id',
        'therapist_id',
        'main_service_id',
        'additional_service_id',
        'status',
        'payment'
    ];

    public function customer()
    {
        return $this->belongsTo(\App\Models\Pelanggan::class, 'customer_id');
    }

    public function therapist()
    {
        return $this->belongsTo(\App\Models\Terapis::class, 'therapist_id');
    }

    public function mainService()
    {
        return $this->belongsTo(\App\Models\LayananUtama::class, 'main_service_id');
    }

    public function additionalService()
    {
        return $this->belongsTo(\App\Models\LayananTambahan::class, 'additional_service_id');
    }
}
