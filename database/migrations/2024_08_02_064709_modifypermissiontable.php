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
        Schema::table('permissions', function (Blueprint $table) {
            // Menghapus kolom 'librarien_id' yang ada
            $table->dropForeign(['librarien_id']);
            $table->dropColumn('librarien_id');


            $table->string('librarian')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            // Menghapus kolom 'librarian' yang baru
            $table->dropColumn('librarian');

            // Menambahkan kembali kolom 'librarien_id' dengan tipe data foreignId
            $table->foreignId('librarien_id')->constrained('users');
        });
    }
};
