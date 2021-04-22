<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_produks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('produk_id')->nullable()->unsigned();
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('set null');
            $table->string('nama_detail', '225');
            $table->integer('stok')->nullable();
            $table->float('harga', '20', '0')->nullable();
            $table->text('foto')->nullable();
            $table->float('berat', '10', '0')->nullable();
            $table->enum('satuan', ['pc', 'pcs', 'set', 'unit', 'dus', 'roll', 'meter', 'pack']);
            $table->text('keterangan')->nullable();
            $table->enum('status', ['ada', 'tidak_ada']);
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
        Schema::dropIfExists('detail_produks');
    }
}
