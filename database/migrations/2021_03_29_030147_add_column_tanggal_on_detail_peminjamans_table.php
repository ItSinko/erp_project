<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTanggalOnDetailPeminjamansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_peminjamans', function (Blueprint $table) {
            $table->date('tanggal_pengembalian')->nullable()->after('inventory_id');
            $table->date('tanggal_perpanjangan')->nullable()->after('tanggal_pengembalian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_peminjamans', function (Blueprint $table) {
            //
        });
    }
}
