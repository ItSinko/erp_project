<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePoPembelianIdInPackingListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packing_lists', function (Blueprint $table) {
            $table->bigInteger('po_id')->unsigned()->after('id');
            $table->foreign('po_id')->references('id')->on('po_pembelians')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packing_lists', function (Blueprint $table) {
            //
        });
    }
}
