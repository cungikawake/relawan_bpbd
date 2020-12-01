<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColRelawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('relawan', function (Blueprint $table) {
            // change() tells the Schema builder that we are altering a table
            $table->integer('provinsi_domisili')->nullable(); 
            $table->integer('kota_domisili')->nullable(); 
            $table->integer('kec_domisili')->nullable(); 
            $table->integer('desa_domisili')->nullable(); 
            $table->string('alamat_domisili')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
