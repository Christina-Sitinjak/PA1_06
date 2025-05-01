<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanKelas extends Model
{
    use HasFactory;

    protected $table = 'pesan_kelas'; // Nama tabel
    protected $primaryKey = 'pesan_kelas_id'; // Primary key
    public $timestamps = true; // Aktifkan timestamps (created_at, updated_at)
    protected $fillable = [
        'nama',
        'alamat',
        'asal_sekolah',
        'kategori_id',
        'tingkatan',
        'kelas',
        'kelas_id', // Ini sebenarnya `kelas_id` dari tabel `kelas`
        'jadwal',
        'user_id', // Tambahkan user_id
        'status', // Tambahkan kolom status
    ];

    // Relasi ke tabel Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    // Relasi ke tabel Kelas (program)
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'kelas_id');
    }

     // Relasi ke User model
     public function user()
     {
         return $this->belongsTo(User::class); // Asumsi menggunakan model User default dari Laravel
     }
}
