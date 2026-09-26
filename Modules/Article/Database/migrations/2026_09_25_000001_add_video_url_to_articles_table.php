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
        Schema::table('articles', function (Blueprint $table) {
            // Optional YouTube or Facebook video link the editor pastes in as-is
            // (e.g. https://www.youtube.com/watch?v=... or a facebook.com/.../videos/... URL).
            // Videos are never uploaded to/stored on our own server - see
            // Article::embedVideoUrl() for how this is turned into an embeddable URL.
            $table->string('video_url')->nullable()->after('body');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('video_url');
        });
    }
};
