<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiLkpLupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_lkp_lups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lkp_lup_pengujian_id')->unsigned();
            $table->foreign('lkp_lup_pengujian_id')->references('id')->on('lkp_lup_pengujians')->onDelete('cascade');
            $table->bigInteger('acuan_lkp_lup_id')->unsigned();
            $table->foreign('acuan_lkp_lup_id')->references('id')->on('acuan_lkp_lups')->onDelete('cascade');
            $table->bigInteger('parameter_lkp_lup_id')->unsigned();
            $table->foreign('parameter_lkp_lup_id')->references('id')->on('parameter_lkp_lups')->onDelete('cascade');
            $table->string('nilai_parameter', '100');
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
        Schema::dropIfExists('nilai_lkp_lups');
    }
}
