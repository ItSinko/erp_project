<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersiapanPackingProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persiapan_packing_produks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bppb_id')->nullable()->unsigned();
            $table->foreign('bppb_id')->references('id')->on('bppbs')->onDelete('set null');
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->enum('status', ['req_persiapan', 'acc_persiapan', 'rej_persiapan']);
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
        Schema::dropIfExists('persiapan_packing_produks');
    }
}
