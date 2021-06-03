<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePrimaryInPartEngsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('part_engs', function (Blueprint $table) {
            $table->dropPrimary('id');
            $table->dropColumn('id');

            $table->string('kode_part', '50')->primary()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('part_engs', function (Blueprint $table) {
            //
        });
    }
}
