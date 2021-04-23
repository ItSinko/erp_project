<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateColumnStatusInHasilPerakitansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_perakitans', function (Blueprint $table) {
            DB::statement("ALTER TABLE hasil_perakitans MODIFY COLUMN tindak_lanjut_terbuka ENUM('ok','operator','perbaikan','karantina','ps') NULL");
            DB::statement("ALTER TABLE hasil_perakitans MODIFY COLUMN tindak_lanjut_tertutup ENUM('ok','operator','perbaikan','karantina','ps','aging') NULL");
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
