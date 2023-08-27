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
        Schema::create('atribut_penilaian', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('kriteria_id');
            $table->string('nama_atribut', 30);
            $table->float('bobot', 4, 2);
            $table->foreign('kriteria_id')->references('id')->on('kriteria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atribut_penilaian');
    }
};
