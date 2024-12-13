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
        Schema::create('pasien', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nama', 150);
            $table->string('alamat', 255);
            $table->string('no_ktp', 17)->unique();
            $table->string('no_hp', 15);
            $table->string('no_rm', 10)->unique(); // No rekam medis
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
