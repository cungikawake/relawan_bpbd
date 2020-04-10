<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relawan extends Model
{
    protected $table = 'relawan';
    
    public function displayKtp()
    {
        return '/uploads/relawan/'.$this->id.'/'.$this->ktp_file;
    }
    public function displayFoto()
    {
        return '/uploads/relawan/'.$this->id.'/'.$this->foto_file;
    }
}
