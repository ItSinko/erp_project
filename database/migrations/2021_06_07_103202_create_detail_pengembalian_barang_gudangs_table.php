<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPengembalianBarangGudangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pengembalian_barang_gudangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pengembalian_id')->unsigned();
            $table->foreign('pengembalian_id')->references('id')->on('pengembalian_barang_gudangs')->onDelete('cascade');
            $table->integer('jumlah_pengembalian');
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
        Schema::dropIfExists('detail_pengembalian_barang_gudangs');
    }
}
