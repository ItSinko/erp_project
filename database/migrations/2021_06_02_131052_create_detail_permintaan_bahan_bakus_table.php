<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPermintaanBahanBakusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_permintaan_bahan_bakus', function (Blueprint $table) {
            $table->bigInteger('permintaan_bahan_baku')->nullable()->unsigned();
            $table->foreign('permintaan_bahan_baku')->references('id')->on('permintaan_bahan_bakus')->onDelete('set null');
            $table->bigInteger('part_eng_id')->nullable()->unsigned();
            $table->foreign('part_eng_id')->references('id')->on('part_engs')->onDelete('cascade');
            $table->integer('jumlah_diminta');
            $table->integer('jumlah_diterima');
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
        Schema::dropIfExists('detail_permintaan_bahan_bakus');
    }
}
