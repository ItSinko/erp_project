<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInHasilPerakitansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_perakitans', function (Blueprint $table) {
            $table->renameColumn('kondisi', 'kondisi_terbuka')->change();
            $table->enum('tindak_lanjut1', ['produksi', 'perbaikan', 'karantina', 'teknik'])->after('kondisi');
            $table->enum('kondisi_tertutup', ['ok', 'nok'])->nullable()->after('tindak_lanjut1')->after('tindak_lanjut1');
            $table->enum('tindak_lanjut2', ['produksi', 'perbaikan', 'karantina', 'teknik'])->after('kondisi_tertutup');
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
