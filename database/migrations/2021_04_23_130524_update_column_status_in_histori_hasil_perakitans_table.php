<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateColumnStatusInHistoriHasilPerakitansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('histori_hasil_perakitans', function (Blueprint $table) {
            DB::statement("ALTER TABLE histori_hasil_perakitans MODIFY COLUMN tindak_lanjut ENUM('ok','operator','perbaikan','karantina','ps','aging') NULL");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('histori_hasil_perakitans', function (Blueprint $table) {
            //
        });
    }
}
