<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('youtube_url');
            $table->string('youtube_id'); // Untuk menyimpan ID YouTube yang diekstrak
            $table->string('title')->nullable(); // Judul bisa opsional
            $table->string('thumbnail'); // URL thumbnail video
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};