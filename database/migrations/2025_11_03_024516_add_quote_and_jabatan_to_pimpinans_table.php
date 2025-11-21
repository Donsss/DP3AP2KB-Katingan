<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('pimpinans', function (Blueprint $table) {
            // Tambahkan kolom setelah 'pangkat_golongan' (atau sesuaikan)
            $table->string('jabatan')->nullable()->after('pangkat_golongan');
            $table->text('quote')->nullable()->after('jabatan');
        });
    }

    public function down(): void {
        Schema::table('pimpinans', function (Blueprint $table) {
            $table->dropColumn(['jabatan', 'quote']);
        });
    }
};