<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateKondisiTerbukaColumnHasilPerakitansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE hasil_perakitans MODIFY COLUMN kondisi_terbuka ENUM('ok', 'nok')");
        Schema::table('hasil_perakitans', function (Blueprint $table) {
            $table->renameColumn('tindak_lanjut1', 'tindak_lanjut_terbuka');
            $table->renameColumn('tindak_lanjut2', 'tindak_lanjut_tertutup');
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
            $table->varchar('kondisi_terbuka', '255')->change();
            $table->renameColumn('tindak_lanjut_terbuka', 'tindak_lanjut1');
            $table->renameColumn('tindak_lanjut_tertutup', 'tindak_lanjut2');
        });
    }
}
