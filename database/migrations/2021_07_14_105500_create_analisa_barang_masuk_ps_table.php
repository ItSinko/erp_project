<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisaBarangMasukPsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisa_barang_masuk_ps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('packing_list_id')->unsigned();
            $table->foreign('packing_list_id')->references('id')->on('packing_lists')->onDelete('cascade');
            $table->bigInteger('part_id')->unsigned();
            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('analis_id')->unsigned();
            $table->foreign('analis_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nomor', '50');
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->text('keterangan')->nullable();
            $table->enum('status', ['dibuat', 'req_analisa', 'acc_analisa', 'rej_analisa']);
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
        Schema::dropIfExists('analisa_barang_masuk_ps');
    }
}
