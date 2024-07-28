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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->foreignId('id_tagihan')->constrained('tagihan', 'id_tagihan');
            $table->foreignId('id_pelanggan')->constrained('pelanggan', 'id_pelanggan');
//            $table->bigInteger('id_tagihan');
//            $table->bigInteger('id_pelanggan');
            $table->date('tanggal_pembayaran');
            $table->integer('bulan_bayar');
            $table->double('biaya_admin');
            $table->double('total_bayar');
            $table->foreignId('id_user')->constrained('user', 'id_user');
        });
//        Schema::table('pembayaran', function (Blueprint $table) {
//            $table->foreign('id_tagihan')->references('id_tagihan')->on('tagihan');
//            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan');
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::table('pembayaran', function (Blueprint $table) {
//            $table->dropForeign('pembayaran_id_tagihan_foreign');
//            $table->dropForeign('pembayaran_id_pelanggan_foreign');
//        });
        Schema::dropIfExists('pembayaran');
    }
};
