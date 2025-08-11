<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
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

    protected $casts = [
        'joining_date' => 'date',
    ];
}
