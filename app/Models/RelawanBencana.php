<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Relawan; 

class RelawanBencana extends Model
{
    protected $table = 'relawan_bencana';
    
    public function relawan()
    {
        return $this->belongsTo('App\Models\Relawan', 'id_relawan');
    }

    public function relawanDisplay()
    {
        if($this->relawan){
            return $this->relawan;
        }else{
            $data = new Relawan();
            $data->nama_lengkap = 'Data tidak ditemukan';
            return $data;
        }
    }
    
    public function bencana()
    {
        return $this->belongsTo('App\Models\Bencana', 'id_bencana');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

     
}
