<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('riwayat_pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Cth: "Kepala Dinas DP3A"
            $table->string('keterangan'); // Cth: "2020 - Sekarang"
            $table->integer('urutan')->default(0); // Untuk sorting
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('riwayat_pekerjaans');
    }
};