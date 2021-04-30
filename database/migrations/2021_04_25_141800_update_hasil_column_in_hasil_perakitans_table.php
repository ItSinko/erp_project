<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHasilColumnInHasilPerakitansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_perakitans', function (Blueprint $table) {
            $table->renameColumn('hasil', 'hasil_tertutup');
            $table->enum('hasil_terbuka', ['ok', 'nok'])->after('kondisi_saat_proses_perakitan');
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
            $table->renameColumn('hasil_tertutup', 'hasil');
            $table->dropColumn('hasil_terbuka');
        });
    }
}
