<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartEngsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_engs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('part_id')->nullable()->unsigned();
            $table->foreign('part_id')->references('id')->on('parts')->onDelete('set null');
            $table->string('kode_part', '50');
            $table->string('nama', '255');
            $table->text('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('spesifikasi')->nullable();
            $table->enum('status', ['ada', 'tidak_ada']);
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
        Schema::dropIfExists('part_engs');
    }
}
