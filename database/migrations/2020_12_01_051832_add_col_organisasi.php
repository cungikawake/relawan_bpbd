<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColOrganisasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('induk_organisasi', function (Blueprint $table) {
            // change() tells the Schema builder that we are altering a table
            $table->string('ketua_nama')->nullable();
            $table->string('ketua_email')->nullable();
            $table->string('ketua_tlp')->nullable();

            $table->string('sekretaris_nama')->nullable();
            $table->string('sekretaris_email')->nullable();
            $table->string('sekretaris_tlp')->nullable();
 
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
