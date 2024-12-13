<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pasien', function (Blueprint $table) {
            $table->string('no_rm', 20)->change(); // Memperbesar panjang kolom
        });
    }

    public function down()
    {
        Schema::table('pasien', function (Blueprint $table) {
            $table->string('no_rm', 8)->change(); // Kembalikan ke ukuran sebelumnya jika perlu
        });
    }
};
