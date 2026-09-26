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
        Schema::table('site_details', function (Blueprint $table) {
            // Google AdSense Publisher ID, e.g. "ca-pub-1234567890123456".
            // Left empty, no AdSense script is loaded - see Front master layout.
            $table->string('adsense_client_id')->nullable()->after('footer_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_details', function (Blueprint $table) {
            $table->dropColumn('adsense_client_id');
        });
    }
};
