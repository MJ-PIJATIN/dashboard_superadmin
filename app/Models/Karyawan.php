<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'employees'; 

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'email',
        'alamat',
        'provinsi',
        'kota',
        'ponsel',
        'foto',
        'role',
        'password',
    ];

        // Accessor untuk nama lengkap
    public function getNamaLengkapAttribute()
    {
        return "{$this->nama_depan} {$this->nama_belakang}";
    }

    // Accessor untuk area penempatan
    public function getAreaPenempatanAttribute()
    {
        return "{$this->kota}, {$this->provinsi}";
    }

    protected $casts = [
        'tanggal_bergabung' => 'date',
    ];
}
