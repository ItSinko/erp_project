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
            $table->integer('karyawan_id');
            $table->string('vaksin');
            $table->string('ket_vaksin')->nullable();
            $table->double('tinggi');
            $table->double('berat');
            $table->double('lemak')->nullable();
            $table->double('kandungan_air')->nullable();
            $table->double('otot')->nullable();
            $table->double('tulang')->nullable();
            $table->double('kalori')->nullable();
            $table->string('status_mata')->nullable();
            $table->string('tes_covid')->nullable();
            $table->string('hasil_covid')->nullable();
            $table->string('file_covid')->nullable();
            $table->string('file_mcu')->nullable();
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
