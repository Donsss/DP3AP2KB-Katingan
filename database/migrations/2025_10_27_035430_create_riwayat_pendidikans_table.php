<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('riwayat_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Cth: "S3 - Ilmu Kesehatan Masyarakat"
            $table->string('keterangan'); // Cth: "Lulus 2010"
            $table->string('deskripsi'); // Cth: "Universitas Sebelas Maret"
            $table->integer('urutan')->default(0); // Untuk sorting
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('riwayat_pendidikans');
    }
};