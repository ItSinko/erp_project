<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAndRemoveColumnInBppbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bppbs', function (Blueprint $table) {
            $table->dropForeign('bppbs_produk_id_foreign');
            $table->dropColumn('produk_id');
            $table->bigInteger('detail_produk_id')->nullable()->unsigned();
            $table->foreign('detail_produk_id')->references('id')->on('parts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bppbs', function (Blueprint $table) {
            $table->bigInteger('produk_id')->nullable()->unsigned();
            $table->foreign('produk_id')->references('id')->on('parts')->onDelete('set null');
            $table->dropForeign('bppbs_detail_produk_id_foreign');
            $table->dropColumn('detail_produk_id');
        });
    }
}
