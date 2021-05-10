<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOperatorInPengemasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengemasans', function (Blueprint $table) {
            $table->bigInteger('karyawan_id')->nullable()->unsigned();
            $table->foreign('karyawan_id')->references('id')->on('karyawans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengemasans', function (Blueprint $table) {
            //
        });
    }
}
