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
        Schema::table('ketentuan', function (Blueprint $table) {
            $table->foreign('jenis_ketentuan_id', 'fk_ketentuan_to_jenis_ketentuan')->references('id')->on('jenis_ketentuan')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ketentuan', function (Blueprint $table) {
            $table->dropForeign('fk_ketentuan_to_jenis_ketentuan');
        });
    }
};
