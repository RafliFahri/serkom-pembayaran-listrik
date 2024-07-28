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
DROP PROCEDURE IF EXISTS `proses_status_tagihan`;
CREATE PROCEDURE `proses_status_tagihan`(IN `id` INT)
BEGIN
    UPDATE tagihan t
    SET t.status = 0
    WHERE t.id_tagihan = id;
END;
        ');
        DB::unprepared('
DROP PROCEDURE IF EXISTS `confirm_status_tagihan`;
CREATE PROCEDURE `confirm_status_tagihan`(IN `id` INT, IN `id_user_confirm` INT)
BEGIN
    UPDATE tagihan t, pembayaran p
    SET t.status = 1, p.id_user = id_user_confirm
    WHERE t.id_tagihan = id AND p.id_tagihan = id;
END;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS `proses_status_tagihan`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `confirm_status_tagihan`');
    }
};
