<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateJasaEksUbahNamaKolomDanSetNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jasa_ekss', function (Blueprint $table) {
            $table->renameColumn('ekspedisi', 'nama');
            $table->string('telp')->nullable()->change();
            $table->string('alamat')->nullable()->change();
            $table->string('ket')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
