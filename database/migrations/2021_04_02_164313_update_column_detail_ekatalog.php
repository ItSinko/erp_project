<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnDetailEkatalog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_ekatjuals', function (Blueprint $table) {
            $table->renameColumn('ekatjual_id', 'ekatjuals_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_ekatjuals', function (Blueprint $table) {
            $table->renameColumn('ekatjuals_id', 'ekatjual_id');
        });
    }
}
