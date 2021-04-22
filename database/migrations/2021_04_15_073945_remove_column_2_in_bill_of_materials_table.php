<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumn2InBillOfMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bill_of_materials', function (Blueprint $table) {
            $table->dropForeign('bill_of_materials_produk_id_foreign');
            $table->dropIndex('bill_of_materials_produk_id_foreign');
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
