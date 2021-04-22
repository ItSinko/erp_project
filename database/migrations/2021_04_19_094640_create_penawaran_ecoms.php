<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenawaranEcoms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penawaran_ecoms', function (Blueprint $table) {
            $table->id();
            $table->integer('ecommerce_id');
            $table->string('tujuan');
            $table->longtext('deskripsi');
            $table->date('tgl_surat');
            $table->integer('karyawan_id');
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
        Schema::dropIfExists('penawaran_ecoms');
    }
}
