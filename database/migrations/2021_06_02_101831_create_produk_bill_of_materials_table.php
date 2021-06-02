<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukBillOfMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_bill_of_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('detail_produk_id')->nullable()->unsigned();
            $table->foreign('detail_produk_id')->references('id')->on('detail_produks')->onDelete('set null');
            $table->string('versi', '11')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_bill_of_materials');
    }
}
