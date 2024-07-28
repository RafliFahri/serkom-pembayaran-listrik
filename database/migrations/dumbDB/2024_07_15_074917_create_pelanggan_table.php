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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id('id_pelanggan');
            $table->string('username', 125);
            $table->string('password', 255);
            $table->integer('nomor_kwh');
            $table->string('nama_pelanggan', 255);
            $table->string('alamat', 255);
            $table->foreignId('id_tarif')->constrained('tarif', 'id_tarif');
//            $table->bigInteger('id_tarif');
        });

//        Schema::table('pelanggan', function (Blueprint $table) {
//            $table->foreign('id_tarif')->references('id_tarif')->on('tarif');
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::table('pelanggan', function (Blueprint $table) {
//            $table->dropForeign('pelanggan_id_tarif_foreign');
//        });
        Schema::dropIfExists('pelanggan');
    }
};
