<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBeratKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('berat_karyawans', function (Blueprint $table) {
            $table->renameColumn('kesehatan_awal_id', 'karyawan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('berat_karyawans', function (Blueprint $table) {
            $table->renameColumn('karyawan_id', 'kesehatan_awal_id');
        });
    }
}
