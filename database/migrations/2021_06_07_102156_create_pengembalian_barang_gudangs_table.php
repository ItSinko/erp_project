<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembalianBarangGudangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembalian_barang_gudangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bppb_id')->nullable()->unsigned();
            $table->foreign('bppb_id')->references('id')->on('bppbs')->onDelete('set null');
            $table->bigInteger('divisi_id')->unsigned();
            $table->foreign('divisi_id')->references('id')->on('divisis')->onDelete('set null');
            $table->date('tanggal');
            $table->enum('status', ['dibuat', 'req_pengembalian', 'acc_pengembalian', 'rej_pengembalian']);
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
        Schema::dropIfExists('pengembalian_barang_gudangs');
    }
}
