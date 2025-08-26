<?php

namespace App\Models;

use App\Models\Traits\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use Notifiable;
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
