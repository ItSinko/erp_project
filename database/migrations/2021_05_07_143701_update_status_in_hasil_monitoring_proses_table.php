<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatusInHasilMonitoringProsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_monitoring_proses', function (Blueprint $table) {
            $table->enum('status', ['req_perbaikan', 'acc_perbaikan', 'rej_perbaikan', 'req_analisa_perbaikan', 'acc_analisa_perbaikan', 'rej_analisa_perbaikan', 'pengemasan']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hasil_monitoring_proses', function (Blueprint $table) {
            //
        });
    }
}
