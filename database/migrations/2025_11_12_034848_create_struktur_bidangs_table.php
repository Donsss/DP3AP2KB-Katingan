<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('struktur_bidangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bidang'); // Cth: "Level 1: Pimpinan", "Level 2: Sekretariat"
            $table->integer('urutan')->default(0); // Untuk drag-and-drop urutan baris
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('struktur_bidangs');
    }
};