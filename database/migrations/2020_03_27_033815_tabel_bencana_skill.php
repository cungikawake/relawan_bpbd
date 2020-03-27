<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabelBencanaSkill extends Migration
{
    /**
     * skill minimal untuk 1 bencana
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bencana_skill', function (Blueprint $table) {
            $table->id(); 
            $table->integer('id_bencana');
            $table->integer('id_skill'); 
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
        Schema::dropIfExists('bencana_skill');
    }
}
