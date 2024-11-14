<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelasprak extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kelasprak';
    protected $table = 'kelasprak'; // Nama tabel yang akan digunakan
    
    protected $fillable = [
        'kelas',
        'hari',
        'sesi',
    ];

    public function ketersediaan()
    {
        return $this->hasMany(Ketersediaan::class, 'id');
    }
}
