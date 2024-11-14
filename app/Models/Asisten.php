<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asisten extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_asisten';
    protected $table = 'asistens'; // Nama tabel yang akan digunakan
    
    protected $fillable = [
        'nim',
        'nama',
        'email',
    ];
    
    public function ketersediaan()
    {
        return $this->hasMany(Ketersediaan::class, 'id');
    }
    // Jika tabel memiliki kolom timestamps (created_at dan updated_at)
    public $timestamps = true;
}
