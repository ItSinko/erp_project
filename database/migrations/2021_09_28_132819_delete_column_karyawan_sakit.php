<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumnKaryawanSakit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('karyawan_sakits', function (Blueprint $table) {
            $table->dropColumn('obat_id');
            $table->dropColumn('jumlah');
            $table->dropColumn('aturan');
            $table->dropColumn('konsumsi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('karyawan_sakits', function (Blueprint $table) {
            $table->integer('obat_id')->after('terapi')->nullable();
            $table->integer('jumlah')->after('obat_id')->nullable();
            $table->string('aturan')->after('jumlah')->nullable();
            $table->string('konsumsi')->after('aturan')->nullable();
        });
    }
}
