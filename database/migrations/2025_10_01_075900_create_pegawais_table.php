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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidang_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('position');
            $table->string('nip');
            $table->string('photo');
            $table->enum('status', ['asn', 'non-asn']);
            $table->unsignedInteger('order')->default(0); // Untuk urutan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
