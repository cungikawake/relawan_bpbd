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
    public function map(Request $request, $id)
    {
        $model = Bencana::findOrFail($id);

        $results = array();
        $i = 1;
        if(count($model->joinRelawan()) > 0){
            foreach($model->joinRelawan() as $row){
                $lokasi_terakhir = explode(',', $row->lokasi_terakhir);
                array_push($results, [$row->relawan->nama_lengkap, (float)$lokasi_terakhir[0], (float)$lokasi_terakhir[1], $i++]);
            }
        }

        return view('dashboard.list_kegiatan.map', compact('model', 'results'));
    }
    public function sendEmail()
    {
        $today = date('Y-m-d', strtotime('tomorrow'));
        $today = "2020-04-20";
        $datas = Bencana::where('status_jenis', 1)
                    ->where('tgl_mulai', '=', $today)
                    ->get();

        foreach($datas as $data){
            $userkey = "xxxxxx";
            $passkey = "xxxxxx";

            foreach($data->joinRelawan() as $row){
                $telepon = $row->relawan->tlp;
            
                $message = "Halo ".$row->relawan->nama_lengkap."./n Mengingat besok pada tanggal ".$data->tgl_mulai.", merupakan dimulainya kegiatan ".$data->judul_bencana."./n Terima Kasih /n BPBD BALI";

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
