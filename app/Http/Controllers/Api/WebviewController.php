<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;  
use App\Models\Skill; 
use App\Models\SkillRelawan;
use App\Models\RelawanPelatihan;
use App\Models\RelawanPengalaman;
use App\Models\IndukOrganisasi; 
use App\Models\Persyaratan;  
use App\Models\Relawan;
use App\Models\RelawanBencana;  
use App\Models\Kategori; 
use App\User;  
use Illuminate\Support\Facades\Auth;
use Mail; 
use Session;
use Concerns\InteractsWithInput;

class WebviewController extends Controller
{
    function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    function getBearerToken() {
        $headers = $this->getAuthorizationHeader();
        
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }

            if (preg_match('/bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
 
    public function index(Request $request){
        //cek login 
        $token = $this->getBearerToken();
        session([
            'token' => $token
        ]);
        
        $user = User::where('api_token', $token)->first();
         
        

        $kategoris = Kategori::orderBy('created_at', 'asc')->get();

        $today = date('Y-m-d');

        $bencanas = Bencana::where('status_jenis', '1') 
                    ->where('tgl_selesai', '>=', $today)
                    ->Orderby('id', 'Desc')
                    ->paginate(6);

        
        return view('mobile.home', compact('bencanas', 'kategoris', 'token'));
    }

    public function kategori(Request $request){
        //cek login 
        $token = $this->getBearerToken();
        session([
            'token' => $token
        ]);
        $user = User::where('api_token', $token)->first();
        

        $kategoris = Kategori::orderBy('created_at', 'asc')->get();
        return view('mobile.kategori', compact('kategoris', 'token'));
    }

    public function kategori_list($id, $token){
        //cek login 
        $token = $this->getBearerToken();
        $user = User::where('api_token', $token)->first();
        

        $today = date('Y-m-d');

        $bencanas = Bencana::where('status_jenis', '1')
                    ->where('id_kategori', $id)
                    ->where('tgl_selesai', '>=', $today)
                    ->Orderby('id', 'Desc')
                    ->paginate(9);

        $kategori =  Kategori::findOrFail($id); 

        return view('mobile.kategori_list', compact('bencanas', 'kategori', 'token'));
    }

    public function bencana_detail(Request $request, $id, $token){
         
        //cek login  
        $token = $this->getBearerToken();
        $user = User::where('api_token', $token)->first();

        $bencana = Bencana::where('status_jenis', '1') //aktif
                    ->where('id', $id)
                    ->Orderby('id', 'Desc')
                    ->first(); 
         
        $skill_minimal = array(); 
        foreach(json_decode($bencana->skill_minimal) as $id){
            $skill_minimal[] = Skill::where('id', $id)->first();
        }

        $syarat_minimal = array();
        foreach(json_decode($bencana->mental_minimal) as $id){
            $syarat_minimal[] = Persyaratan::where('id', $id)->first();
        }
         
        return view('mobile.detail_bencana', compact('bencana', 'skill_minimal', 'syarat_minimal', 'token'));
    }

    public function bencana_join($id, $token){
         //cek login 
         
        $token = $this->getBearerToken();
        $user = User::where('api_token', $token)->first();
         
        if($token == ''){
            return   response()->json(['error'=>'User tidak ditemukan'], 401);
        }

        //get relawan
        $relawan = Relawan::where('id_user', $user->id)->first();
            
        //pastikan user memiliki join 1 bencana yang aktif pada durasi yang sama
        $today=date('Y-m-d');//hari ini
        $detail_bencana = Bencana::findOrFail($id);
        $bencanas = RelawanBencana::join('bencana', 'bencana.id', '=', 'relawan_bencana.id_bencana')
                ->where('relawan_bencana.id_user', $user->id) 
                ->where('relawan_bencana.status_join', '1')  
                ->where('bencana.tgl_selesai', '>=', $today) //disetujui
                ->orderBy('bencana.tgl_selesai', 'ASC')
                ->get(); 
        
        if($detail_bencana->jenis_bencana == 1 && isset($relawan->nomor_relawan) && $relawan->nomor_relawan ==''){
            return redirect()->back()->with('message', 'Maaf saat ini anda belum bisa mengikuti kegiatan '.$detail_bencana->judul_bencana.', Karena akun anda masih di tinjau.'); 
        }
         
        //cek apakah ini bencana private dan relawan sudah di approve ?
        if($detail_bencana->jenis_bencana == 1 && isset($relawan->nomor_relawan) && $relawan->nomor_relawan !=''){
            //apakah sudah pernah join
            if(count($bencanas) > 0){
                        
                foreach($bencanas as $bencana){
                    $date1=date_create(date('Y-m-d'));//hari ini
                    $date2=date_create($bencana->tgl_mulai);
                    $date3=date_create($bencana->tgl_selesai);

                    //bencana yang sama atau sudah berakhir
                    if($detail_bencana->id == $bencana->id_bencana){
                        
                        return redirect()->back()->with('message', 'Maaf, anda tidak bisa bergabung sekarang. Karena saat ini sudah bergabung disalah satu kegiatan yang waktunya berlangsung bersamaan.');

                    }else if($date3 <= $date1){
                         
                        return redirect()->back()->with('message', 'Maaf, Hari ini anda tidak bisa bergabung sekarang. Anda sedang aktif di salah satu kegiatan lain.');

                    }else{
                        $join = new RelawanBencana;
                        
                        if(!empty($relawan)){
                            $join->id_relawan = $relawan->id;
                        } 
                        
                        $join->id_user = $user->id;
                        $join->id_bencana = $detail_bencana->id;
                        $join->tgl_join = date('Y-m-d H:i:s'); 
                        $join->durasi_join = '0';
                        $join->lokasi_terakhir = '0';
                        $join->status_join = '0';
                        $join->save();

                        $this->sendSms($user, $detail_bencana, 0);

                        return redirect()->back()->with('message', 'Selamat, Anda berhasil mengirim permintaan bergabung. Silahkan menunggu  untuk konfirmasi dari Tim kami.');
                    } 
                    
                }
                
            }else{
            
                //tidak ada join bencana
                $date1=date_create(date('Y-m-d'));//hari ini
                $date2=date_create($detail_bencana->tgl_selesai);

                if($date1 <= $date2){  
                    $bencanas = RelawanBencana::where('id_user', $user->id)
                        ->where('status_join', '0')
                        ->where('id_bencana', $detail_bencana->id)
                        ->get();
                    
                    if(count($bencanas) > 0 && $bencanas[0]->status_join == 1){
                        return redirect()->back()->with('message', 'Maaf, anda sudah mengirim permintaan berganbung pada kegiatan ini. ');

                    }else{
                        
                        $join = new RelawanBencana;
                        if(!empty($relawan)){
                            $join->id_relawan = $relawan->id;
                        } 
                        $join->id_user = $user->id;
                        $join->id_bencana = $detail_bencana->id;
                        $join->tgl_join = date('Y-m-d H:i:s');
                        $join->durasi_join = '0';
                        $join->lokasi_terakhir = '0';

                        $join->status_join = '0';
                        $join->save();

                        $this->sendSms($user, $detail_bencana, 0);

                        return redirect()->back()->with('message', 'Selamat, Anda berhasil mengirim permintaan bergabung. Silahkan menunggu  untuk konfirmasi dari Tim kami.');
                        
                    }

                }else{

                    return redirect()->back()->with('message', 'Maaf, anda tidak bisa bergabung sekarang. Kegiatan sudah berakhir.');
                }
            }
             
        //bencana publik dan relawan null
        }else if($detail_bencana->jenis_bencana == 2){ 
             
            //apakah sudah ada pernah join 
            if(count($bencanas) > 0){
                
                foreach($bencanas as $bencana){
                   
                    $date1=strtotime(date('Y-m-d'));//hari ini
                    $date2=strtotime($bencana->tgl_mulai);
                    $date3=strtotime($bencana->tgl_selesai);
                     
                    //bencana yang sama atau sudah berakhir
                    if($detail_bencana->id == $bencana->id_bencana){
                        
                        return redirect()->back()->with('message', 'Maaf, anda tidak bisa bergabung sekarang. Karena saat ini sudah bergabung pada kegiatan ini.');

                    }else if($date3 <= $date1){
                         
                        return redirect()->back()->with('message', 'Maaf, Hari ini anda tidak bisa bergabung sekarang. Anda sedang aktif di salah satu kegiatan lain.');

                    }else{
                        $join = new RelawanBencana;
                        
                        if(!empty($relawan)){
                            $join->id_relawan = $relawan->id;
                        } 
                        
                        $join->id_user = $user->id;
                        $join->id_bencana = $detail_bencana->id;
                        $join->tgl_join = date('Y-m-d H:i:s'); 
                        $join->durasi_join = '0';
                        $join->lokasi_terakhir = '0';
                        $join->status_join = '1';
                        $join->save();

                        $this->sendSms($user, $detail_bencana, 1);

                        return redirect()->back()->with('message', 'Selamat, Sekarang anda sudah langsung diterima bergabung.');
                    } 
                    
                }
                
            }else{
            
                //tidak ada join bencana mana pun
                $date1=strtotime(date('Y-m-d'));//hari ini
                $date2=strtotime($detail_bencana->tgl_mulai);
                $date3=strtotime($detail_bencana->tgl_selesai);

                $bencanas = RelawanBencana::where('id_user', $user->id) 
                        ->where('id_bencana', $detail_bencana->id)
                        ->get();  

                if(count($bencanas) > 0 && $bencanas[0]->status_join == 1){
                    return redirect()->back()->with('message', 'Maaf, anda sudah mengirim permintaan berganbung pada kegiatan ini. ');

                }else{
                    
                    $join = new RelawanBencana;
                    
                    if(!empty($relawan)){
                        $join->id_relawan = $relawan->id;
                    } 
                    $join->id_user = $user->id;
                    $join->id_bencana = $detail_bencana->id;
                    $join->tgl_join = date('Y-m-d H:i:s');
                    $join->durasi_join = '0';
                    $join->lokasi_terakhir = '0';

                    $join->status_join = '1';
                    $join->save();

                    $this->sendSms($user, $detail_bencana, 1);

                    return redirect()->back()->with('message', 'Selamat, Sekarang anda sudah langsung diterima bergabung.');
                    
                }
            }
            
        }else{
            return redirect()->back()->with('message', 'Maaf saat ini anda belum bisa mengikuti kegiatan '.$detail_bencana->judul_bencana.', harap untuk memilih kegiatan yang lain');
        }
    }

    public function sendSms($user){
        $userkey = 'a0c5d26c82df';
        $passkey = 'pqec7clpj2';
        $telepon = $user->tlp;
        $message = 'Halo '.$user->name.', Kamu sudah mengirim permintaan Relawan BPBD Bali. silahkan untuk menunggu informasi selanjutnya. Salam BPBD Bali';

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

    public function berita(){
        return "ini berita";
    }
     
    public function dashboard(){
        //cek login 
        $token = $this->getBearerToken();
        session([
            'token' => $token
        ]);
        
        $user = User::where('api_token', $token)->first();
         
         
        $relawan = Relawan::join('users', 'users.id', '=', 'relawan.id_user')
                ->where('relawan.id_user', $user->id)
                ->first();

        $bencana['aktif'] = RelawanBencana::join('bencana', 'bencana.id', '=', 'relawan_bencana.id_bencana')
                ->select('*','relawan_bencana.id as id_relawan_bencana')
                ->where('relawan_bencana.id_user', $user->id)  
                ->where('relawan_bencana.status_join', '1')  
                ->count(); 
        
        $bencana['ditolak'] = RelawanBencana::join('bencana', 'bencana.id', '=', 'relawan_bencana.id_bencana')
                ->select('*','relawan_bencana.id as id_relawan_bencana')
                ->where('relawan_bencana.id_user', $user->id)  
                ->where('relawan_bencana.status_join', '2')  
                ->count();
        
        $bencana['keluar'] = RelawanBencana::join('bencana', 'bencana.id', '=', 'relawan_bencana.id_bencana')
                ->select('*','relawan_bencana.id as id_relawan_bencana')
                ->where('relawan_bencana.id_user', $user->id)  
                ->where('relawan_bencana.status_join', '3')  
                ->count();
        
        return view('mobile.relawan.dashboard.index', compact('relawan', 'user', 'bencana'));
    }

    public function user_profile(){
        //cek login 
        $token = $this->getBearerToken();
        session([
            'token' => $token
        ]); 
         
        $user = User::where('api_token', $token)->first();
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
         
        return view('mobile.relawan.profile.index', compact('model', 'skills', 'model_skills', 'organisasi', 'pelatihan', 'pengalaman', 'user'));
    }
    public function kegiatan(){
        //cek login 
        $token = $this->getBearerToken();
        session([
            'token' => $token
        ]); 
         
        $user = User::where('api_token', $token)->first();
         
        $relawan = Relawan::where('id_user', $user->id)->first();
        $bencanas = array();
        
        $bencanas = RelawanBencana::join('bencana', 'bencana.id', '=', 'relawan_bencana.id_bencana')
                ->select('*','relawan_bencana.id as id_relawan_bencana')
                ->where('relawan_bencana.id_user', $user->id) 
                ->orderBy('relawan_bencana.id', 'desc')
                ->paginate(6); 
        
        return view('mobile.relawan.kegiatan.index', compact('relawan', 'user', 'bencanas')); 
         
    }
    public function bantuan(){
        return "ini bantuan";
    }
}
