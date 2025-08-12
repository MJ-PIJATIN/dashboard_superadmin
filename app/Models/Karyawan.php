<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawans'; 

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
        'id',
        'first_name',
        'last_name',
        'joining_date',
        'birth_place',
        'birth_date',
        'gender',
        'phone',
        'address',
        'photo',
        'branch_id',
        'email',
        'password',
        'role',
        'created_at',
        'updated_at',
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
        'joining_date' => 'date',
    ];
}
