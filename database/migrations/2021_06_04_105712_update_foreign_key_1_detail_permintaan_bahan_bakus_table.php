<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKey1DetailPermintaanBahanBakusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_permintaan_bahan_bakus', function (Blueprint $table) {
            $table->dropForeign(['permintaan_bahan_baku']);
            $table->dropColumn('permintaan_bahan_baku');
            $table->bigInteger('permintaan_bahan_baku_id')->unsigned()->after('bill_of_material_id');
            $table->foreign('permintaan_bahan_baku_id')->references('id')->on('permintaan_bahan_bakus')->onDelete('cascade');
            $table->integer('jumlah_diterima')->nullable();
            $table->bigIncrements('id')->first();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_permintaan_bahan_bakus', function (Blueprint $table) {
            //
        });
    }
}
