<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilPengemasanDetailCekPengemasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_pengemasan_detail_cek_pengemasans', function (Blueprint $table) {
            $table->bigInteger('hasil_id')->unsigned();
            $table->foreign('hasil_id')->references('id')->on('hasil_pengemasans')->onDelete('cascade');
            $table->bigInteger('detail_cek_id')->unsigned();
            $table->foreign('detail_cek_id')->references('id')->on('detail_cek_pengemasans')->onDelete('cascade');
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
        Schema::dropIfExists('hasil_pengemasan_detail_cek_pengemasans');
    }
}
