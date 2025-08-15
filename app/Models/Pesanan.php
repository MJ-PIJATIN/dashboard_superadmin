<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Complaint;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    
    protected $primaryKey = 'id';
    public $incrementing = false; 
    protected $keyType = 'string'; 
    
    protected $fillable = [
        'id',
        'booking_code',
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pesanan) {
            if (empty($pesanan->booking_code)) {
                // Prefix beda sesuai payment
                $prefix = $pesanan->payment === 'Cash' ? 'BKC' : 'BKT';

                $lastBooking = self::where('booking_code', 'like', $prefix . '%')
                                ->orderBy('booking_code', 'desc')
                                ->first();

                $nextNumber = 1;
                if ($lastBooking) {
                    $lastNumber = (int) substr($lastBooking->booking_code, 3);
                    $nextNumber = $lastNumber + 1;
                }

                $pesanan->booking_code = $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            }
        });
    }

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

    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'booking_id');
    }
}