<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInPeminjamansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->bigInteger('inventory_id')->nullable()->unsigned()->after('divisi_inventory_id');
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('set null');
            $table->integer('jumlah')->nullable();
            $table->date('tanggal_pengajuan')->nullable()->after('inventory_id');
            $table->date('tanggal_perpanjangan')->nullable()->after('tanggal_batas_pengembalian');
            $table->date('tanggal_pengembalian')->nullable()->after('tanggal_perpanjangan');
            $table->enum('status', ['draft', 'wishlist', 'menunggu', 'dipinjam', 'tolak', 'permintaan_perpanjangan', 'perpanjangan', 'tolak_perpanjangan', 'kembali'])->nullable()->after('keterangan');
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
