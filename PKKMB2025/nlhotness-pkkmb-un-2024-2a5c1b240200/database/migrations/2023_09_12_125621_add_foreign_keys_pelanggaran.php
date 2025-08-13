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
        Schema::table('pelanggaran', function (Blueprint $table) {
            $table->foreign('peserta_id', 'fk_pelanggaran_peserta_to_users')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('panitia_id', 'fk_pelanggaran_panitia_to_users')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('ketentuan_id', 'fk_pelanggaran_to_ketentuan')->references('id')->on('ketentuan')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelanggaran', function (Blueprint $table) {
            $table->dropForeign('fk_pelanggaran_peserta_to_users');
            $table->dropForeign('fk_pelanggaran_panitia_to_users');
            $table->dropForeign('fk_pelanggaran_to_ketentuan');
        });
    }
};
