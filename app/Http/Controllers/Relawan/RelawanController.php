<?php

namespace App\Http\Controllers\Relawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Relawan;
use App\Models\Skill;
use App\Models\SkillRelawan;
use App\Models\RelawanPelatihan;
use App\Models\RelawanPengalaman;
use App\Models\IndukOrganisasi;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Kota;

class RelawanController extends Controller
{
    public function index(){
        if(Auth::user()){
            return redirect('login');
        }else{
            return redirect('register');
        }
    }

    public function create() 
    {
        $user = Auth::user();
        $model = Relawan::where('id_user', $user->id)->first(); 
        /* if(!empty($model->id_induk_relawan) > 0){
            return redirect()->route('relawan.profile');
        } */

        //$model = new Relawan();
        $skills = Skill::orderBy('nama_skill', 'asc')->get();
        $model_skills = array();
        $organisasi = IndukOrganisasi::orderBy('nama_organisasi', 'asc')->get();
        
        $pelatihan[] = new RelawanPelatihan;
        $pengalaman[] = new RelawanPengalaman;
        $kota = Kota::orderBy('name', 'asc')->get();

        return view('relawan.register.verifikasi', compact('kota','model', 'skills', 'model_skills', 'organisasi', 'pelatihan', 'pengalaman', 'user'));
    }

    public function store(Request $request)
    { 
        $validator = Validator::make( $request->all(), [
                // 'id_user' => 'required',
                'id_induk_relawan' => 'required',
                'nama_lengkap' => 'required',
                'email' => 'required',
                'tgl_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'pendidikan' => 'required',
                'pekerjaan' => 'required',
                'ktp' => 'required',
                'ktp_file' => 'required|mimes:jpg,jpeg,png,bmp|max:5000',
                'foto_file' => 'mimes:jpg,jpeg,png,bmp|max:5000',
                'alamat' => 'required',
                'tlp' => 'required',
                //'jenis_relawan' => 'required',
                // 'nomor_relawan' => 'required',
                'skill_utama' => 'required',
                'kota' => 'required', 
                'skill' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

        }else{ 
            //dd($request->all());
            $data = Relawan::findOrFail($request->id_relawan);
            $data->id_user = $request->id_user;
            $data->id_induk_relawan = $request->id_induk_relawan;
            $data->nama_lengkap = $request->nama_lengkap;
            $data->email = $request->email;
            $data->tgl_lahir = $request->tgl_lahir;
            $data->jenis_kelamin = $request->jenis_kelamin;
            $data->pendidikan = $request->pendidikan;
            $data->pekerjaan = $request->pekerjaan;
            $data->ktp = $request->ktp;
            $data->alamat = $request->alamat;
            $data->tlp = $request->tlp;
            $data->jenis_relawan = $request->jenis_relawan;
            // $data->nomor_relawan = $request->nomor_relawan;
            $data->skill_utama = $request->skill_utama;
            $data->kota_id = $request->kota;
            $data->save();

            $user_data = Auth::user();
            $user = User::findOrFail($user_data->id);
            $user->tlp = $request->tlp;
            //$user->email = $request->email;
            $user->save();
            
            $image = $request->ktp_file; 
            $imageName = 'ktp-'.Str::slug(strtolower($request->nama_lengkap), '_').'-'.date('dmYHis').'.'.$image->guessExtension();
            $upload = $image->move(public_path('uploads/relawan/'.$data->id.'/'), $imageName);
            $data->ktp_file = $imageName;
            
            $image = $request->foto_file;
            if(!empty($image)){
                $imageName = 'foto-'.Str::slug(strtolower($request->nama_lengkap), '_').'-'.date('dmYHis').'.'.$image->guessExtension();
                $upload = $image->move(public_path('uploads/relawan/'.$data->id.'/'), $imageName);
                $data->foto_file = $imageName;
            }
            

            $data->save();
            
            $this->createSkill($request, $data);
            $this->createPelatihan($request, $data);
            $this->createPengalaman($request, $data);
            
            $password = '';
            
            /* \Mail::send(
                'mail.relawan-konfirmasi',
                compact('data','password'),
                function ($m) use ($data) {
                    $m->from('e-relawan@bpbdbali.com', 'Admin e-Relawan'); 
                    $m->to($data->email, $data->nama_lengkap);
                    $m->subject('Konfirmasi E-Relawan');
                }
            );  */

            return redirect()->route('relawan.profile')->with('message', 'Terima kasih sudah mengirim data pribadi. Silahkan untuk menunggu, anda akan dihubungi oleh tim verifikasi via telp atau email.');
        }
    }

    public function createSkill($request, $data)
    {
        $delete = SkillRelawan::where('id_relawan', '=', $data->id)->delete();
        foreach($request->skill as $row){
            $detail = new SkillRelawan();
            $detail->id_relawan = $data->id;
            $detail->id_skill = $row;
            $detail->save();

        }
    }

    public function createPelatihan($request, $data)
    {
        $delete = RelawanPelatihan::where('id_relawan', '=', $data->id)->delete();
         
        for($i=0; $i < count($request->jenis_pelatihan); $i++){

            if($request->detail_pelatihan[$i] || $request->jenis_pelatihan[$i] || $request->tempat_pelatihan[$i] || $request->penyelenggara_pelatihan[$i] || $request->tahun_pelatihan[$i]){
                $detail = new RelawanPelatihan();
                $detail->id_relawan = $data->id;
                $detail->detail_pelatihan = $request->detail_pelatihan[$i];
                $detail->jenis_pelatihan = $request->jenis_pelatihan[$i];
                $detail->tempat = $request->tempat_pelatihan[$i];
                $detail->penyelenggara = $request->penyelenggara_pelatihan[$i];
                $detail->tahun = $request->tahun_pelatihan[$i];
                $detail->save();

            }
        }
    }

    public function createPengalaman($request, $data)
    {
        $delete = RelawanPengalaman::where('id_relawan', '=', $data->id)->delete();

        for($i=0; $i < count($request->jenis_bencana); $i++){

            if($request->detail_pengalaman[$i] || $request->jenis_bencana[$i] || $request->lokasi[$i] || $request->tahun[$i]){
                $detail = new RelawanPengalaman();
                $detail->id_relawan = $data->id;
                $detail->detail_pengalaman = $request->detail_pengalaman[$i];
                $detail->jenis_bencana = $request->jenis_bencana[$i];
                $detail->lokasi = $request->lokasi[$i];
                $detail->tahun = $request->tahun[$i];
                $detail->save();

            }
        }
        
    }

    public function profile()
    {
        $user  = Auth::user();
        $model = Relawan::where('id_user', $user->id)->first();
        
        $skills = Skill::orderBy('nama_skill', 'asc')->get();
        $organisasi = IndukOrganisasi::orderBy('nama_organisasi', 'asc')->get();

        $model_skills = array();
        $pelatihan = array();
        $pengalaman = array();

        if(!empty($model)){
            $model_skills = SkillRelawan::join('skill', 'skill.id', '=', 'skill_relawan.id_skill')
                ->where('skill_relawan.id_relawan', '=', $model->id)->get();
            
            $pelatihan = $model->pelatihanEdit();
            $pengalaman = $model->pengalamanEdit();
        }
        
        //dd($pelatihan);
        return view('relawan.register.profile', compact('model', 'skills', 'model_skills', 'organisasi', 'pelatihan', 'pengalaman', 'user'));
    }

}
