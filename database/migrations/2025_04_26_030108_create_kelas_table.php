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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('kelas_id'); // Auto-incrementing primary key
            $table->unsignedBigInteger('kategori_id'); // Foreign key ke tabel kategori
            $table->string('nama_kelas', 100);
            $table->decimal('harga_pendaftaran', 10, 2); // Contoh: 10 digit total, 2 digit desimal
            $table->decimal('harga_kursus', 10, 2);
            $table->integer('masa_belajar'); // Dalam satuan hari/minggu/bulan (tergantung kebutuhan)
            $table->integer('stok');
            $table->timestamps();

            $table->foreign('kategori_id')->references('kategori_id')->on('kategori')->onDelete('cascade'); // Definisi foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
