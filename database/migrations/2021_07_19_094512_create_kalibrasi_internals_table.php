<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKalibrasiInternalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kalibrasi_internals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bppb_id')->unsigned();
            $table->foreign('bppb_id')->references('id')->on('bppbs')->onDelete('cascade');
            $table->date('tanggal_daftar');
            $table->string('no_pendaftaran', '50');
            $table->bigInteger('pic_id')->nullable()->unsigned();
            $table->foreign('pic_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('kalibrasi_internals');
    }
}
