<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListIkPemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_ik_pemeriksaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ik_pemeriksaan_id')->unsigned();
            $table->foreign('ik_pemeriksaan_id')->references('id')->on('ik_pemeriksaans')->onDelete('cascade');
            $table->text('pemeriksaan');
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
        Schema::dropIfExists('list_ik_pemeriksaans');
    }
}
