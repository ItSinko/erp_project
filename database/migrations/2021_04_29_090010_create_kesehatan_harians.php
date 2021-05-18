<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKesehatanHarians extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kesehatan_harians', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_cek');
            $table->string('karyawan_id');
            $table->double('suhu_pagi')->nullable();
            $table->double('suhu_siang')->nullable();
            $table->integer('spo2')->nullable();
            $table->integer('pr')->nullable();
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
        Schema::dropIfExists('kesehatan_harians');
    }
}
