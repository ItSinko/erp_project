<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailAnalisaBarangMasukPsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_analisa_barang_masuk_ps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('analisa_barang_masuk_ps_id')->unsigned();
            $table->foreign('analisa_barang_masuk_ps_id')->references('id')->on('analisa_barang_masuk_ps')->onDelete('cascade');
            $table->text('aspek_pemeriksaan');
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
        Schema::dropIfExists('detail_analisa_barang_masuk_ps');
    }
}
