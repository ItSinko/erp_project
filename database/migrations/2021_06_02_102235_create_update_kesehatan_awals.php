<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateKesehatanAwals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kesehatan_awals', function ($table) {
            $table->double('suhu')->after('mata_kanan');
            $table->integer('spo2')->after('suhu');
            $table->integer('pr')->after('spo2');
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
            $table->id();
            $table->dropColumn('suhu');
            $table->dropColumn('spo2');
            $table->dropColumn('pr');
        });
    }
}
