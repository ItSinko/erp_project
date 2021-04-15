<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInStatusHasilPerakitansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_perakitans', function (Blueprint $table) {
            $table->enum('status', ['dibuat', 'req_pemeriksaan_terbuka', 'acc_pemeriksaan_terbuka', 'rej_pemeriksaan_terbuka', 'req_pemeriksaan_tertutup', 'acc_pemeriksaan_tertutup', 'rej_pemeriksaan_tertutup'])->nullable()->after('keterangan');
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
