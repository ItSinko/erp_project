<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamaBarangInDetailCekPengemasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_cek_pengemasans', function (Blueprint $table) {
            $table->string('nama_barang', '191')->after('cek_pengemasan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_cek_pengemasans', function (Blueprint $table) {
            //
        });
    }
}
