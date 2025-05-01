<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesan_kelas', function (Blueprint $table) {
            $table->id('pesan_kelas_id');
            $table->string('nama', 100);
            $table->text('alamat');
            $table->string('asal_sekolah', 100);
            $table->unsignedBigInteger('kategori_id');
            $table->enum('tingkatan', ['sd', 'smp', 'sma']);
            $table->string('kelas', 10); // Kelas (3, 4, 5, dst.)
            $table->unsignedBigInteger('program'); // kelas_id dari tabel kelas
            $table->enum('jadwal', ['senin-rabu', 'selasa-kamis', 'jumat-sabtu']);
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users
            $table->enum('status', ['pending', 'approved', 'cancelled'])->default('pending'); // Status pemesanan
            $table->timestamps();

            $table->foreign('kategori_id')->references('kategori_id')->on('kategori');
            $table->foreign('program')->references('kelas_id')->on('kelas');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key ke users
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan_kelas');
    }
};
