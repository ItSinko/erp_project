<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisaPsPerakitanPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisa_ps_perakitan_parts', function (Blueprint $table) {
            $table->bigInteger('bill_of_material_id')->nullable()->unsigned();
            $table->foreign('bill_of_material_id')->references('id')->on('bill_of_materials')->onDelete('set null');
            $table->bigInteger('analisa_ps_perakitan_id')->nullable()->unsigned();
            $table->foreign('analisa_ps_perakitan_id')->references('id')->on('analisa_ps_perakitans')->onDelete('set null');
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
        Schema::dropIfExists('analisa_ps_perakitan_parts');
    }
}
