<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'action',
        'target_type',
        'target_id',
        'message',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $lastId = static::query()->orderBy('id', 'desc')->first()->id ?? 'NTF0000';
                $number = (int) substr($lastId, 3);
                $model->id = 'NTF' . str_pad($number + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function actor()
    {
        return $this->morphTo('actor', 'target_type', 'target_id');
    }
}
