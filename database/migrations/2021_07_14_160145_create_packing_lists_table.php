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
            $table->id();
            $table->bigInteger('suppliers_id')->unsigned();
            $table->foreign('suppliers_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('nomor', '50');
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
