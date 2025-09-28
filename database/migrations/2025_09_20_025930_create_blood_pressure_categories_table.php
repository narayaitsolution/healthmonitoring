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
        Schema::create('blood_pressure_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->integer('systolic_min');
            $table->integer('systolic_max');
            $table->integer('diastolic_min');
            $table->integer('diastolic_max');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_pressure_categories');
    }
};
