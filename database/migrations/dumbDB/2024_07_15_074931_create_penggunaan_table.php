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
        Schema::create('penggunaan', function (Blueprint $table) {
            $table->id('id_penggunaan');
            $table->foreignId('id_pelanggan')->constrained('pelanggan', 'id_pelanggan');
//            $table->bigInteger('id_pelanggan');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->integer('meter_awal');
            $table->integer('meter_akhir');
        });
//        Schema::table('penggunaan', function (Blueprint $table) {
//            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan');
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::table('penggunaan', function (Blueprint $table) {
//            $table->dropForeign('penggunaan_id_pelanggan_foreign');
//        });
        Schema::dropIfExists('penggunaan');
    }
};
