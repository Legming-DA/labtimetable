<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konfigurasi extends Model
{
    use HasFactory;
    protected $primaryKey = 'kd';
    // Nama tabel
    protected $table = 'konfigurasi';

    // Kolom yang bisa diisi
    protected $fillable = [
        'kd', 
        'popsize', 
        'generasi', 
        'crossrate', 
        'mutrate'];

    // Jika tabel tidak memiliki timestamps (created_at, updated_at)
    public $timestamps = false;
}
