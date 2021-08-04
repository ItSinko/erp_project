<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormatLkpLupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('format_lkp_lups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('produk_id')->unsigned();
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
            $table->string('nama_pengecekan', '255');
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
        Schema::dropIfExists('format_lkp_lups');
    }
}
