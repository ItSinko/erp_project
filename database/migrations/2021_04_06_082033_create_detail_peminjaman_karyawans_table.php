<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPeminjamanKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_peminjaman_karyawans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('peminjaman_karyawan_id')->nullable()->unsigned();
            $table->foreign('peminjaman_karyawan_id')->references('id')->on('peminjaman_karyawans')->onDelete('set null');
            $table->bigInteger('karyawan_id')->nullable()->unsigned();
            $table->foreign('karyawan_id')->references('id')->on('karyawans')->onDelete('set null');
            $table->date('tanggal_pemberhentian')->nullable();
            $table->enum('status', ['draft', 'menunggu', 'terima', 'tolak', 'berhenti']);
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
        Schema::dropIfExists('detail_peminjaman_karyawans');
    }
}
