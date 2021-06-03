<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKesehatanTahunans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kesehatan_tahunans', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id');
            $table->integer('pemeriksa_id');
            $table->date('tgl_cek');
            $table->integer('mata_kiri');
            $table->integer('mata_kanan');
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
        Schema::dropIfExists('kesehatan_tahunans');
    }
}
