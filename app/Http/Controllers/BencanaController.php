<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bencana;  
use App\Models\Skill;  
use App\Models\Persyaratan;  
use App\Models\Relawan;
use App\Models\RelawanBencana;  
use Illuminate\Support\Facades\Auth;

class BencanaController extends Controller
{
    public function index(){
        $bencanas = Bencana::where('jenis_bencana', '1')
                    ->where('status_jenis', '1')
                    ->Orderby('id', 'Desc')
                    ->paginate(3); 

        return view('frontpage.bencana.list', compact('bencanas'));
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
        $detail_bencana = Bencana::findOrFail($id);
        if(empty($detail_bencana)){
            return  redirect('/');
        }

        $user = Auth::user();
        if($user == null){
            return redirect('register');

        }else{
            //pastikan user memiliki join 1 bencana yang aktif pada durasi yang sama
            $relawan = Relawan::where('id_user', $user->id)->first();
            
            $bencanas = RelawanBencana::where('id_user', $user->id)
                    ->where('status_join', '1') //disetujui
                    ->get();

            //relawan publik & bencana publik
            if((empty($relawan) && $detail_bencana->jenis_bencana == 0) || ((!empty($relawan)) && $relawan->jenis_relawan == 1 && $detail_bencana->jenis_bencana == 0) || ((!empty($relawan)) &&$relawan->jenis_relawan == 1 && $detail_bencana->jenis_bencana == 1)){
               
                //apakah sudah pernah join
                if(count($bencanas) > 0){
                    
                    foreach($bencanas as $bencana){
                        $date1=date_create(date('Y-m-d'));//hari ini
                        $date2=date_create($bencana->tgl_selesai);
                        //bencana yang sama
                        if($id == $bencana->id_bencana || $date1 <= $date2){
                            return redirect('bencana/detail/'.$id)->with('message', 'Maaf, anda tidak bisa bergabung sekarang. Karena saat ini sudah bergabung disalah satu kegiatan yang waktunya berlangsung bersamaan.');

                        }else{
                            $join = new RelawanBencana;
                            if(!empty($relawan)){
                                $join->id_relawan = $relawan->id;
                            } 
                            
                            $join->id_user = $user->id;
                            $join->id_bencana = $detail_bencana->id;
                            $join->tgl_join = date('Y-m-d H:i:s');
                            
                            if($detail_bencana->jenis_bencana == 1){
                                $join->status_join = '0';
                                $join->save();

                                return redirect('bencana/detail/'.$id)->with('message', 'Selamat, Anda berhasil mengirim permintaan bergabung. Silahkan menunggu  untuk konfirmasi dari Tim kami.');
                            }else{
                                //diterima
                                $join->status_join = '1';
                                $join->save();

                                return redirect('bencana/detail/'.$id)->with('message', 'Selamat, Sekarang anda sudah langsung diterima bergabung.');
                            } 

                            
                        }

                        
                    }
                    
                }
                
                //normal
                $date1=date_create(date('Y-m-d'));//hari ini
                $date2=date_create($detail_bencana->tgl_selesai);

                if($date1 <= $date2){  
                    $bencanas = RelawanBencana::where('id_user', $user->id)
                        ->where('status_join', '0')
                        ->where('id_bencana', $id)
                        ->get();
                    
                    if(count($bencanas) > 0){
                        return redirect('bencana/detail/'.$id)->with('message', 'Maaf, anda sudah mengirim permintaan berganbung pada kegiatan ini. ');

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

                        if($detail_bencana->jenis_bencana == 1){
                            $join->status_join = '0';
                            $join->save();

                            return redirect('bencana/detail/'.$id)->with('message', 'Selamat, Anda berhasil mengirim permintaan bergabung. Silahkan menunggu  untuk konfirmasi dari Tim kami.');
                        }else{
                            //diterima
                            $join->status_join = '1';
                            $join->save();

                            return redirect('bencana/detail/'.$id)->with('message', 'Selamat, Sekarang anda sudah langsung diterima bergabung.');
                        } 
                        
                    }

                }else{

                    return redirect('bencana/detail/'.$id)->with('message', 'Maaf, anda tidak bisa bergabung sekarang. Kegiatan sudah berakhir.');
                } 

            }else{
                return redirect('bencana/detail/'.$id)->with('message', 'Maaf, akun anda belum terverifikasi.');
            }
        }
    }
}