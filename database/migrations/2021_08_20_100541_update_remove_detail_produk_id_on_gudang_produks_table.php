<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRemoveDetailProdukIdOnGudangProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gudang_produks', function (Blueprint $table) {
            $table->dropForeign('kartu_stock_gbjs_detail_produk_id_foreign');
            $table->dropColumn('detail_produk_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gudang_produks', function (Blueprint $table) {
            $table->bigInteger('detail_produk_id')->unsigned()->after('id');
            $table->foreign('detail_produk_id')->references('id')->on('detail_produks')->onDelete('cascade');
        });
    }
}
