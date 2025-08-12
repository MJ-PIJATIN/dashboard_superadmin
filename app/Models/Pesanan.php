<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    
    protected $primaryKey = 'id';
    public $incrementing = false; 
    protected $keyType = 'string'; 
    
    protected $fillable = [
        'id',
        'customer_id',
        'therapist_id', 
        'main_service_id',
        'additional_service_id',
        'bookings_date',
        'bookings_time',
        'payment',
        'status',
        'created_at',
        'updated_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Pelanggan::class, 'customer_id', 'id');
    }

    public function therapist()
    {
        return $this->belongsTo(Terapis::class, 'therapist_id', 'id');
    }

    public function mainService()
    {
        return $this->belongsTo(LayananUtama::class, 'main_service_id', 'id');
    }

    public function additionalService()
    {
        return $this->belongsTo(LayananTambahan::class, 'additional_service_id', 'id');
    }
}