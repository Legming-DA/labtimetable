<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ketersediaan extends Model
{
    use HasFactory;
    protected $table = 'ketersediaan';

    protected $fillable = [
        'id_asisten',
        'id_kelasprak',
    ];

    public function kelasprak(){
        return $this->belongsTo(Kelasprak::class, 'id_kelasprak');
    }
    public function asisten(){
        return $this->belongsTo(Asisten::class, 'id_asisten');
    }
}
