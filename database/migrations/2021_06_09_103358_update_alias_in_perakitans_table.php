<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAliasInPerakitansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perakitans', function (Blueprint $table) {
            $table->string('alias_tim', 20)->nullable()->after('pic_id');
            $table->removeColumn('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perakitans', function (Blueprint $table) {
            $table->removeColumn('alias_tim');
            $table->date('tanggal');
        });
    }
}
