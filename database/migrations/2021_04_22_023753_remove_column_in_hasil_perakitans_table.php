<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnInHasilPerakitansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_perakitans', function (Blueprint $table) {
            $table->dropColumn('kondisi_terbuka');
            $table->dropColumn('tindak_lanjut_terbuka');
            $table->dropColumn('kondisi_tertutup');
            $table->dropColumn('tindak_lanjut_tertutup');
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hasil_perakitans', function (Blueprint $table) {
            //
        });
    }
}
