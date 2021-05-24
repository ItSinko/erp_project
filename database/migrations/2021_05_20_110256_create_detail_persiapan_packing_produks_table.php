<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPersiapanPackingProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_persiapan_packing_produks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('persiapan_id')->nullable()->unsigned();
            $table->foreign('persiapan_id')->references('id')->on('persiapan_packing_produks')->onDelete('set null');
            $table->enum('dokumen', ['manual_book_id', 'manual_book_eng', 'sop', 'packing_list', 'sticker'])->nullable();
            $table->string('ketersediaan', '10');
            $table->text('keterangan')->nullable();
            $table->string('ukuran', '30')->nullable();
            $table->string('model', '191')->nullable();
            $table->string('warna_kertas', '191')->nullable();
            $table->enum('warna_tinta', ['hitam_putih', 'warna'])->nullable();
            $table->string('verifikasi', '191')->nullable();
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
        Schema::dropIfExists('detail_persiapan_packing_produks');
    }
}
