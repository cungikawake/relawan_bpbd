<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabelRelawanBencanaKordinatLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relawan_bencana_kordinat_log', function (Blueprint $table) {
            $table->id(); 
            $table->integer('id_bencana');
            $table->integer('id_relawan'); 
            $table->string('lokasi_terakhir'); 
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
        Schema::dropIfExists('relawan_bencana_kordinat_log');
    }
}
