<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_karyawans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('penanggung_jawab_id')->nullable()->unsigned();
            $table->foreign('penanggung_jawab_id')->references('id')->on('karyawans')->onDelete('set null');
            $table->string('nama_penugasan', '255');
            $table->date('tanggal_pembuatan');
            $table->date('tanggal_penugasan');
            $table->date('tanggal_estimasi_selesai');
            $table->date('tanggal_selesai')->nullable();
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
        Schema::dropIfExists('peminjaman_karyawans');
    }
}
