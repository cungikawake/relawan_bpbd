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
}
