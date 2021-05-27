<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKesehatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kesehatan_awals', function (Blueprint $table) {
            $table->integer('mata_kiri')->after('status_mata')->nullable();
            $table->integer('mata_kanan')->after('mata_kiri')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kesehatan_awals', function (Blueprint $table) {
            $table->dropColumn('mata_kiri');
            $table->dropColumn('mata_kanan');
        });
    }
}
