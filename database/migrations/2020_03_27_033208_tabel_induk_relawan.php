<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabelIndukRelawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('induk_organisasi', function (Blueprint $table) {
            $table->id(); 
            $table->string('nama_organisasi');
            $table->string('tlp_organisasi');
            $table->string('email_organisasi')->nullable(); 
            $table->string('alamat_organisasi')->nullable();
            $table->string('nama_pimpinan_organisasi')->nullable();
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
        Schema::dropIfExists('induk_organisasi');
    }
}
