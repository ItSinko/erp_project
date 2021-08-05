<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTeknisiIdAndTglPenyerahanInListKalibrasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('list_kalibrasis', function (Blueprint $table) {
            $table->bigInteger('teknisi_id')->unsigned()->nullable()->after('hasil_perakitan_id');
            $table->foreign('teknisi_id')->references('id')->on('karyawans')->onDelete('set null');
            $table->date('tanggal_penyerahan')->nullable()->after('tanggal_selesai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('list_kalibrasis', function (Blueprint $table) {
            //
        });
    }
}
