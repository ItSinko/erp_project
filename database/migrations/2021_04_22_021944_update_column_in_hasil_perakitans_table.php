<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnInHasilPerakitansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_perakitans', function (Blueprint $table) {
            $table->enum('kondisi_fisik_bahan_baku', ['ok', 'nok'])->nullable()->after('no_seri');
            $table->enum('kondisi_saat_proses_perakitan', ['ok', 'nok'])->nullable()->after('kondisi_fisik_bahan_baku');
            $table->enum('tindak_lanjut_terbuka', ['operator', 'perbaikan', 'karantina', 'ps'])->nullable()->after('kondisi_saat_proses_perakitan');
            $table->enum('fungsi', ['ok', 'nok'])->nullable()->after('tindak_lanjut_terbuka');
            $table->enum('hasil', ['ok', 'nok'])->nullable()->after('fungsi');
            $table->enum('tindak_lanjut_tertutup', ['operator', 'perbaikan', 'karantina', 'ps'])->nullable()->after('hasil');
            $table->enum('status', ['dibuat', 'req_pemeriksaan_terbuka', 'acc_pemeriksaan_terbuka', 'perbaikan_pemeriksaan_terbuka', 'analisa_pemeriksaan_terbuka_ps', 'rej_pemeriksaan_terbuka', 'req_pemeriksaan_tertutup', 'acc_pemeriksaan_tertutup', 'perbaikan_pemeriksaan_tertutup', 'analisa_pemeriksaan_tertutup_ps', 'rej_pemeriksaan_tertutup'])->after('keterangan');
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
