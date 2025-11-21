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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id(); // Kita akan gunakan ID = 1
            $table->string('file_path'); // Lokasi file PDF, mis: 'dokumen/tugas.pdf'
            $table->string('file_name')->nullable(); // Nama file asli, mis: 'Tugas Pokok DP3A.pdf'
            $table->string('file_size')->nullable(); // Ukuran file, mis: '1.2 MB'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};