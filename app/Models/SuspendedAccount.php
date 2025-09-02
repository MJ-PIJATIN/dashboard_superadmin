<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class SuspendedAccount extends Model
{
    use HasFactory;

    protected $table = 'suspended_accounts';

    protected $fillable = [
        'suspension_id',
        'therapist_id',
        'complaint_id',
        'name',
        'gender',
        'national_id_number',
        'email',
        'phone_number',
        'address',
        'work_area',
        'photo_url',
        'duration',
        'reason',
        'reason_description',
        'suspended_at',
        'suspension_ends_at',
    ];

    protected $casts = [
        'suspended_at' => 'datetime',
        'suspension_ends_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::deleted(function ($suspendedAccount) {
            if (static::count() === 0) {
                DB::statement('ALTER TABLE suspended_accounts AUTO_INCREMENT = 1;');
            }
        });
    }

    public function therapist()
    {
        return $this->belongsTo(Terapis::class, 'therapist_id', 'id');
    }
}
