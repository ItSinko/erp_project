<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEkatjual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekatjuals', function (Blueprint $table) {
            $table->id();
            $table->integer('distributor_id');
            $table->string('lkpp');
            $table->string('ak1');
            $table->string('despaket');
            $table->string('instansi');
            $table->string('satuankerja');
            $table->string('status');
            $table->date('tglbuat');
            $table->date('tgledit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ekatjuals');
    }
}
