<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabelRelawanPelatihan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relawan_pelatihan', function (Blueprint $table) {
            $table->id(); 
            $table->integer('id_relawan');
            $table->text('detail_pelatihan')->nullable();//tempat, jenis, penyelenggara, tahun
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
        Schema::dropIfExists('relawan_pelatihan');
    }
}
