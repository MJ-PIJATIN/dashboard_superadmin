<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tanggal_bergabung',
        'ponsel',
        'jenis_kelamin',
        'area_penempatan',
        'role',
    ];

    protected $casts = [
        'tanggal_bergabung' => 'date',
    ];
}
