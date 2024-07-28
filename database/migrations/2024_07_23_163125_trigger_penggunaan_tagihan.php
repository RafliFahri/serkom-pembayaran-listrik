<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
CREATE TRIGGER `tr_after_insert_penggunaan` AFTER INSERT ON `penggunaan`
    FOR EACH ROW BEGIN
    DECLARE jumlah_meter INT;

    SET jumlah_meter = NEW.meter_akhir - NEW.meter_awal;

    INSERT INTO tagihan (id_penggunaan, id_pelanggan, bulan, tahun, jumlah_meter)
    VALUES (NEW.id_penggunaan, NEW.id_pelanggan, NEW.bulan, NEW.tahun, jumlah_meter);
END;');

        DB::unprepared('
CREATE TRIGGER `tr_after_insert_tagihan` AFTER INSERT ON `tagihan`
FOR EACH ROW BEGIN
    DECLARE tarifperkwh DOUBLE(10,2);
    DECLARE subtotal_bayar DOUBLE(10,2);
    DECLARE biaya_admin DOUBLE(10,2);
    DECLARE total_bayar DOUBLE(10,2);

    SELECT t.tarifperkwh INTO tarifperkwh
    FROM tarif t
    JOIN pelanggan p ON p.id_tarif = t.id_tarif
    WHERE p.id_pelanggan = NEW.id_pelanggan;

    SET subtotal_bayar = tarifperkwh * NEW.jumlah_meter;
    SET biaya_admin = subtotal_bayar * 0.01;
    SET total_bayar = subtotal_bayar + biaya_admin;

    INSERT INTO pembayaran (tanggal_pembayaran, bulan_bayar, biaya_admin, total_bayar, id_tagihan, id_pelanggan)
    VALUES (CURDATE(), NEW.bulan, biaya_admin, total_bayar, NEW.id_tagihan, NEW.id_pelanggan);
END;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_after_insert_penggunaan`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_after_insert_tagihan`');
    }
};
