<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermintaanBahanBakusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permintaan_bahan_bakus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bppb_id')->unsigned();
            $table->foreign('bppb_id')->references('id')->on('bppbs')->onDelete('cascade');
            $table->bigInteger('divisi_id')->unsigned();
            $table->foreign('divisi_id')->references('id')->on('divisis')->onDelete('cascade');
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->enum('status', ['dibuat', 'req_permintaan', 'acc_permintaan', 'rej_permintaan']);
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
        Schema::dropIfExists('permintaan_bahan_bakus');
    }
}
