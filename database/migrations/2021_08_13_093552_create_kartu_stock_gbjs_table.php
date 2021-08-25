<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKartuStockGbjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartu_stock_gbjs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('detail_produk_id')->unsigned();
            $table->foreign('detail_produk_id')->references('id')->on('detail_produks')->onDelete('cascade');
            $table->string('nomor', '12');
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
        Schema::dropIfExists('kartu_stock_gbjs');
    }
}
