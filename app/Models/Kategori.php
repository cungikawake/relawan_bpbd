<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori_bencana';

    public function displayImage()
    {
        return '/images/bencana/'.$this->gambar;
    }
}
