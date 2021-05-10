<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanProsesPengujiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaan_proses_pengujians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bppb_id')->nullable()->unsigned();
            $table->foreign('bppb_id')->references('id')->on('bppbs')->onDelete('set null');
            $table->string('no_pemeriksaan', '50')->nullable();
            $table->date('tanggal');
            $table->integer('jumlah_produksi')->nullable();
            $table->integer('jumlah_sampling')->nullable();
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
        Schema::dropIfExists('pemeriksaan_proses_pengujians');
    }
}
