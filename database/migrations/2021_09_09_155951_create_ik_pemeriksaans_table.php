<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIkPemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ik_pemeriksaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('detail_produk_id')->unsigned();
            $table->foreign('detail_produk_id')->references('id')->on('detail_produks')->onDelete('cascade');
            $table->string('proses', '50');
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
        Schema::dropIfExists('ik_pemeriksaans');
    }
}
