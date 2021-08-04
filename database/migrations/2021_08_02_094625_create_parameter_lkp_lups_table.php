<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParameterLkpLupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameter_lkp_lups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('acuan_lkp_lup_id')->unsigned();
            $table->foreign('acuan_lkp_lup_id')->references('id')->on('acuan_lkp_lups')->onDelete('cascade');
            $table->string('nilai_parameter', '100');
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
        Schema::dropIfExists('parameter_lkp_lups');
    }
}
