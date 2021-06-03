<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnInBillOfMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bill_of_materials', function (Blueprint $table) {
            $table->dropForeign(['detail_produk_id']);
            $table->dropColumn('detail_produk_id');
            $table->bigInteger('produk_bill_of_material_id')->nullable()->unsigned()->after('id');
            $table->foreign('produk_bill_of_material_id')->references('id')->on('produk_bill_of_materials')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bill_of_materials', function (Blueprint $table) {
            //
        });
    }
}
