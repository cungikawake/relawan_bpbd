<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bencana;  
use App\Models\Relawan;
use App\Models\RelawanBencana;  
use Illuminate\Support\Facades\Auth;

class BencanaController extends Controller
{
    public function detail($id)
    {
        $bencana = Bencana::where('jenis_bencana', '1')
                    ->where('status_jenis', '1')
                    ->where('id', $id)
                    ->Orderby('id', 'Desc')
                    ->first(); 
        

        return view('frontpage.bencana.detail_bencana', compact('bencana'));
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
            $bencanas = RelawanBencana::where('id_relawan', $relawan->id)
                    ->where('status_join', '1')
                    ->get();
            
            //apakah sudah pernah join
            if(count($bencanas) > 0){
                
                foreach($bencanas as $bencana){
                    $date1=date_create(date('Y-m-d'));//hari ini
                    $date2=date_create($bencana->tgl_selesai);
                    //bencana yang sama
                    if($id == $bencana->id_bencana || $date1 < $date2){
                        return redirect('bencana/detail/'.$id)->with('message', 'Maaf, anda tidak bisa bergabung sekarang. Karena saat ini sudah bergabung disalah satu kegiatan yang waktunya berlangsung bersamaan.');

                    }else{
                        $join = new RelawanBencana;
                        $join->id_relawan = $relawan->id;
                        $join->id_bencana = $detail_bencana->id;
                        $join->tgl_join = date('Y-m-d H:i:s');
                        $join->status_join = '0';
                        $join->save();

                        return redirect('bencana/detail/'.$id)->with('message', 'Selamat, Anda berhasil mengirim permintaan bergabung. Silahkan menunggu  untuk konfirmasi dari Tim kami.');
                    }

                    
                }
                
            }
            
            //normal
            $date1=date_create(date('Y-m-d'));//hari ini
            $date2=date_create($detail_bencana->tgl_selesai);

            if($date1 >= $date2){ 

                $bencanas = RelawanBencana::where('id_relawan', $relawan->id)
                    ->where('status_join', '0')
                    ->get();
                
                if(count($bencanas) > 0){
                    return redirect('bencana/detail/'.$id)->with('message', 'Maaf, anda sudah bergabung pada kegiatan ini. ');
                }
                
                $join = new RelawanBencana;
                $join->id_relawan = $relawan->id;
                $join->id_bencana = $detail_bencana->id;
                $join->tgl_join = date('Y-m-d H:i:s');
                $join->status_join = '0';
                $join->durasi_join = '0';
                $join->lokasi_terakhir = '0';
                $join->save();

                return redirect('bencana/detail/'.$id)->with('message', 'Selamat, Anda berhasil mengirim permintaan bergabung. Silahkan menunggu  untuk konfirmasi dari Tim kami.');

            }else{

                return redirect('bencana/detail/'.$id)->with('message', 'Maaf, anda tidak bisa bergabung sekarang. Kegiatan sudah berakhir.');
            }  
            
        }
    }
}
