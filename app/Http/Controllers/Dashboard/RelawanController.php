<?php

namespace App\Http\Controllers\Dashboard;

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

class RelawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Relawan::orderBy('created_at', 'asc')->paginate(10);

        return view('dashboard.relawan.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Relawan();
        $skills = Skill::orderBy('nama_skill', 'asc')->get();
        $model_skills = array();
        $organisasi = IndukOrganisasi::orderBy('nama_organisasi', 'asc')->get();

        return view('dashboard.relawan.form', compact('model', 'skills', 'model_skills', 'organisasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make( $request->all(), [
                'id_user' => 'required',
                'id_induk_relawan' => 'required',
                'nama_lengkap' => 'required',
                'email' => 'required',
                'tgl_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'pendidikan' => 'required',
                'pekerjaan' => 'required',
                'ktp' => 'required',
                'ktp_file' => 'required',
                'foto_file' => 'required',
                'alamat' => 'required',
                'tlp' => 'required',
                'jenis_relawan' => 'required',
                // 'nomor_relawan' => 'required',

                'skill.*' => 'required',
                'penanggulangan.*' => 'required',
                'pengalaman.*' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }else{
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
            $data->nomor_relawan = $request->nomor_relawan;
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
            
            foreach($request->skill as $row){
                $detail = new SkillRelawan();
                $detail->id_relawan = $data->id;
                $detail->id_skill = $row;
                $detail->save();
            }
            
            foreach($request->penanggulangan as $row){
                if($row){
                    $detail = new RelawanPelatihan();
                    $detail->id_relawan = $data->id;
                    $detail->detail_pelatihan = $row;
                    $detail->save();
                }
            }
            
            foreach($request->pengalaman as $row){
                if($row){
                    $detail = new RelawanPengalaman();
                    $detail->id_relawan = $data->id;
                    $detail->detail_pengalaman = $row;
                    $detail->save();
                }
            }

            return redirect()->route('dashboard.relawan.index')->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Relawan::findOrFail($id);
        $skills = Skill::orderBy('nama_skill', 'asc')->get();
        $model_skills = SkillRelawan::where('id_relawan', '=', $id)->pluck('id_skill')->toArray();
        $organisasi = IndukOrganisasi::orderBy('nama_organisasi', 'asc')->get();

        return view('dashboard.relawan.form', compact('model', 'skills', 'model_skills', 'organisasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
