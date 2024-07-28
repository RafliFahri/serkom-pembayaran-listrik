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
            $table->foreignId('id_level')->constrained('level','id_level');
//            $table->bigInteger('id_level');
        });
//        Schema::table('user', function (Blueprint $table) {
//            $table->foreign('id_level')->references('id_level')->on('level');
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::table('user', function (Blueprint $table) {
//            $table->dropForeign('user_id_level_foreign');
//        });
        Schema::dropIfExists('user');
    }
};
