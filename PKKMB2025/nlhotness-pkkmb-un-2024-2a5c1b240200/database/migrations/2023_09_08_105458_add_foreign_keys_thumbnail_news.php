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
        Schema::table('thumbnail_news', function (Blueprint $table) {
            $table->foreign('news_id', 'fk_thumbnail_news_to_news')->references('id')->on('news')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('thumbnail_news', function (Blueprint $table) {
            $table->dropForeign('fk_thumbnail_news_to_news');
        });
    }
};
