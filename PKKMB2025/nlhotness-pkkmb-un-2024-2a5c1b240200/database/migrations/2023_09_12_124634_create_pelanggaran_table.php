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
        Schema::create('pelanggaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peserta_id')->nullable()->index('fk_pelanggaran_peserta_to_users');
            $table->foreignId('panitia_id')->nullable()->index('fk_pelanggaran_panitia_to_users');
            $table->foreignId('ketentuan_id')->nullable()->index('fk_pelanggaran_to_ketentuan');
            $table->string('title');
            $table->string('poin');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggaran');
    }
};
