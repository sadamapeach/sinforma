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
            $table->increments('id_nilai');
            $table->integer('nilai');
            $table->string('nim', 14);
            $table->string('nip_mentor', 20);

            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('nip_mentor')->references('nip')->on('mentor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->dropForeign(['nim']);
            $table->dropForeign(['nip_mentor']);
        });

        Schema::dropIfExists('nilai');
    }
};
