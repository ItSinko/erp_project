<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPeriksaBarangMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_periksa_barang_masuks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('periksa_id')->unsigned();
            $table->foreign('periksa_id')->references('id')->on('periksa_barang_masuks')->onDelete('cascade');
            $table->bigInteger('detail_packing_list_id')->unsigned();
            $table->foreign('detail_packing_list_id')->references('id')->on('detail_packing_list')->onDelete('cascade');
            $table->bigInteger('detail_analisa_id')->unsigned();
            $table->foreign('detail_analisa_id')->references('id')->on('detail_analisa_barang_masuk_ps')->onDelete('cascade');
            $table->integer('jumlah_total');
            $table->integer('jumlah_sample');
            $table->integer('hasil_ok');
            $table->integer('hasil_nok');
            $table->text('permasalahan')->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('tindak_lanjut', ['karantina', 'perbaikan', 'tolak']);
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
        Schema::dropIfExists('detail_periksa_barang_masuks');
    }
}
