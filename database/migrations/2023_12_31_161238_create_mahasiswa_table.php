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
            $table->string('nim', 14)->primary();
            $table->string('nama');
            $table->string('jurusan');
            $table->string('instansi');
            $table->string('alamat');
            $table->string('no_telepon');
            $table->string('email');
            $table->string('foto')->nullable();
            $table->string('status')->default("Aktif");
            $table->unsignedBigInteger('id_user');
            $table->string('nip', 20)->nullable();
            $table->integer('check_profil')->default(0);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('nip')->references('nip')->on('mentor');
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
