<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bencana extends Model
{
    protected $table = 'bencana';

    public function displayImage()
    {
        return '/uploads/bencana/'.$this->foto_bencana;
    }
    
    public function relawan()
    {
        return $this->hasMany('App\Models\RelawanBencana', 'id_bencana');
    }
    public function allRelawan()
    {
        return $this->relawan->whereIn('status_join', [0, 1]);
    }
    public function pendingRelawan()
    {
        return $this->relawan->where('status_join', 0);
    }
    public function joinRelawan()
    {
        return $this->relawan->where('status_join', 1);
    }
    public function ditolakRelawan()
    {
        return $this->relawan->where('status_join', 2);
    }
}
