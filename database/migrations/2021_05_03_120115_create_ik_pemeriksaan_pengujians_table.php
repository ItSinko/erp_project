<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIkPemeriksaanPengujiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ik_pemeriksaan_pengujians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('detail_produk_id')->nullable()->unsigned();
            $table->foreign('detail_produk_id')->references('id')->on('detail_produks')->onDelete('set null');
            $table->string('hal_yang_diperiksa', '255');
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
        Schema::dropIfExists('ik_pemeriksaan_pengujians');
    }
}
