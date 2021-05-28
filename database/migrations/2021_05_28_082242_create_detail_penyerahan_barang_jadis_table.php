<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenyerahanBarangJadisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penyerahan_barang_jadis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('penyerahan_barang_jadi_id')->unsigned();
            $table->foreign('penyerahan_barang_jadi_id')->references('id')->on('penyerahan_barang_jadis')->onDelete('cascade');
            $table->bigInteger('hasil_perakitan_id')->unsigned();
            $table->foreign('hasil_perakitan_id')->references('id')->on('hasil_perakitans')->onDelete('cascade');
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
        Schema::dropIfExists('detail_penyerahan_barang_jadis');
    }
}
