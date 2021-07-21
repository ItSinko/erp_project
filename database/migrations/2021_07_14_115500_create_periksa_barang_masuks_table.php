<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaBarangMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_barang_masuks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('packing_list_id')->unsigned();
            $table->foreign('packing_list_id')->references('id')->on('packing_lists')->onDelete('cascade');
            $table->string('part_id', '50');
            $table->foreign('part_id')->references('kode')->on('parts')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('karyawan_id')->unsigned();
            $table->foreign('karyawan_id')->references('id')->on('karyawans')->onDelete('cascade');
            $table->string('nomor', '50');
            $table->date('tanggal');
            $table->enum('metode', ['tidak_cek', 'sampling', 'cek_semua']);
            $table->integer('jumlah')->nullable();
            $table->integer('jumlah_sampling')->nullable();
            $table->enum('tindak_lanjut', ['terima', 'sortir_perbaikan', 'tolak']);
            $table->text('keterangan')->nullable();
            $table->enum('status', ['dibuat', 'req_pemeriksaan', 'acc_pemeriksaan', 'rej_pemeriksaan', 'analisa_pemeriksaan_ps', 'perbaikan_pemeriksaan']);
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
        Schema::dropIfExists('periksa_barang_masuks');
    }
}
