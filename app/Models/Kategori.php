<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori'; // Nama tabel di database
    protected $primaryKey = 'kategori_id'; // Nama kolom primary key
    public $timestamps = true; // Aktifkan timestamps (created_at, updated_at)
    protected $fillable = [
        'nama_kategori',
    ];
}
