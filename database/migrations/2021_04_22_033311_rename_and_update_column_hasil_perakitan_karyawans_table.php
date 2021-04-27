<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAndUpdateColumnHasilPerakitanKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_perakitan_karyawans', function (Blueprint $table) {
            $table->dropForeign('hasil_perakitan_karyawans_hasil_perakitan_id_foreign');
            $table->dropColumn('hasil_perakitan_id');
        });
        Schema::rename('hasil_perakitan_karyawans', 'perakitan_karyawans');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hasil_perakitan_karyawans', function (Blueprint $table) {
            Schema::drop('hasil_perakitan_karyawans');
            Schema::dropIfExists('hasil_perakitan_karyawans');
        });
    }
}
