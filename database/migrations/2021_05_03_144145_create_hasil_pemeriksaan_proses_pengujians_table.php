<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilPemeriksaanProsesPengujiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_pemeriksaan_proses_pengujians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pemeriksaan_id')->nullable()->unsigned();
            $table->foreign('pemeriksaan_id')->references('id')->on('pemeriksaan_proses_pengujians')->onDelete('set null');
            $table->bigInteger('hasil_ik_id')->nullable()->unsigned();
            $table->foreign('hasil_ik_id')->references('id')->on('hasil_ik_pemeriksaan_pengujians')->onDelete('set null');
            $table->integer('hasil_ok')->nullable();
            $table->integer('hasil_nok')->nullable();
            $table->integer('karantina')->nullable();
            $table->integer('perbaikan')->nullable();
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
        Schema::dropIfExists('hasil_pemeriksaan_proses_pengujians');
    }
}
