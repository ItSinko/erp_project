<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRenameAndAddJumlahOnDetailPengembalianBarangGudangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_pengembalian_barang_gudangs', function (Blueprint $table) {
            $table->bigInteger('bill_of_material_id')->unsigned()->nullable()->after('pengembalian_id');
            $table->foreign('bill_of_material_id')->references('id')->on('pengembalian_barang_gudangs')->onDelete('set null');
            $table->integer('jumlah_pengembalian')->nullable()->change();
            $table->integer('jumlah_nok')->nullable()->after('jumlah_pengembalian');
            $table->renameColumn('jumlah_pengembalian', 'jumlah_ok');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_pengembalian_barang_gudangs', function (Blueprint $table) {
            //
        });
    }
}
