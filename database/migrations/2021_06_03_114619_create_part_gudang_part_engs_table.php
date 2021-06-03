<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartGudangPartEngsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_gudang_part_engs', function (Blueprint $table) {
            $table->string('kode_gudang', '50');
            $table->foreign('kode_gudang')->references('kode')->on('parts')->onDelete('cascade');
            $table->string('kode_eng', '50');
            $table->foreign('kode_eng')->references('kode_part')->on('part_engs')->onDelete('cascade');
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
        Schema::dropIfExists('part_gudang_part_engs');
    }
}
