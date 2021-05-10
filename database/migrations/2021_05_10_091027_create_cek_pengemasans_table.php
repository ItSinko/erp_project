<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCekPengemasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cek_pengemasans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('detail_produk_id')->nullable()->unsigned();
            $table->foreign('detail_produk_id')->references('id')->on('detail_produks')->onDelete('set null');
            $table->string('perlengkapan', '100');
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
        Schema::dropIfExists('cek_pengemasans');
    }
}
