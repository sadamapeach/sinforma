<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::create('mahasiswa', function (Blueprint $table) {
//             $table->string('nim', 14);
//             $table->string('nama');
//             $table->string('jurusan');
//             $table->string('univ');
//             $table->string('no_telepon');
//             $table->string('alamat');
//             $table->string('foto')->nullable();
//             $table->string('status')->default("Aktif");
//             $table->string('username');
//             $table->string('password');
//             $table->unsignedBigInteger('iduser');
//             $table->foreign('iduser')->references('id')->on('users');
//             $table->string('nip', 20)->nullable();
//             $table->foreign('nip')->references('nip')->on('admin');
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::table('mahasiswa', function (Blueprint $table) {
//             $table->dropForeign(['nip']);
//             $table->dropColumn('nip');
//         });
//     }
// };
