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
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id('id_tagihan');
            $table->foreignId('id_penggunaan')->constrained('penggunaan', 'id_penggunaan');
            $table->foreignId('id_pelanggan')->constrained('pelanggan', 'id_pelanggan');
//            $table->bigInteger('id_penggunaan');
//            $table->bigInteger('id_pelanggan');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->integer('jumlah_meter');
            $table->boolean('status');
        });
//        Schema::table('tagihan', function (Blueprint $table) {
//            $table->foreign('id_penggunaan')->references('id_penggunaan')->on('penggunaan');
//            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan');
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::table('tagihan', function (Blueprint $table) {
//            $table->dropForeign(['tagihan_id_penggunaan_foreign', 'tagihan_id_pelanggan_foreign']);
//        });
        Schema::dropIfExists('tagihan');
    }
};
