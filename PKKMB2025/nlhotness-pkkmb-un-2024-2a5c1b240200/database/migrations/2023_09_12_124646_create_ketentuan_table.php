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
        Schema::create('ketentuan', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('jenis_ketentuan_id')->nullable()->index('fk_ketentuan_to_jenis_ketentuan');
            $table->integer('poin');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ketentuan');
    }
};
