<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilIkPemeriksaanPengujiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_ik_pemeriksaan_pengujians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ik_pemeriksaan_id')->nullable()->unsigned();
            $table->foreign('ik_pemeriksaan_id')->references('id')->on('ik_pemeriksaan_pengujians')->onDelete('set null');
            $table->string('standar_keberterimaan', '255');
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
        Schema::dropIfExists('hasil_ik_pemeriksaan_pengujians');
    }
}
