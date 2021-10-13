<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBeratKaryawanTensiSuhu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('berat_karyawans', function (Blueprint $table) {
            $table->double('suhu')->after('kalori')->nullable();
            $table->integer('spo2')->after('suhu')->nullable();
            $table->integer('pr')->after('spo2')->nullable();
            $table->integer('sistolik')->after('pr')->nullable();
            $table->integer('diastolik')->after('sistolik')->nullable();
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
            $table->dropColumn('suhu');
            $table->dropColumn('spo2');
            $table->dropColumn('pr');
            $table->dropColumn('sistolik');
            $table->dropColumn('diastolik');
        });
    }
}
