<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            // Kolom dari Rencana "Umum"
            $table->string('site_name')->nullable()->after('id');
            $table->string('site_logo')->nullable()->after('site_name');
            $table->string('copyright_text')->nullable()->after('site_logo');

            // Kolom dari Rencana "Footer"
            $table->text('footer_about')->nullable()->after('alamat');

            // Kolom "Twitter" (sepertinya Anda belum punya)
            $table->string('twitter_url')->nullable()->after('youtube_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
};
