<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPackingListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_packing_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('packing_list_id')->nullable()->unsigned();
            $table->foreign('packing_list_id')->references('id')->on('packing_lists')->onDelete('set null');
            $table->string('nama_barang', '255');
            $table->string('part_id', '50')->nullable();
            $table->foreign('part_id')->references('kode')->on('parts')->onDelete('set null');
            $table->bigInteger('produk_id')->nullable()->unsigned();
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('set null');
            $table->float('jumlah', '50');
            $table->enum('satuan', ['pcs', 'kg', 'set', 'box']);
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
        Schema::dropIfExists('detail_packing_lists');
    }
}
