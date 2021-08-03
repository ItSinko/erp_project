<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListKalibrasiInternalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_kalibrasi_internals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kalibrasi_internal_id')->unsigned();
            $table->foreign('kalibrasi_internal_id')->references('id')->on('kalibrasi_internals')->onDelete('cascade');
            $table->bigInteger('hasil_perakitan_id')->unsigned();
            $table->foreign('hasil_perakitan_id')->references('id')->on('hasil_perakitans')->onDelete('cascade');
            $table->date('tanggal_kalibrasi')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->enum('hasil', ['ok', 'nok'])->nullable();
            $table->enum('tindak_lanjut', ['karantina', 'perbaikan', 'qc', 'ok'])->nullable();
            $table->enum('status', ['req_kalibrasi', 'acc_kalibrasi', 'rej_kalibrasi', 'analisa_kalibrasi_ps', 'perbaikan_kalibrasi']);
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
        Schema::dropIfExists('list_kalibrasi_internals');
    }
}
