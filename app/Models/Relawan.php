<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Relawan extends Model
{
    protected $table = 'relawan';

    protected $fillable = [
        'id_user',
        'id_induk_relawan',
        'nama_lengkap',
        'email',
        'tgl_lahir',
        'jenis_kelamin',
        'pendidikan',
        'pekerjaan',
        'ktp',
        'ktp_file',
        'foto_file',
        'alamat',
        'tlp',
        'jenis_relawan',
        'nomor_relawan',
    ];
    
    public function displayKtp()
    {
        return '/uploads/relawan/'.$this->id.'/'.$this->ktp_file;
    }
    public function displayFoto()
    {
        return '/uploads/relawan/'.$this->id.'/'.$this->foto_file;
    }
    public function displayFotoKtp()
    {
        return '/uploads/relawan/'.$this->id.'/'.$this->ktp_file;
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
    public function kota()
    {
        return $this->belongsTo('App\Models\Kota', 'kota_id');
    }
    public function skillUtama()
    {
        return $this->belongsTo('App\Models\Skill', 'skill_utama');
    }
    public function namaSkillUtama()
    {
        if($this->skill_utama){
            return $this->skillUtama->nama_skill;
        }else{
            return '-';
        }
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
    public function bencana()
    {
        return $this->hasMany('App\Models\RelawanBencana', 'id_relawan');
    }
    public function bencanaDetail($start, $end)
    {
        $datas = DB::table('relawan_bencana')
            ->select('bencana.id', 'bencana.judul_bencana')
            ->join('bencana', 'relawan_bencana.id_bencana', '=', 'bencana.id')
            ->where('relawan_bencana.id_relawan', '=', $this->id)
            ->where('relawan_bencana.status_join', '=', 1)
            ->where(function($query) use ($start, $end){
                $query->whereBetween('bencana.tgl_mulai', [$start, $end]);
                $query->orWhereBetween('bencana.tgl_selesai', [$start, $end]);
            })
            ->get();
        
        return $datas;
    }

    public function createNomor()
    {
        $kota = $this->kota->code;
        $nomor_urut = 'A'.sprintf("%05d", $this->id);
        $kecakapan = sprintf("%02d", $this->skill_utama);
        $nomor_relawan = $kota.'.'.$nomor_urut.'.'.$kecakapan;
        return $nomor_relawan;
    }
}
