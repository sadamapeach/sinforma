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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('id_mhs', 5)->primary();
            $table->string('nama');
            $table->string('jurusan');
            $table->string('instansi');
            $table->string('alamat')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('foto')->nullable();
            $table->string('status')->default("Aktif");
            $table->unsignedBigInteger('id_user');
            $table->string('nip_admin', 20)->nullable();
            $table->string('nip_mentor', 20)->nullable();
            $table->integer('check_profil')->default(0);
            $table->date('mulai_magang')->nullable();
            $table->date('selesai_magang')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('nip_admin')->references('nip')->on('admin');
            $table->foreign('nip_mentor')->references('nip')->on('mentor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
