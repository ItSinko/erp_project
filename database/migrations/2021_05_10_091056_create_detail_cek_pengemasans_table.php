<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailCekPengemasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_cek_pengemasans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cek_pengemasan_id')->nullable()->unsigned();
            $table->foreign('cek_pengemasan_id')->references('id')->on('cek_pengemasans')->onDelete('set null');
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
        Schema::dropIfExists('detail_cek_pengemasans');
    }
}
