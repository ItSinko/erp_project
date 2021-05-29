<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyerahanBarangJadisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyerahan_barang_jadis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bppb_id')->unsigned();
            $table->foreign('bppb_id')->references('id')->on('bppbs')->onDelete('cascade');
            $table->bigInteger('divisi_id')->unsigned();
            $table->foreign('divisi_id')->references('id')->on('divisis')->onDelete('cascade');
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->enum('status', ['dibuat', 'req_penyerahan', 'penyerahan']);
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
        Schema::dropIfExists('penyerahan_barang_jadis');
    }
}
