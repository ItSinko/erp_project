<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringProsesIkPengujiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring_proses_ik_pengujians', function (Blueprint $table) {
            $table->bigInteger('monitoring_id')->unsigned();
            $table->foreign('monitoring_id')->references('id')->on('hasil_monitoring_proses')->onDelete('cascade');
            $table->bigInteger('hasil_ik_id')->unsigned();
            $table->foreign('hasil_ik_id')->references('id')->on('hasil_ik_pemeriksaan_pengujians')->onDelete('cascade');
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('monitoring_proses_ik_pengujians');
    }
}
