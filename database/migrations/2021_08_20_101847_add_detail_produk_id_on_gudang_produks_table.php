<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailProdukIdOnGudangProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gudang_produks', function (Blueprint $table) {
            $table->bigInteger('detail_produk_id')->unsigned()->after('divisi_id');
            $table->foreign('detail_produk_id')->references('id')->on('detail_produks')->onDelete('cascade');
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
            //
        });
    }
}
