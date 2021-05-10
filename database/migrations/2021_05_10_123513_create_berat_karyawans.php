<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeratKaryawans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berat_karyawans', function (Blueprint $table) {
            $table->id();
            $table->integer('kesehatan_awal_id');
            $table->date('tgl_cek');
            $table->double('berat');
            $table->double('lemak')->nullable();
            $table->double('kandungan_air')->nullable();
            $table->double('otot')->nullable();
            $table->double('tulang')->nullable();
            $table->double('kalori')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('berat_karyawans');
    }
}
