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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke penulis (admin)
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable(); // Gambar utama berita
            $table->text('excerpt'); // Ringkasan singkat
            $table->longText('body'); // Konten dari text editor
            $table->enum('status', ['published', 'draft', 'private'])->default('draft');
            $table->unsignedInteger('view_count')->default(0);
            $table->timestamp('published_at')->nullable(); // Untuk penjadwalan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
