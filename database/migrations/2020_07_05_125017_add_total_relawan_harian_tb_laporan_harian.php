<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalRelawanHarianTbLaporanHarian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laporan_harian_bencana', function (Blueprint $table) {
            // change() tells the Schema builder that we are altering a table
            $table->integer('jml_relawan_private')->nullable(); 
            $table->integer('jml_relawan_umum')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_harian_bencana');
    }
}
