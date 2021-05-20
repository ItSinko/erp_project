<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGcuKaryawans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gcu_karyawans', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id');
            $table->date('tgl_cek');
            $table->integer('glukosa')->nullable();
            $table->integer('kolesterol')->nullable();
            $table->integer('asam_urat')->nullable();
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
        Schema::dropIfExists('gcu_karyawans');
    }
}
