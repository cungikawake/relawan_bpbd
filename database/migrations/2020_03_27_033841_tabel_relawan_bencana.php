<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabelRelawanBencana extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relawan_bencana', function (Blueprint $table) {
            $table->id(); 
            $table->integer('id_bencana');
            $table->integer('id_relawan');
            $table->datetime('tgl_join');
            $table->string('durasi_join'); 
            $table->integer('status_join'); //0 = belum aktif, 1 = sedang aktif
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
        Schema::dropIfExists('relawan_bencana');
    }
}
