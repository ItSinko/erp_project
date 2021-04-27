<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilMonitoringProsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_monitoring_proses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('monitoring_proses_id')->nullable()->unsigned();
            $table->foreign('monitoring_proses_id')->references('id')->on('monitoring_proses')->onDelete('set null');
            $table->bigInteger('hasil_perakitan_id')->nullable()->unsigned();
            $table->foreign('hasil_perakitan_id')->references('id')->on('hasil_perakitans')->onDelete('set null');
            $table->string('no_barcode', '100')->nullable();
            $table->enum('hasil', ['ok', 'nok']);
            $table->text('keterangan')->nullable();
            $table->enum('tindak_lanjut', ['pengemasan', 'perbaikan', 'produk_spesialis', 'karantina']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil_monitoring_proses');
    }
}
