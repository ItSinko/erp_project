<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKaryawansColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->integer('ktp')->after('jabatan')->nullable();
            $table->integer('bpjs')->after('ktp')->nullable();
            $table->date('tgl_kerja')->after('bpjs')->nullable();
            $table->string('vaksin')->after('tgl_kerja')->nullable();
            $table->date('tgllahir')->after('vaksin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->dropColumn('ktp');
            $table->dropColumn('bpjs');
            $table->dropColumn('tgl_kerja');
            $table->dropColumn('vaksin');
            $table->dropColumn('tgllahir');
        });
    }
}
