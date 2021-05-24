<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerbaikanProduksiPerakitansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbaikan_produksi_perakitans', function (Blueprint $table) {
            $table->bigInteger('perbaikan_produksi_id')->unsigned();
            $table->foreign('perbaikan_produksi_id')->references('id')->on('perbaikan_produksis')->onDelete('cascade');
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
        Schema::dropIfExists('perbaikan_perakitans');
    }
}
