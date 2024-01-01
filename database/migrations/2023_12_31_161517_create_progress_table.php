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
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 14);
            $table->foreign('nim')->references('nim')->on('mahasiswa');
            $table->string('nip_mentor', 20);
            $table->string('nip_admin', 20);
            $table->string('scan_file', 255);
            $table->string('deskripsi');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('nip_mentor')->references('nip')->on('mentor');
            $table->foreign('nip_admin')->references('nip')->on('admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
