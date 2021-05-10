<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringProsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring_proses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bppb_id')->nullable()->unsigned();
            $table->foreign('bppb_id')->references('id')->on('bppbs')->onDelete('set null');
            $table->date('tanggal');
            $table->bigInteger('karyawan_id')->nullable()->unsigned();
            $table->foreign('karyawan_id')->references('id')->on('karyawans')->onDelete('set null');
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('monitoring_proses');
    }
}
