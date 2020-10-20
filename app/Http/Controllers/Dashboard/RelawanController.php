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
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Desa;

class RelawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Relawan::select(
            'relawan.id as id_relawan', 
            'users.name as name',
            'users.email as email',
            'users.tlp as tlp',
            'relawan.jenis_relawan as jenis_relawan',
            'relawan.nomor_relawan as nomor_relawan',
            'induk_organisasi.nama_organisasi as nama_organisasi',
            'skill.nama_skill as nama_skill'
        )
        ->rightJoin('users', 'users.id', '=', 'relawan.id_user')
        ->leftJoin('induk_organisasi', 'induk_organisasi.id', '=', 'relawan.id_induk_relawan')
        ->leftJoin('skill', 'skill.id', '=', 'relawan.skill_utama')
        ->orderBy('users.name', 'asc')
        ->get();
        
        $organisasi = IndukOrganisasi::get();
        $skill = Skill::get();
        $filter = [
            'jenis_relawan' => '',
            'organisasi' => '',
            'skill' => ''
        ];

        return view('dashboard.relawan.index', compact('datas', 'organisasi', 'skill','filter'));
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
        
        $pelatihan[] = new RelawanPelatihan;
        $pengalaman[] = new RelawanPengalaman;
        
        $kota = Kota::orderBy('name', 'asc')->get();

        return view('dashboard.relawan.form', compact('model', 'skills', 'model_skills', 'organisasi', 'pelatihan', 'pengalaman', 'kota'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function createUser($request)
    {
        if((int)$request->jenis_relawan == 1){
            //Private
            $role = 2;
        }else{
            //umum
            $role = 3;
        }

        $string = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = substr(str_shuffle(str_repeat($string, 6)), 0, 6);

        $user = new User();
        $user->name = $request->nama_lengkap;
        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->role = $role;
        $user->status_verified = 0;
        $user->save();

        return ['id' => $user->id, 'password' => $password];
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

    public function store(Request $request)
    {
        $validator = Validator::make( $request->all(), [
                // 'id_user' => 'required',
                'id_induk_relawan' => 'required',
                'nama_lengkap' => 'required',
                'email' => 'required|email|unique:users,email',
                'tgl_lahir' => 'required|before:13 years ago',
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
                'skill_utama' => 'required',
                'kota' => 'required',

                'skill' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }else{
            $user = $this->createUser($request);
            $user_id = $user['id'];
            $password = $user['password'];

            $data = new Relawan();
            $data->id_user = $user_id;
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
            $data->skill_utama = $request->skill_utama;
            $data->kota_id = $request->kota;
            $data->save();
            
            $data->nomor_relawan = $data->createNomor();
            $data->save();

            // $last_id = $model->();
            // $nomor_relawan = "0000A0000000";
            // dd($last_id);
            
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
            
            /* \Mail::send(
                'mail.relawan-konfirmasi',
                compact('data','password'),
                function ($m) use ($data) {
                    $m->from('info@bpbdbali.com', 'Admin e-Relawan'); 
                    $m->to($data->email, $data->nama_lengkap);
                    $m->subject('E-Relawan');
                }
            ); */

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

        $pelatihan = $model->pelatihanEdit();
        $pengalaman = $model->pengalamanEdit();
        
        $kota = Kota::orderBy('name', 'asc')->get();
        $kecamatan = Kecamatan::orderBy('kecamatan_nama', 'asc')->get();
        $desa = Desa::orderBy('desakel_nama', 'asc')->get();

        return view('dashboard.relawan.form', compact('kecamatan','desa','model', 'skills', 'model_skills', 'organisasi', 'pelatihan', 'pengalaman', 'kota'));
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
        //JIKA RELAWAN DI TOLAK
        if($request->approve == 0){
            $this->destroy($id);
        }

        $validator = Validator::make( $request->all(), [
                // 'id_user' => 'required',
                'id_induk_relawan' => 'required',
                'nama_lengkap' => 'required',
                'email' => 'required|email',
                'tgl_lahir' => 'required|before:13 years ago',
                'jenis_kelamin' => 'required',
                'pendidikan' => 'required',
                'pekerjaan' => 'required',
                //'ktp' => 'required',
                // 'ktp_file' => 'required',
                // 'foto_file' => 'required',
                'alamat' => 'required',
                'tlp' => 'required',
                'jenis_relawan' => 'required',
                // 'nomor_relawan' => 'required',
                'skill_utama' => 'required',
                'kota' => 'required',
                'kecamatan' => 'required',
                'desa' => 'required',

                'skill' => 'required'
            ]
        );


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }else{
            $data = Relawan::findOrFail($id);
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
            $data->skill_utama = $request->skill_utama;
            $data->kota_id = $request->kota;
            $data->kecamatan_id = $request->kecamatan;
            $data->desakel_id = $request->desa;
            $data->save();

            if(!$data->nomor_relawan){
                $data->nomor_relawan = $data->createNomor();
                $data->save();
            }
            
            if ($request->has('ktp_file')) {
                $path = 'uploads/relawan/'.$data->id.'/';
                if (file_exists(public_path($path.$data->ktp_file)) && !is_null($data->ktp_file) && $data->ktp_file != '') {
                    $del_image = unlink(public_path($path.$data->ktp_file));
                }

                $image = $request->ktp_file;
                $imageName = 'ktp-'.Str::slug(strtolower($request->nama_lengkap), '_').'-'.date('dmYHis').'.'.$image->guessExtension();
                $upload = $image->move(public_path('uploads/relawan/'.$data->id.'/'), $imageName);
                $data->ktp_file = $imageName;
            }
            
            if ($request->has('foto_file')) {
                $path = 'uploads/relawan/'.$data->id.'/';
                if (file_exists(public_path($path.$data->foto_file)) && !is_null($data->foto_file) && $data->foto_file != '') {
                    $del_image = unlink(public_path($path.$data->foto_file));
                }

                $image = $request->foto_file;
                $imageName = 'foto-'.Str::slug(strtolower($request->nama_lengkap), '_').'-'.date('dmYHis').'.'.$image->guessExtension();
                $upload = $image->move(public_path('uploads/relawan/'.$data->id.'/'), $imageName);
                $data->foto_file = $imageName;
            }

            $data->save();

            $user = User::findOrFail($data->id_user);
            $user->status_verified = '1';
            $user->role = '2'; //private
            $user->save();

            $this->createSkill($request, $data);
            $this->createPelatihan($request, $data);
            $this->createPengalaman($request, $data);

            return redirect()->route('dashboard.relawan.index')->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Relawan::findOrFail($id);
        if($model->user){ 
            $model->user->role = '3';
            $model->user->status_verified = '';
            $model->user->save();
        }
        foreach($model->skills as $row){
            $row->delete();

        }
        foreach($model->pelatihan as $row){
            $row->delete();

        }
        foreach($model->pengalaman as $row){
            $row->delete();

        }
        $path = 'uploads/relawan/'.$model->id.'/';
        if (file_exists(public_path($path.$model->ktp_file)) && !is_null($model->ktp_file) && $model->ktp_file != '') {
            $del_image = unlink(public_path($path.$model->ktp_file));
        }
        if (file_exists(public_path($path.$model->foto_file)) && !is_null($model->foto_file) && $model->foto_file != '') {
            $del_image = unlink(public_path($path.$model->foto_file));
        }
        $model->id_induk_relawan = 0;
        $model->nomor_relawan = '';
        $model->ktp_file = '';
        $model->foto_file = '';
        $model->save();

        return redirect()->route('dashboard.relawan.index')->with('message', 'Data berhasil dihapus.');
    }

    public function verify($id)
    {
        $model = Relawan::findOrFail($id);
        if($model->user){
            $user = $model->user;
            $user->status_verified = 1;
            $user->role = 2;
            $user->save();

            if(!$model->nomor_relawan){
                $model->nomor_relawan = $model->createNomor();
                $model->save();
            }
            //send sms
            $this->sendSms($user);

            return redirect()->route('dashboard.relawan.index')->with('message', 'Data berhasil diverifikasi.');

        }else{
            return redirect()->route('dashboard.relawan.index')->with('message-warning', 'Data relawan tidak ditemukan.');
        }
    }
    
    public function print($id)
    {
        $model = Relawan::findOrFail($id);
        
        return view('dashboard.relawan.print', compact('model'));
    }

    public function mail()
    {
        $data = Relawan::findOrFail(7);
        $password = 'bpbdbali#2020';
        
        \Mail::send(
            'mail.relawan-konfirmasi',
            compact('data','password'),
            function ($m) use ($data) {
                $m->from('info@bpbdbali.com', 'Admin e-Relawan'); 
                $m->to($data->email, $data->nama_lengkap);
                $m->subject('E-Relawan');
            }
        );
    }

    public function sendSms($user){
        $userkey = 'a0c5d26c82df';
        $passkey = 'pqec7clpj2';
        $telepon = $user->tlp;
        $message = 'Halo '.$user->name.', Kamu sudah diterima dan aktif menjadi Relawan BPBD Bali. silahkan untuk login ulang. Salam BPBD Bali';

        $url = "https://reguler.zenziva.net/apps/smsapi.php";
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$telepon.'&pesan='.urlencode($message));
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        $results = curl_exec($curlHandle);
        curl_close($curlHandle);
        return true;
    }

    public function search(Request $request)
    {   
        
        //filter data
        $datas = Relawan::select(
            'relawan.id as id_relawan', 
            'users.name as name',
            'users.email as email',
            'users.tlp as tlp',
            'relawan.jenis_relawan as jenis_relawan',
            'relawan.nomor_relawan as nomor_relawan',
            'induk_organisasi.nama_organisasi as nama_organisasi',
            'skill.nama_skill as nama_skill'
        )
        ->rightJoin('users', 'users.id', '=', 'relawan.id_user')
        ->leftJoin('induk_organisasi', 'induk_organisasi.id', '=', 'relawan.id_induk_relawan')
        ->leftJoin('skill', 'skill.id', '=', 'relawan.skill_utama');

        if($request->jenis_relawan == 2){
            //relawan terverifikasi
            $datas = $datas->where('relawan.nomor_relawan', '!=', ''); 
        }elseif($request->jenis_relawan == 1){
            //relawan umum
            $datas = $datas->where('users.role', '=', '3');
        }

        if($request->organisasi !=''){
            $datas = $datas->where('induk_organisasi.id', '=', $request->organisasi);
        }

        if($request->skill !=''){
            $datas = $datas->where('relawan.skill_utama', '=', $request->skill);
        }

        $datas = $datas->orderBy('users.name', 'asc')->get();
         
        $organisasi = IndukOrganisasi::get();
        $skill = Skill::get();
        $filter = [
            'jenis_relawan' => $request->jenis_relawan,
            'organisasi' => $request->organisasi,
            'skill' => $request->skill
        ]; 

        
        //cetak data
        if($request->btn == 'cetak'){
            return view('dashboard.relawan.print_tabel', compact('datas', 'organisasi', 'skill', 'filter'));
        }else{
            return view('dashboard.relawan.index', compact('datas', 'organisasi', 'skill', 'filter'));
        }
        
    }
}
