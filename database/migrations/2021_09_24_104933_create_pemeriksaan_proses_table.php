<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanProsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaan_proses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bppb_id')->unsigned();
            $table->foreign('bppb_id')->references('id')->on('bppbs')->onDelete('cascade');
            $table->string('nomor', '50');
            $table->date('tanggal');
            $table->enum('proses', ['rakit', 'aging', 'kemas', 'service']);
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
        Schema::dropIfExists('pemeriksaan_proses');
    }
}
