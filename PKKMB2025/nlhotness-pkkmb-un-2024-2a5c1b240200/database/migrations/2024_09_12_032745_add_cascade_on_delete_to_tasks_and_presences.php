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
        // Ubah foreign key di tabel task
        Schema::table('task', function (Blueprint $table) {
            // Hapus foreign key yang lama
            $table->dropForeign(['user_id']);
            
            // Tambahkan kembali foreign key dengan cascade on delete
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });

        // Ubah foreign key di tabel presences
        Schema::table('presences', function (Blueprint $table) {
            // Hapus foreign key yang lama
            $table->dropForeign(['user_id']);
            
            // Tambahkan kembali foreign key dengan cascade on delete
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan perubahan (restore foreign key tanpa cascade)
        Schema::table('task', function (Blueprint $table) {
            // Hapus foreign key yang baru
            $table->dropForeign(['user_id']);
            
            // Tambahkan kembali foreign key tanpa cascade
            $table->foreign('user_id')
                  ->references('id')->on('users');
        });

        Schema::table('presences', function (Blueprint $table) {
            // Hapus foreign key yang baru
            $table->dropForeign(['user_id']);
            
            // Tambahkan kembali foreign key tanpa cascade
            $table->foreign('user_id')
                  ->references('id')->on('users');
        });
    }
};
