<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilPengemasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_pengemasans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pengemasan_id')->nullable()->unsigned();
            $table->foreign('pengemasan_id')->references('id')->on('pengemasans')->onDelete('set null');
            $table->bigInteger('hasil_perakitan_id')->nullable()->unsigned();
            $table->foreign('hasil_perakitan_id')->references('id')->on('hasil_perakitans')->onDelete('set null');
            $table->string('no_barcode', '191')->nullable();
            $table->enum('kondisi_unit', ['baik', 'kurang', 'tidak']);
            $table->enum('hasil', ['ok', 'nok']);
            $table->text('keterangan')->nullable();
            $table->enum('tindak_lanjut', ['ok', 'perbaikan', 'pengujian', 'karantina'])->nullable();
            $table->enum('status', ['req_perbaikan', 'acc_perbaikan', 'rej_perbaikan', 'req_pengujian', 'acc_pengujian', 'rej_pengujian', 'ok']);
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
        Schema::dropIfExists('hasil_pengemasans');
    }
}
