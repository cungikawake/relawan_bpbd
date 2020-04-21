<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelawanBencana extends Model
{
    protected $table = 'relawan_bencana';
    
    public function relawan()
    {
        return $this->belongsTo('App\Models\Relawan', 'id_relawan');
    }
    public function bencana()
    {
        return $this->belongsTo('App\Models\Bencana', 'id_bencana');
    }
}
