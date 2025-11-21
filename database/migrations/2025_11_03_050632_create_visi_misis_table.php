<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('visi_misis', function (Blueprint $table) {
            $table->id(); // Hanya akan ada 1 baris, yaitu id=1
            $table->text('visi')->nullable();
            $table->json('misi')->nullable(); // <-- Kolom JSON untuk Misi
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('visi_misis');
    }
};