<?php

namespace App\Models;

use App\Models\Traits\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['judul', 'deskripsi'];

    /**
     * Get a descriptive identifier for the model.
     *
     * @return string
     */
    protected function getIdentifier()
    {
        return $this->judul;
    }
}
