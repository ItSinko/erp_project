<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengemasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengemasans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bppb_id')->nullable();
            $table->foreign('bppb_id')->references('id')->on('bppbs')->onDelete('set null');
            $table->unsignedBigInteger('pic_id')->nullable();
            $table->foreign('pic_id')->references('id')->on('users')->onDelete('set null');
            $table->enum('status', ['dibuat', 'req_qc', 'acc_qc', 'rej_qc', 'acc_prd', 'rej_prd']);
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
        Schema::dropIfExists('pengemasans');
    }
}
