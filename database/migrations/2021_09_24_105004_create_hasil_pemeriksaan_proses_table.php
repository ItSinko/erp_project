<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilPemeriksaanProsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_pemeriksaan_proses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pemeriksaan_proses_id')->unsigned();
            $table->foreign('pemeriksaan_proses_id')->references('id')->on('pemeriksaan_proses')->onDelete('cascade');
            $table->bigInteger('detail_ik_pemeriksaan_id')->unsigned();
            $table->foreign('detail_ik_pemeriksaan_id')->references('id')->on('detail_ik_pemeriksaans')->onDelete('cascade');
            $table->integer('jumlah')->nullable();
            $table->integer('hasil_ok')->nullable();
            $table->integer('hasil_nok')->nullable();
            $table->enum('tindak_lanjut', ['karantina', 'perbaikan'])->nullable();
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
        Schema::dropIfExists('hasil_pemeriksaan_proses');
    }
}
