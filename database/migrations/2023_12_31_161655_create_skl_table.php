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
        Schema::create('skl', function (Blueprint $table) {
            $table->id();
            $table->string('file_skl', 255);
            $table->string('id_mhs', 5);
            $table->string('nip_admin', 20);
            $table->timestamps();
            
            $table->foreign('id_mhs')->references('id_mhs')->on('mahasiswa');
            $table->foreign('nip_admin')->references('nip')->on('admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skl');
    }
};
