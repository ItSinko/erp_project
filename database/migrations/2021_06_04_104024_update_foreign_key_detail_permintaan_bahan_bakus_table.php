<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyDetailPermintaanBahanBakusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_permintaan_bahan_bakus', function (Blueprint $table) {
            $table->bigInteger('bill_of_material_id')->unsigned()->after('permintaan_bahan_baku');
            $table->foreign('bill_of_material_id')->references('id')->on('bill_of_materials')->onDelete('cascade');
            $table->renameColumn('permintaan_bahan_baku', 'permintaan_bahan_baku_id');
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
