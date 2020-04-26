<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;  
use App\Models\Skill;  
use App\Models\Persyaratan;  
use App\Models\Relawan;
use App\Models\RelawanBencana;  
use Illuminate\Support\Facades\Auth;
use Mail;
use DB;

class BencanaController extends Controller
{
    public function index(){
        $bencanas = Bencana::where('status_jenis', '1')
                    ->Orderby('id', 'Desc')
                    ->paginate(6); 

        return response()->json($bencanas, 200);
    }

    public function detail(Request $request)
    {
        $bencana = Bencana::where('status_jenis', '1') //aktif
                    ->where('id', $request->id_bencana)
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
         
        $response = array(
            'detail_bencana' => $bencana,
            'skill_minimal' => $skill_minimal,
            'syarat_minimal' => $syarat_minimal
        );

        return response()->json($response, 200);
    }

    public function join(Request $request){
        $detail_bencana = Bencana::findOrFail($request->id_bencana);
        if(empty($detail_bencana)){
            return  response()->json(['error'=>'Bencana tidak ditemukan'], 401);
        }

        $user = Auth::user();
        if($user == null){
            return response()->json(['error'=>'Kamu Belum Login'], 401);

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
                        $date3=date_create($bencana->tgl_mulai);
                        
                        //bencana yang sama di range waktu yang sama
                        if($request->id_bencana == $bencana->id_bencana || ($date1 <= $date3 && $date1 >= $date2)){ 

                            return response()->json(['error'=>'Maaf, anda tidak bisa bergabung sekarang. Karena saat ini sudah bergabung disalah satu kegiatan yang waktunya berlangsung bersamaan.'], 401);

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

                                return response()->json(['success'=>'Selamat, Anda berhasil mengirim permintaan bergabung. Silahkan menunggu  untuk konfirmasi dari Tim kami.'], 200);

                            }else{
                                //diterima
                                $join->status_join = '1';
                                $join->save();

                                $data = array(
                                    'email' => $user->email,
                                    'nama' => $user->name,
                                    'pesan' => 'Selamat, Sekarang anda sudah langsung diterima bergabung.'
                                );
                                //$this->sendMail($data);
                                return response()->json(['success'=>'Selamat, Sekarang anda sudah langsung diterima bergabung.'], 200);
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
                        return response()->json(['error'=>'Maaf, anda sudah mengirim permintaan berganbung pada kegiatan ini. '], 401);

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

                            return response()->json(['success'=>'Selamat, Anda berhasil mengirim permintaan bergabung. Silahkan menunggu  untuk konfirmasi dari Tim kami.'], 200);

                        }else{
                            //diterima
                            $join->status_join = '1';
                            $join->save();

                            $data = array(
                                'email' => $user->email,
                                'nama' => $user->name,
                                'pesan' => 'Selamat, Sekarang anda sudah langsung diterima bergabung.'
                            );
                            //$this->sendMail($data);

                            return response()->json(['success'=>'Selamat, Sekarang anda sudah langsung diterima bergabung.'], 200);

                        } 
                        
                    }

                }else{
                    return response()->json(['error'=>'Maaf, anda tidak bisa bergabung sekarang. Kegiatan sudah berakhir.'], 401);
                } 

            }else{
                return response()->json(['error'=>'Maaf, akun anda belum terverifikasi.'], 401);

            }
        }
    }

    public function storeGps(Request $request){
        $user = Auth::user();

        if($user == null){
            return response()->json(['error'=>'Kamu Belum Login'], 401);

        }else{
            if(isset($request->lat) && isset($request->lng)){
                $kordinat_terkini = $request->lat.','.$request->lng;
                $relawan = Relawan::where('id_user', $user->id)->first();
                
                //cari tanggal yang diikuti relawan jenis private dengan status bencana sedang berjalan
                $tgl_mulai = RelawanBencana::join('bencana', 'bencana.id', '=', 'relawan_bencana.id_bencana')
                ->where('relawan_bencana.id_relawan', $relawan->id)
                ->where('relawan_bencana.status_join', 1)
                ->min('bencana.tgl_mulai');

                $tgl_selesai = RelawanBencana::join('bencana', 'bencana.id', '=', 'relawan_bencana.id_bencana')
                ->where('relawan_bencana.id_relawan', $relawan->id)
                ->where('relawan_bencana.status_join', 1)
                ->max('bencana.tgl_selesai'); 
                
                //cari bencana berdasarkan tanggal bencana
                $bencana_arr = RelawanBencana::join('bencana', 'bencana.id', '=', 'relawan_bencana.id_bencana')
                ->select('relawan_bencana.id as id')
                ->where('relawan_bencana.id_relawan', $relawan->id)
                ->where('relawan_bencana.status_join', 1)
                ->whereBetween('bencana.tgl_mulai', [$tgl_mulai, $tgl_selesai])
                ->WhereBetween('bencana.tgl_selesai', [$tgl_mulai, $tgl_selesai])
                ->get();
                 
                foreach($bencana_arr as $bencana){
                    $update = RelawanBencana::where('id',$bencana->id)->firstOrFail();
                    $update->lokasi_terakhir = $kordinat_terkini;
                    $update->save();
                }

                return response()->json(['success'=>'Update Kordinat Berhasil'], 200);

            }else{
                return response()->json(['error'=>'Data Kordinat Tidak Valid'], 401);
            }
        }
    }
}
