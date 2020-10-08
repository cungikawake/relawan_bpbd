<?php

namespace App\Http\Controllers\Relawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Relawan;
use Illuminate\Support\Facades\Auth;
use App\Models\RelawanBencana; 
use App\Models\Bencana;

class RelawanBencanaController extends Controller
{
    public function index(){
        $user = Auth::user();
        $relawan = Relawan::where('id_user', $user->id)->first();
        $bencanas = array();
        
        $bencanas = RelawanBencana::join('bencana', 'bencana.id', '=', 'relawan_bencana.id_bencana')
                ->select('*','relawan_bencana.id as id_relawan_bencana')
                ->where('relawan_bencana.id_user', $user->id) 
                ->orderBy('relawan_bencana.id', 'desc')
                ->paginate(6); 
        
        return view('relawan.bencana.index', compact('relawan', 'user', 'bencanas'));        
    }

    public function destroy(Request $request){
        $user = Auth::user(); 
        if(isset($request->relawan_bencana) && !empty($request->relawan_bencana)){
            $bencana = RelawanBencana::where('id', $request->relawan_bencana)
            ->where('id_user', $user->id)
            ->first(); 
             
            if($bencana != null){
                $bencana = RelawanBencana::findOrFail($request->relawan_bencana);
                $bencana->status_join = '3'; //keluar
                $bencana->tgl_keluar = date('Y-m-d H:i:s');
                $bencana->user_action = 1; 
                $bencana->save();

                //notif
            }

            return redirect('relawan/bencana');
        }

        return redirect('relawan/bencana');
        
    }

    public function search(){
        $today = date('Y-m-d');
        $bencanas = Bencana::where('status_jenis', '1')
                    ->where('tgl_selesai', '>=', $today)
                    ->Orderby('id', 'Desc')
                    ->paginate(6); 

         
        return view('relawan.bencana.list', compact('bencanas'));
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

                            $this->sendSms($user);

                            return redirect('relawan/bencana')->with('message', 'Selamat, Anda berhasil mengirim permintaan bergabung. Silahkan menunggu  untuk konfirmasi dari Tim kami.');
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

                            $this->sendSms($user);

                            return redirect('relawan/bencana')->with('message', 'Selamat, Anda berhasil mengirim permintaan bergabung. Silahkan menunggu  untuk konfirmasi dari Tim kami.');
                            
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

                            $this->sendSms($user);

                            return redirect('relawan/bencana')->with('message', 'Selamat, Sekarang anda sudah langsung diterima bergabung.');
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

                        $this->sendSms($user);

                        return redirect('relawan/bencana')->with('message', 'Selamat, Sekarang anda sudah langsung diterima bergabung.');
                        
                    }
                }
                
            }else{
                return redirect()->back()->with('message', 'Maaf saat ini anda belum bisa mengikuti kegiatan '.$detail_bencana->judul_bencana.', harap untuk memilih kegiatan yang lain');
            } 
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
