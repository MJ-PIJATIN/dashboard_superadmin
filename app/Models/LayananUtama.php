<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananUtama extends Model
{
    protected $table = 'main_services';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id', 'name', 'price', 'duration', 'description', 'status', 'created_at', 'updated_at'
    ];
}