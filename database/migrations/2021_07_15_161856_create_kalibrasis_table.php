<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKalibrasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kalibrasis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bppb_id')->unsigned();
            $table->foreign('bppb_id')->references('id')->on('bppbs')->onDelete('cascade');
            $table->bigInteger('hasil_perakitan_id')->unsigned();
            $table->foreign('hasil_perakitan_id')->references('id')->on('hasil_perakitans')->onDelete('cascade');
            $table->bigInteger('karyawan_id')->unsigned();
            $table->foreign('karyawan_id')->references('id')->on('karyawans')->onDelete('cascade');
            $table->date('tanggal');
            $table->enum('tindak_lanjut', ['karantina', 'perbaikan']);
            $table->enum('hasil', ['ok', 'nok']);
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('kalibrasis');
    }
}
