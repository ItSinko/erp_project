<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPpicIdAnalisaPsPerakitansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('analisa_ps_perakitans', function (Blueprint $table) {
            $table->bigInteger('ppic_id')->nullable()->unsigned()->after('id');
            $table->foreign('ppic_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('analisa_ps_perakitans', function (Blueprint $table) {
            //
        });
    }
}
