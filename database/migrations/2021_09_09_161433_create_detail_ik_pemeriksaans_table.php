<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailIkPemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_ik_pemeriksaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('list_ik_pemeriksaan_id')->unsigned();
            $table->foreign('list_ik_pemeriksaan_id')->references('id')->on('list_ik_pemeriksaans')->onDelete('cascade');
            $table->text('penerimaan');
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
        Schema::dropIfExists('detail_ik_pemeriksaans');
    }
}
