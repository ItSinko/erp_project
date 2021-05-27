<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanSakits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan_sakits', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_cek');
            $table->integer('karyawan_id');
            $table->integer('pemeriksa_id');
            $table->string('analisa')->nullable();
            $table->string('diagnosa')->nullable();
            $table->string('tindakan')->nullable();
            $table->string('terapi')->nullable();
            $table->integer('obat_id')->nullable();
            $table->string('aturan')->nullable();
            $table->string('konsumsi')->nullable();
            $table->string('keputusan')->nullable();
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
        Schema::dropIfExists('karyawan_sakits');
    }
}
