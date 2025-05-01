<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'kelas_id';
    protected $fillable = [
        'kategori_id',
        'nama_kelas',
        'harga_pendaftaran',
        'harga_kursus',
        'masa_belajar',
        'stok'
    ];

    // Relasi ke model Kategori (One to Many Inverse)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }
}
