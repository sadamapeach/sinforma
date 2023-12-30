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
        Schema::create('absen', function (Blueprint $table) {
            $table->increments('id_absen');
            $table->string('nim', 14);
            $table->string('nama_mhs', 255);
            $table->string('foto', 100);
            $table->string('status', 10)->default("Unverified");

            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absen', function (Blueprint $table) {
            $table->dropForeign(['nim']);
        });

        Schema::dropIfExists('absen');
    }
};
