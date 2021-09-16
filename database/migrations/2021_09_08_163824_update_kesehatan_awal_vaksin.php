<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKesehatanAwalVaksin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kesehatan_awals', function (Blueprint $table) {
            $table->dropColumn('vaksin');
            $table->dropColumn('ket_vaksin');
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
            $table->string('vaksin')->after('karyawan_id')->nullable();
            $table->string('ket_vaksin')->after('vaksin')->nullable();
        });
    }
}
