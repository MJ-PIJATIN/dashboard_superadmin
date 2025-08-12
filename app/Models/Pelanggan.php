<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'id',
        'name',
        'email',
        'city',
        'status',
        'phone',
        'gender',
        'address',
        'NIK',
        'gender',
    ];

    public function bookings()
    {
        return $this->hasMany(Pesanan::class, 'customer_id');
    }
}
