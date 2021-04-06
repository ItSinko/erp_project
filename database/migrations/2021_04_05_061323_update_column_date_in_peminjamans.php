<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnDateInPeminjamans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->date('tanggal_pengajuan')->change();
            $table->date('tanggal_peminjaman')->nullable()->change();
            $table->date('tanggal_batas_pengembalian')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            //
        });
    }
}
