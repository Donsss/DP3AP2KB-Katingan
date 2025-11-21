<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            // Link untuk iFrame Google Maps
            $table->text('google_map_url')->nullable()->after('alamat');

            // Link untuk TikTok
            $table->string('tiktok_url')->nullable()->after('whatsapp_url');
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['google_map_url', 'tiktok_url']);
        });
    }
};