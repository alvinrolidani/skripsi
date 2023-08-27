<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbandingan_kriteria', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('kriteria_pertama');
            $table->integer('kriteria_kedua');
            $table->integer('kepentingan');
            $table->float('nilai', 4, 2);

            $table->foreign('kriteria_pertama')->references('id')->on('kriteria')->onDelete('cascade');

            $table->foreign('kriteria_kedua')->references('id')->on('kriteria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perbandingan_kriteria');
    }
};
