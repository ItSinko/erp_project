<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisaPsPengemasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisa_ps_pengemasans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hasil_perakitan_id')->nullable()->unsigned();
            $table->foreign('hasil_perakitan_id')->references('id')->on('hasil_perakitans')->onDelete('set null');
            $table->text('analisa');
            $table->text('realisasi_pengerjaan');
            $table->enum('tindak_lanjut', ['operator', 'perbaikan', 'karantina']);
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
        Schema::dropIfExists('analisa_ps_pengemasans');
    }
}
