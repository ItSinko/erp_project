<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTensiKesehatanAwals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kesehatan_awals', function (Blueprint $table) {
            $table->string('sistolik')->after('pr')->nullable();
            $table->string('diastolik')->after('sistolik')->nullable();
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
            $table->dropColumn('sistolik');
            $table->dropColumn('diastolik');
        });
    }
}
