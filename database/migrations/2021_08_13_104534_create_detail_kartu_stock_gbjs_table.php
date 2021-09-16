<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailKartuStockGbjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_kartu_stock_gbjs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kartu_stock_id')->unsigned();
            $table->foreign('kartu_stock_id')->references('id')->on('kartu_stock_gbjs')->onDelete('cascade');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->float('jumlah_masuk', '20')->nullable();
            $table->float('jumlah_keluar', '20')->nullable();
            $table->float('jumlah_saldo', '20')->nullable();
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
        Schema::dropIfExists('detail_kartu_stock_gbjs');
    }
}
