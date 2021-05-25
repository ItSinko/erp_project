<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanMasuks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan_masuks', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id');
            $table->integer('pemeriksa_id');
            $table->integer('karyawan_sakit_id')->nullable();
            $table->date('tgl_cek');
            $table->string('alasan')->nullable();
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
        Schema::dropIfExists('karyawan_masuks');
    }
}
