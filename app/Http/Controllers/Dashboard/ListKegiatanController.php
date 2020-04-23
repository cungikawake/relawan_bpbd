<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Bencana;
use App\Models\RelawanBencana;

class ListKegiatanController extends Controller
{
    public function index(Request $request)
    {
        $datas = Bencana::orderBy('created_at', 'asc')->paginate(10);

        return view('dashboard.list_kegiatan.index', compact('datas'));
    }
    public function detail(Request $request, $id)
    {
        $model = Bencana::findOrFail($id);

        return view('dashboard.list_kegiatan.detail', compact('model'));
    }
    public function update(Request $request, $id)
    {
        if($request->action == 'join'){
            if($request->has('join')){
                RelawanBencana::whereIn('id', $request->join)->update(array('status_join' => 1, 'email_status' => 0));
            }
            return redirect()->route('dashboard.list_kegiatan.detail', ['id' => $id])->with('message', 'Data berhasil disimpan.');

        }else if($request->action == 'reject'){
            if($request->has('reject')){
                RelawanBencana::whereIn('id', $request->reject)->update(array('status_join' => 2, 'email_status' => 0, 'email_message' => 'xxx'));
            }
            return redirect()->route('dashboard.list_kegiatan.detail', ['id' => $id])->with('message', 'Data berhasil disimpan.');

        }else{
            return redirect()->route('dashboard.list_kegiatan.detail', ['id' => $id])->with('message', 'Data tidak ditemukan.');
        }
    }
    public function sendEmail()
    {
        $datas = RelawanBencana::where('email_status', 0)->where('status_join', '>', 0)->orderBy('tgl_join', 'asc')->get();
        foreach($datas as $data){
            $userkey = "xxxxxx";
            $passkey = "xxxxxx";
            $telepon = $data->relawan->tlp;
            $message = "";

            if($data->status_join == 1){
                $message .= "Halo ".$data->relawan->nama_lengkap.", Anda diterima untuk bergabung pada kegiatan penanganan bencana ".$data->bencana->judul_bencana.".";


            }else if($data->status_join == 2){
                $message .= "Halo ".$data->relawan->nama_lengkap.", Anda belum diterima untuk bergabung pada kegiatan penanganan bencana ".$data->bencana->judul_bencana.".";
                
                if(count($data->relawan->bencanaDetail($data->bencana->tgl_mulai, $data->bencana->tgl_selesai))) {
                    $message .= " Dikarenakan anda sudah bergabung dalam kegiatan ".$data->relawan->bencanaDetail($data->bencana->tgl_mulai, $data->bencana->tgl_selesai)->first()->judul_bencana.".";
                }else{ 
                    $message .= " Dikarenakan Jumlah peserta sudah melebihi quota kegiatan.";
                }
                
            }

            if($message != ""){
                // $url = "https://reguler.zenziva.net/apps/smsapi.php";
                // $curlHandle = curl_init();
                // curl_setopt($curlHandle, CURLOPT_URL, $url);
                // curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$telepon.'&pesan='.urlencode($message));
                // curl_setopt($curlHandle, CURLOPT_HEADER, 0);
                // curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
                // curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
                // curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
                // curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
                // curl_setopt($curlHandle, CURLOPT_POST, 1);
                // $results = curl_exec($curlHandle);
                // curl_close($curlHandle);

                // \Log::info([
                //     'zenziva-smsapi' => true,
                //     'results' => $results
                // ]);

                
                
                // $data->email_status = 1;
                // $data->save();

                echo $message." ".$telepon."<br> <br>";
            }
        }

        // return 'sendEmail';

        
        // $datas = RelawanBencana::where('email_status', 0)->orderBy('tgl_join', 'asc')->get();
        // foreach($datas as $data){
        //     if($data->status_join == 1){
        //         \Mail::send(
        //             'mail.konfirmasi-relawan-join',
        //             compact('data'),
        //             function ($m) use ($data) {
        //                 $m->from('e-relawan@mail.com', 'Admin'); 
        //                 $m->to($data->relawan->email, $data->relawan->nama_lengkap);
        //                 $m->subject('E-Relawan');
        //             }
        //         );

        //         $data->email_status = 1;
        //         $data->save();

        //     }else if($data->status_join == 2){
        //         \Mail::send(
        //             'mail.konfirmasi-relawan-reject',
        //             compact('data'),
        //             function ($m) use ($data) {
        //                 $m->from('e-relawan@mail.com', 'Admin'); 
        //                 $m->to($data->relawan->email, $data->relawan->nama_lengkap);
        //                 $m->subject('E-Relawan');
        //             }
        //         );
                
        //         $data->email_status = 1;
        //         $data->save();
                
        //     }
        // }

        // return 'sendEmail';
    }
}
