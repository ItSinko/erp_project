<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKesehatanMingguanTensis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kesehatan_mingguan_tensis', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id');
            $table->date('tgl_cek');
            $table->integer('sistolik')->nullable();
            $table->integer('diastolik')->nullable();
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
        Schema::dropIfExists('kesehatan_mingguan_tensis');
    }
}
