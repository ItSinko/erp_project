<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcuanLkpLupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acuan_lkp_lups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('format_lkp_lup_id')->unsigned();
            $table->foreign('format_lkp_lup_id')->references('id')->on('format_lkp_lups')->onDelete('cascade');
            $table->string('nama_parameter', '100');
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
        Schema::dropIfExists('acuan_lkp_lups');
    }
}
