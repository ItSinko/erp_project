<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKesehatanAwals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kesehatan_awals', function (Blueprint $table) {
            $table->dropColumn('tes_covid');
            $table->dropColumn('hasil_covid');
            $table->dropColumn('file_covid');
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
            $table->string('tes_covid')->after('pr')->nullable();
            $table->string('hasil_covid')->after('tes_covid')->nullable();
            $table->string('file_covid')->after('hasil_covid')->nullable();
        });
    }
}
