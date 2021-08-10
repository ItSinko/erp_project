<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackingListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packing_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('po_id')->unsigned();
            $table->foreign('po_id')->references('id')->on('po_pembelians')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('nomor', '100');
            $table->enum('status', ['dibuat', 'menunggu', 'selesai']);
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
        Schema::dropIfExists('packing_lists');
    }
}
