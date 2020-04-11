<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldTabelRelawanPengalaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('relawan_pengalaman', function (Blueprint $table) {
            // change() tells the Schema builder that we are altering a table
            $table->string('jenis_bencana')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('tahun')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relawan_pengalaman');
    }
}
