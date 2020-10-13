<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bencana;  
use App\Models\Skill;  
use App\Models\Persyaratan;  
use App\Models\Relawan;
use App\Models\RelawanBencana;  
use App\Models\Kategori;  
use Illuminate\Support\Facades\Auth;
use Mail;

class BencanaController extends Controller
{
    public function index(){
        $today = date('Y-m-d');
        $bencanas = Bencana::where('status_jenis', '1')
                    ->where('tgl_selesai', '>=', $today)
                    ->Orderby('id', 'Desc')
                    ->paginate(6); 

        return view('frontpage.bencana.list', compact('bencanas'));
    }

    
    public function listKategori($id){  
        $today = date('Y-m-d');

        $bencanas = Bencana::where('status_jenis', '1')
                    ->where('id_kategori', $id)
                    ->where('tgl_selesai', '>=', $today)
                    ->Orderby('id', 'Desc')
                    ->paginate(9);

        $kategori =  Kategori::findOrFail($id); 

        return view('frontpage.bencana.list', compact('bencanas', 'kategori'));

    }

    public function detail($id)
    {
        
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
         
        return view('frontpage.bencana.detail_bencana', compact('bencana', 'skill_minimal', 'syarat_minimal'));
    }

    public function join($id = null){ 
        $user = Auth::user();
        $detail_bencana = Bencana::findOrFail($id);
        
        if(empty($detail_bencana)){
            return  redirect()->back();
        }

        $user = Auth::user();
        if($user == null){
            return redirect('login');

        }else{
            //get relawan
            $relawan = Relawan::where('id_user', $user->id)->first();
            
            //pastikan user memiliki join 1 bencana yang aktif pada durasi yang sama
            $today=date('Y-m-d');//hari ini
            
            $bencanas = RelawanBencana::join('bencana', 'bencana.id', '=', 'relawan_bencana.id_bencana')
                    ->where('relawan_bencana.id_user', $user->id) 
                    ->where('relawan_bencana.status_join', '1')  
                    ->where('bencana.tgl_selesai', '>=', $today) //disetujui
                    ->orderBy('bencana.tgl_selesai', 'ASC')
                    ->get(); 
            
            if($detail_bencana->jenis_bencana == 1 && $relawan->nomor_relawan ==''){
                return redirect()->back()->with('message', 'Maaf saat ini anda belum bisa mengikuti kegiatan '.$detail_bencana->judul_bencana.', Karena akun anda masih di tinjau.'); 
            }

            //cek apakah ini bencana private dan relawan sudah di approve ?
            if($detail_bencana->jenis_bencana == 1 && $relawan->nomor_relawan !=''){
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

                            return redirect('relawan/bencana')->with('message', 'Selamat, Anda berhasil mengirim permintaan bergabung di '.$detail_bencana->judul_bencana.'. Silahkan menunggu  untuk konfirmasi dari Tim kami.');
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

                            return redirect('relawan/bencana')->with('message', 'Selamat, Anda berhasil mengirim permintaan bergabung di .'.$detail_bencana->judul_bencana.'  Silahkan menunggu  untuk konfirmasi dari Tim kami.');
                            
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

                            return redirect('relawan/bencana')->with('Sekarang anda sudah langsung diterima bergabung di kegiatan '.$detail_bencana->judul_bencana);
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

                        return redirect('relawan/bencana')->with('message', 'Selamat, Sekarang anda sudah langsung diterima bergabung di kegiatan '.$detail_bencana->judul_bencana);
                        
                    }
                }
                
            }else{
                return redirect()->back()->with('message', 'Maaf saat ini anda belum bisa mengikuti kegiatan ini, harap untuk memilih kegiatan yang lainnya');
            } 
        }
    }
 

    public function sendSms($user, $detail_bencana, $status_gabung){
        $userkey = 'a0c5d26c82df';
        $passkey = 'pqec7clpj2';
        $telepon = $user->tlp;

        if($status_gabung == 1 ){
            $message = 'Halo '.$user->name.', Kamu sudah berhasil bergabung dan di terima di '.$detail_bencana->judul_bencana.'.  Salam BPBD Bali';

        }else{
            $message = 'Halo '.$user->name.', Kamu sudah mengirim permintaan bergabung di '.$detail_bencana->judul_bencana.'. silahkan untuk menunggu informasi selanjutnya. Salam BPBD Bali';
        }

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


    public function sendMail($data){
        try{
            \Mail::send(
                'mail.konfirmasi-relawan-bencana',
                compact('data'),
                function ($m) use ($data) {
                    $m->from('info@bpbdbali.com', 'Admin e-Relawan'); 
                    $m->to($data['email'], $data['nama']);
                    $m->subject('Notifikasi Join Bencana e-Relawan');
                }
            );
        }catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

}
