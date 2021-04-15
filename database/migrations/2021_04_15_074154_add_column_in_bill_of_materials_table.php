<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInBillOfMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bill_of_materials', function (Blueprint $table) {
            $table->bigIncrements('id')->first();
            $table->bigInteger('detail_produk_id')->nullable()->unsigned()->after('id');
            $table->foreign('detail_produk_id')->references('id')->on('detail_produks')->onDelete('set null');
            $table->bigInteger('part_eng_id')->nullable()->unsigned()->after('detail_produk_id');
            $table->foreign('part_eng_id')->references('id')->on('part_engs')->onDelete('set null');
            $table->string('model', '100')->nullable()->after('part_eng_id');
            $table->enum('status', ['ada', 'tidak_ada'])->after('satuan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bill_of_materials', function (Blueprint $table) {
            //
        });
    }
}
