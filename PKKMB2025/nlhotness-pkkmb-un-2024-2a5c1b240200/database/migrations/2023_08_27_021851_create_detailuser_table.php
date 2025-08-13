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
        Schema::create('detailuser', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->text('photo')->nullable();
            $table->char('nim')->unique();
            $table->string('nama_lengkap')->nullable();
            $table->string('prodi')->nullable();
            $table->string('fakultas')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('sistem_kuliah')->nullable();
            $table->string('tahun_angkatan')->nullable();
            $table->string('jalur_penerimaan')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailuser');
    }
};
