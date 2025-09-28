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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['pasien', 'nakes', 'admin'])->default('pasien');
            $table->enum('gender', ['laki-laki', 'perempuan'])->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('height')->nullable()->comment('Height in cm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'gender', 'birth_date', 'height']);
        });
    }
};
