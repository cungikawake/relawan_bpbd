<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanHarian extends Model
{
    protected $table = 'laporan_harian_bencana';

    protected $fillable = ['tgl_laporan','judul_laporan', 'id_bencana', 'detail_laporan', 'foto1', 'foto2', 'foto3'];
}
