<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabelRelawanPengalaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relawan_pengalaman', function (Blueprint $table) {
            $table->id(); 
            $table->integer('id_relawan');
            $table->text('detail_pengalaman');//jenis, lokasi, tahun
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
        Schema::dropIfExists('relawan_pengalaman');
    }
}
