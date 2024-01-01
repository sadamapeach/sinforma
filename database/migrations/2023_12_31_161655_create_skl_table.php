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
            $table->string('nim', 14);
            $table->string('nip_admin', 20);
            $table->timestamps();
            
            $table->foreign('nim')->references('nim')->on('mahasiswa');
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
