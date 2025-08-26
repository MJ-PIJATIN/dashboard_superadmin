<?php

namespace App\Models;

use App\Models\Traits\Notifiable;
use Illuminate\Database\Eloquent\Model;

class LayananUtama extends Model
{
    use Notifiable;
    protected $table = 'main_services';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id', 'name', 'price', 'duration', 'description', 'status', 'created_at', 'updated_at'
    ];
}