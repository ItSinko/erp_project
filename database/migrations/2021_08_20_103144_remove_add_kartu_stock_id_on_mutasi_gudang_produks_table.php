<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAddKartuStockIdOnMutasiGudangProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mutasi_gudang_produks', function (Blueprint $table) {
            $table->dropForeign('detail_kartu_stock_gbjs_kartu_stock_id_foreign');
            $table->dropColumn('kartu_stock_id');
            $table->bigInteger('gudang_produk_id')->unsigned()->after('id');
            $table->foreign('gudang_produk_id')->references('id')->on('gudang_produks')->onDelete('cascade');
            $table->bigInteger('divisi_id')->unsigned()->after('gudang_produk_id');
            $table->foreign('divisi_id')->references('id')->on('divisis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mutasi_gudang_produks', function (Blueprint $table) {
            $table->dropForeign(['gudang_produk_id']);
            $table->dropColumn('gudang_produk_id');
            $table->dropForeign(['divisi_id']);
            $table->dropColumn('divisi_id');
        });
    }
}
