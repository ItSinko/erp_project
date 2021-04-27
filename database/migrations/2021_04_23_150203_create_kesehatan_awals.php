<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKesehatanAwals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kesehatan_awals', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_karyawan');
            $table->integer('tinggi')->nullable();
            $table->string('buta_warna')->nullable();
            $table->string('medical')->nullable();
            $table->string('rapid')->nullable();
            $table->string('hasil_rapid')->nullable();
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
        Schema::dropIfExists('kesehatan_awals');
    }
}
