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
        Schema::create('generate_account', function (Blueprint $table) {
            $table->id();
            $table->string('id_mhs', 5);
            $table->string('nama', 255);
            $table->string('username');
            $table->text('password');
            $table->timestamps();
            
            $table->foreign('id_mhs')->references('id_mhs')->on('mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generate_account');
    }
};
