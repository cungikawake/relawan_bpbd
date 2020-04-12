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
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
    public function userVerifyDisplay()
    {
        if($this->id_user){
            return $this->user->verifyDisplay();
        }else{
            return '<span class="badge badge-light">Unverified</span>';
        }
    }
    public function userVerifyCheck()
    {
        if($this->id_user){
            if($this->user->status_verified){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function induk_organisasi()
    {
        return $this->belongsTo('App\Models\IndukOrganisasi', 'id_induk_relawan');
    }
    public function skills()
    {
        return $this->hasMany('App\Models\SkillRelawan', 'id_relawan');
    }
    public function pelatihan()
    {
        return $this->hasMany('App\Models\RelawanPelatihan', 'id_relawan');
    }
    public function pelatihanEdit()
    {
        if(count($this->pelatihan)){
            return $this->pelatihan;
        }else{
            $data[] = new \App\Models\RelawanPelatihan;
            return $data;
        }
    }
    public function pengalaman()
    {
        return $this->hasMany('App\Models\RelawanPengalaman', 'id_relawan');
    }
    public function pengalamanEdit()
    {
        if(count($this->pengalaman)){
            return $this->pengalaman;
        }else{
            $data[] = new \App\Models\RelawanPengalaman;
            return $data;
        }
    }
}
