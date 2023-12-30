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
            $table->increments('id_skl');
            $table->string('file_skl', 100);
            $table->string('nim', 14);
            $table->string('nip_admin', 20);

            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('nip_admin')->references('nip_admin')->on('admin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skl', function (Blueprint $table) {
            $table->dropForeign(['nim']);
            $table->dropForeign(['nip_admin']);
        });

        Schema::dropIfExists('skl');
    }
};
