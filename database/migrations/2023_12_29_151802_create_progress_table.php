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
            $table->increments('id_progress');
            $table->string('nim', 14);
            $table->string('nip_mentor', 20);
            $table->string('nip_admin', 20);
            $table->string('nama_mhs', 255);
            $table->string('file', 100);
            $table->string('deskripsi');
            $table->date('tanggal');
            

            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('nip_mentor')->references('nip')->on('mentor')->onDelete('cascade');
            $table->foreign('nip_admin')->references('nip')->on('admin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('progress', function (Blueprint $table) {
            $table->dropForeign(['nim']);
            $table->dropForeign(['nip_mentor']);
            $table->dropForeign(['nip_admin']);
        });

        Schema::dropIfExists('progress');
    }
};
