<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerbaikanProduksiPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbaikan_produksi_parts', function (Blueprint $table) {
            $table->bigInteger('perbaikan_produksi_id')->unsigned();
            $table->foreign('perbaikan_produksi_id')->references('id')->on('perbaikan_produksis')->onDelete('cascade');
            $table->bigInteger('part_id')->unsigned();
            $table->foreign('part_id')->references('id')->on('part_engs')->onDelete('cascade');
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
        Schema::dropIfExists('perbaikan_produksi_parts');
    }
}
