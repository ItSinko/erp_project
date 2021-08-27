<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriMutasiGudangProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histori_mutasi_gudang_produks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hasil_perakitan_id')->unsigned();
            $table->foreign('hasil_perakitan_id')->references('id')->on('hasil_perakitans')->onDelete('cascade');
            $table->bigInteger('mutasi_gudang_produk_id')->unsigned();
            $table->foreign('mutasi_gudang_produk_id')->references('id')->on('mutasi_gudang_produks')->onDelete('cascade');
            $table->enum('status', ['T', 'F']);
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
        Schema::dropIfExists('histori_mutasi_gudang_produks');
    }
}
