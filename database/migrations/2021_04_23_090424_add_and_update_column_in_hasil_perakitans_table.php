<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddAndUpdateColumnInHasilPerakitansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_perakitans', function (Blueprint $table) {
            $table->string('keterangan_tindak_lanjut_terbuka', '255')->nullable()->after('tindak_lanjut_terbuka');
            $table->string('keterangan_tindak_lanjut_tertutup', '255')->nullable()->after('tindak_lanjut_tertutup');
            $table->enum('kondisi_setelah_proses', ['ok', 'nok'])->nullable()->after('fungsi');
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
            $table->dropColumn('kondisi_setelah_proses');
            $table->dropColumn('keterangan_tindak_lanjut_terbuka');
            $table->dropColumn('keterangan_tindak_lanjut_tertutup');
        });
    }
}
