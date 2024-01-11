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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai');
            $table->string('id_mhs', 5);
            $table->string('nip_mentor', 20);   
            $table->timestamps();

            $table->foreign('id_mhs')->references('id_mhs')->on('mahasiswa');
            $table->foreign('nip_mentor')->references('nip')->on('mentor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
