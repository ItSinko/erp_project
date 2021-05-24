<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerbaikanProduksiPengujiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbaikan_produksi_pengujians', function (Blueprint $table) {
            $table->bigInteger('perbaikan_produksi_id')->unsigned();
            $table->foreign('perbaikan_produksi_id')->references('id')->on('perbaikan_produksis')->onDelete('cascade');
            $table->bigInteger('hasil_monitoring_proses_id')->unsigned();
            $table->foreign('hasil_monitoring_proses_id')->references('id')->on('hasil_monitoring_proses')->onDelete('cascade');
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
        Schema::dropIfExists('perbaikan_pengujians');
    }
}
