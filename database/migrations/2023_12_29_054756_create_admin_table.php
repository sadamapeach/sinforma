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
        Schema::create('admin', function (Blueprint $table) {
            $table->string('nip', 20);
            $table->string('nama');
            $table->string('no_telepon');
            $table->string('alamat');
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('iduser');
            $table->foreign('iduser')->references('id')->on('users');
            $table->string('username');
            $table->string('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
