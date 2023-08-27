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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('alternatif_id');
            $table->integer('kriteria_id');
            $table->year('tahun_awal', 4);
            $table->year('tahun_akhir', 4);
            $table->float('value', 7, 4);

            $table->foreign('alternatif_id')->references('id')->on('alternatif')->onDelete('cascade');

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
        Schema::dropIfExists('penilaian');
    }
};
