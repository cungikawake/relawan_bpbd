<?php

namespace App\Http\Controllers\Api;


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


class RelawanController extends Controller
{
    //
    public function organisasi(){
        $organisasi = IndukOrganisasi::orderBy('nama_organisasi', 'asc')->get();
        return response()->json($organisasi, 200);
    }

    public function skill(){
        $skills = Skill::orderBy('nama_skill', 'asc')->get();
        return response()->json($skills, 200);
    }

    public function store(Request $request)
    { 
        $validator = Validator::make( $request->all(), [
                'id_user' => 'required',
                'id_induk_relawan' => 'required',
                'nama_lengkap' => 'required',
                'email' => 'required',
                'tgl_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'pendidikan' => 'required',
                'pekerjaan' => 'required',
                'ktp' => ['required', 'string', 'min:16'],
                'ktp_file' => 'required',
                'foto_file' => 'required',
                'alamat' => 'required',
                'tlp' => 'required',
                //'jenis_relawan' => 'required',
                // 'nomor_relawan' => 'required',

                'skill' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->json(['data' => $validator->errors()], 401);

        }else{ 
            $cekdata = Relawan::where('id_user', $request->id_user)
                ->orWhere('email', $request->email)
                ->orWhere('ktp', $request->ktp)
                ->orWhere('tlp', $request->tlp)
                ->get();

            if(count($cekdata) > 0){
                return redirect()->json(['data' => 'Data sudah pernah dikirim'], 401);
            }

            $data = new Relawan();
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
            $data->save();
            
            $image = $request->ktp_file;
            $imageName = 'ktp-'.Str::slug(strtolower($request->nama_lengkap), '_').'-'.date('dmYHis').'.'.$image->guessExtension();
            $upload = $image->move(public_path('uploads/relawan/'.$data->id.'/'), $imageName);
            $data->ktp_file = $imageName;
            
            $image = $request->foto_file;
            $imageName = 'foto-'.Str::slug(strtolower($request->nama_lengkap), '_').'-'.date('dmYHis').'.'.$image->guessExtension();
            $upload = $image->move(public_path('uploads/relawan/'.$data->id.'/'), $imageName);
            $data->foto_file = $imageName;

            $data->save();
            
            $this->createSkill($request, $data);
            $this->createPelatihan($request, $data);
            $this->createPengalaman($request, $data);
            

            return redirect()->json(['data' => 'Berhasil'], 201);
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

        for($i=0; $i < count($request->id_pelatihan); $i++){

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

        for($i=0; $i < count($request->id_pengalaman); $i++){

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
}
