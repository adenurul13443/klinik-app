<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nama', 150);
            $table->string('alamat', 255);
            $table->string('no_hp', 15);
            $table->integer('id_poli');
            $table->timestamps();
        
            $table->foreign('id_poli')->references('id')->on('poli')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};
