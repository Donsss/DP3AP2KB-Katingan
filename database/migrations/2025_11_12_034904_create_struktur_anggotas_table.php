<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('struktur_anggotas', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel 'struktur_bidangs'
            $table->foreignId('struktur_bidang_id')->constrained()->onDelete('cascade');
            
            // Data terpisah
            $table->string('nama');
            $table->string('jabatan');
            $table->string('nip')->nullable();
            $table->string('foto')->nullable();
            
            // Untuk OPSI A (Spacer Card)
            $table->boolean('is_visible')->default(true); // true = Tampil, false = Spacer
            
            $table->integer('urutan')->default(0); // Untuk drag-and-drop urutan kartu
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('struktur_anggotas');
    }
};