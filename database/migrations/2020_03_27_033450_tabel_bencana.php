<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabelBencana extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bencana', function (Blueprint $table) {
            $table->id(); 
            $table->string('judul_bencana');
            $table->string('nama_pelaksana');
            $table->string('instansi');
            $table->string('jenis_bencana');
            $table->string('quota_relawan');
            $table->string('status_jenis');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->text('skill_minimal');
            $table->text('mental_minimal');
            $table->text('detail_tugas');
            $table->string('durasi_tugas');
            $table->text('lokasi_tugas');
            $table->text('koordinat_tugas');
            $table->string('supervisi_tugas');
            $table->text('jaminan_perlindungan');
            $table->string('kordinator_relawan')->nullable();
            $table->text('foto_bencana');
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
        Schema::dropIfExists('bencana');
    }
}
