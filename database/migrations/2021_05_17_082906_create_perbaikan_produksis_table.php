<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerbaikanProduksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbaikan_produksis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bppb_id')->nullable()->unsigned();
            $table->foreign('bppb_id')->references('id')->on('bppbs')->onDelete('set null');
            $table->bigInteger('karyawan_id')->nullable()->unsigned();
            $table->foreign('karyawan_id')->references('id')->on('karyawans')->onDelete('set null');
            $table->text('kondisi_produksi')->nullable();
            $table->enum('ketidaksesuaian_proses', ['perakitan', 'pengujian', 'pengemasan']);
            $table->enum('sebab_ketidaksesuaian', ['bahan_baku', 'operator'])->nullable();
            $table->date('tanggal_permintaan');
            $table->string('nomor', '191')->nullable();
            $table->date('tanggal_pengerjaan')->nullable();
            $table->text('analisa')->nullable();
            $table->text('realisasi_pengerjaan')->nullable();
            $table->enum('status', ['req_perbaikan', 'acc_perbaikan', 'rej_perbaikan', 'do_perbaikan', 'done_perbaikan']);
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
        Schema::dropIfExists('perbaikan_produksis');
    }
}
