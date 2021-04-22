<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriHasilPerakitansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histori_hasil_perakitans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hasil_perakitan_id')->nullable()->unsigned();
            $table->foreign('hasil_perakitan_id')->references('id')->on('hasil_perakitans')->onDelete('cascade');
            $table->enum('kegiatan', ['perbaikan_pemeriksaan_terbuka', 'pemeriksaan_terbuka', 'perbaikan_pemeriksaan_tertutup', 'pemeriksaan_tertutup', 'analisa_pemeriksaan_terbuka_ps', 'analisa_pemeriksaan_tertutup_ps']);
            $table->date('tanggal');
            $table->enum('hasil', ['ok', 'nok'])->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('tindak_lanjut', ['produksi', 'operator', 'produksi_perbaikan', 'produk_spesialis', 'pengujian'])->nullable();
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
        Schema::dropIfExists('histori_hasil_perakitans');
    }
}
