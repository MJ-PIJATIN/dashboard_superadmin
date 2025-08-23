<?php

namespace App\Models;

use App\Models\Traits\Notifiable;
use Illuminate\Database\Eloquent\Model;

class LayananTambahan extends Model
{
    use Notifiable;
    protected $table = 'additional_services';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id', 'name', 'price', 'duration', 'description', 'created_at', 'updated_at'
    ];
}
