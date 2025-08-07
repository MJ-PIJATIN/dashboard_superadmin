<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = 'branches';
    protected $guarded = [];
    protected $fillable = [
        'id',
        'province',
        'city',
        'address',
        'email',
        'description',
        'branch_code',
    ];

}
