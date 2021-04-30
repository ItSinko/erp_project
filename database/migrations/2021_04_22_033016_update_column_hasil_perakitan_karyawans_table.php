<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnHasilPerakitanKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_perakitan_karyawans', function (Blueprint $table) {
            $table->unsignedBigInteger('perakitan_id')->nullable()->first();
            $table->foreign('perakitan_id')->references('id')->on('perakitans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hasil_perakitan_karyawans', function (Blueprint $table) {
            //
        });
    }
}
