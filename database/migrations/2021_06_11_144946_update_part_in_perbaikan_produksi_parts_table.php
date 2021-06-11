<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePartInPerbaikanProduksiPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perbaikan_produksi_parts', function (Blueprint $table) {
            $table->dropColumn('part_id');
            $table->bigInteger('bill_of_material_id')->nullable()->unsigned()->after('perbaikan_produksi_id');
            $table->foreign('bill_of_material_id')->references('id')->on('bill_of_materials')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perbaikan_produksi_parts', function (Blueprint $table) {
            //
        });
    }
}
