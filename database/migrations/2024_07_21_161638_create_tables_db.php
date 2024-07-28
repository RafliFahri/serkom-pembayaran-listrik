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
        Schema::create('level', function (Blueprint $table) {
            $table->id('id_level');
            $table->string('nama_level');
        });
        Schema::create('tarif', function (Blueprint $table) {
            $table->id('id_tarif')->primary();
            $table->integer('daya');
            $table->decimal('tarifperkwh');
        });
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('username', 125);
            $table->string('password', 255);
            $table->string('nama_admin', 125);
            $table->foreignId('id_level')->nullable()->constrained('level','id_level')->cascadeOnUpdate()->nullOnDelete();
        });
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id('id_pelanggan');
            $table->string('username', 125);
            $table->string('password', 255);
            $table->integer('nomor_kwh');
            $table->string('nama_pelanggan', 255);
            $table->string('alamat', 255);
            $table->foreignId('id_tarif')->nullable()->constrained('tarif', 'id_tarif')->cascadeOnUpdate()->nullOnDelete();
        });
        Schema::create('penggunaan', function (Blueprint $table) {
            $table->id('id_penggunaan');
            $table->foreignId('id_pelanggan')->constrained('pelanggan', 'id_pelanggan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('bulan');
            $table->integer('tahun');
            $table->integer('meter_awal');
            $table->integer('meter_akhir');
        });
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id('id_tagihan');
            $table->foreignId('id_penggunaan')->constrained('penggunaan', 'id_penggunaan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_pelanggan')->constrained('pelanggan', 'id_pelanggan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('bulan');
            $table->integer('tahun');
            $table->integer('jumlah_meter');
            $table->boolean('status')->nullable();
        });
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->foreignId('id_tagihan')->constrained('tagihan', 'id_tagihan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_pelanggan')->constrained('pelanggan', 'id_pelanggan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('tanggal_pembayaran');
            $table->integer('bulan_bayar');
            $table->double('biaya_admin');
            $table->double('total_bayar');
            $table->foreignId('id_user')->nullable()->constrained('user', 'id_user')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('tagihan');
        Schema::dropIfExists('penggunaan');
        Schema::dropIfExists('pelanggan');
        Schema::dropIfExists('user');
        Schema::dropIfExists('tarif');
        Schema::dropIfExists('level');

    }
};
