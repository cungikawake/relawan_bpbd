<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Bencana;
use App\Models\RelawanBencana;
use App\Models\LaporanHarian;

class ListKegiatanController extends Controller
{
    public function index(Request $request)
    {
        $datas = Bencana::orderBy('created_at', 'asc')->get();

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
                if(count($lokasi_terakhir) == 2){
                    $lat = (float)$lokasi_terakhir[0];
                    $lng = (float)$lokasi_terakhir[1];
                }else{
                    $lat = 0;
                    $lng = 0;
                }
                array_push($results, [$row->relawanDisplay()->nama_lengkap, $lat, $lng, $i++]);
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

    public function laporan_harian($id){
        $bencana = Bencana::findOrFail($id);
        $datas = LaporanHarian::select('*', 
            'laporan_harian_bencana.id as id_laporan',
            'bencana.id as id_bencana'
            )
                ->join('bencana', 'bencana.id', '=', 'laporan_harian_bencana.id_bencana')
                ->where('bencana.id',$id)->get();

        $from = $request->tgl_awal;
        $to = $request->tgl_akhir;
        return view('dashboard.list_kegiatan.laporan_harian', compact('bencana','datas', 'from', 'to'));
    }

    public function laporan_harian_create($id){
        $bencana = Bencana::findOrFail($id); 
        $model = new LaporanHarian(); 
        return view('dashboard.list_kegiatan.laporan_harian_form', compact('bencana', 'model'));
    }

    public function laporan_harian_store(Request $request, $id){
        $validator = Validator::make( $request->all(), [
                'judul_laporan' => 'required',
                'detail_laporan' => 'required',
                'tgl_laporan' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }else{
            //cek tgl sama
            $lap_count = LaporanHarian::where('tgl_laporan', $request->tgl_laporan)
            ->where('id_bencana', $id)
            ->count();
            
            if($lap_count > 0){
                return redirect()->route('dashboard.list_kegiatan.laporan_harian', $id)->with('message', 'Laporan pada tanggal '.$request->tgl_laporan.' sudah ada.');
            }

            $data = new LaporanHarian();
            $data->id_bencana = $id;
            $data->tgl_laporan = $request->tgl_laporan;
            $data->judul_laporan = $request->judul_laporan;
            $data->detail_laporan = $request->detail_laporan;
            $data->jml_relawan_umum = $request->jml_relawan_umum;
            $data->jml_relawan_private = $request->jml_relawan_private;
            
            if ($request->has('foto1')) {
            $image = $request->foto1;
            $imageName = Str::slug(strtolower($request->judul_laporan.'_1'), '_').'-'.date('dmYHis').'.'.$image->guessExtension();
            $upload = $image->move(public_path('uploads/laporan'), $imageName);
            $data->foto1 = $imageName;
            }

            if ($request->has('foto2')) {
            $image = $request->foto2;
            $imageName = Str::slug(strtolower($request->judul_laporan.'_2'), '_').'-'.date('dmYHis').'.'.$image->guessExtension();
            $upload = $image->move(public_path('uploads/laporan'), $imageName);
            $data->foto2 = $imageName;
            }

            if ($request->has('foto3')) {
            $image = $request->foto3;
            $imageName = Str::slug(strtolower($request->judul_laporan.'_3'), '_').'-'.date('dmYHis').'.'.$image->guessExtension();
            $upload = $image->move(public_path('uploads/laporan'), $imageName);
            $data->foto3 = $imageName;
            }

            $data->save(); 

            return redirect()->route('dashboard.list_kegiatan.laporan_harian', $id)->with('message', 'Data berhasil disimpan.');
        }
    }

    public function laporan_harian_edit($id){ 
        $model = LaporanHarian::select('*', 
        'laporan_harian_bencana.id as id_laporan',
        'bencana.id as id_bencana'
        )
        ->join('bencana', 'bencana.id', '=', 'laporan_harian_bencana.id_bencana')
        ->where('laporan_harian_bencana.id',$id)->first();

        return view('dashboard.list_kegiatan.laporan_harian_form', compact('model'));
    }

    public function laporan_harian_update(Request $request, $id){
        $validator = Validator::make( $request->all(), [
            'judul_laporan' => 'required',
            'detail_laporan' => 'required',
            'tgl_laporan' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }else{
            /* //cek tgl sama
            $lap_count = LaporanHarian::where('tgl_laporan', $request->tgl_laporan)
                ->where('id_bencana', $id)
                ->count();

            if($lap_count > 0){
                return redirect()->route('dashboard.list_kegiatan.laporan_harian', $id)->with('message', 'Laporan pada tanggal '.$request->tgl_laporan.' sudah ada.');
            } */

            $data = LaporanHarian::findOrFail($request->id_laporan);
            $data->id_bencana = $id;
            $data->tgl_laporan = $request->tgl_laporan;
            $data->judul_laporan = $request->judul_laporan;
            $data->detail_laporan = $request->detail_laporan;
            $data->jml_relawan_umum = $request->jml_relawan_umum;
            $data->jml_relawan_private = $request->jml_relawan_private;
            
            if ($request->has('foto1')) {
            $image = $request->foto1;
            $imageName = Str::slug(strtolower($request->judul_laporan.'_1'), '_').'-'.date('dmYHis').'.'.$image->guessExtension();
            $upload = $image->move(public_path('uploads/laporan'), $imageName);
            $data->foto1 = $imageName;
            }

            if ($request->has('foto2')) {
            $image = $request->foto2;
            $imageName = Str::slug(strtolower($request->judul_laporan.'_2'), '_').'-'.date('dmYHis').'.'.$image->guessExtension();
            $upload = $image->move(public_path('uploads/laporan'), $imageName);
            $data->foto2 = $imageName;
            }

            if ($request->has('foto3')) {
            $image = $request->foto3;
            $imageName = Str::slug(strtolower($request->judul_laporan.'_3'), '_').'-'.date('dmYHis').'.'.$image->guessExtension();
            $upload = $image->move(public_path('uploads/laporan'), $imageName);
            $data->foto3 = $imageName;
            }

            $data->save(); 

            return redirect()->route('dashboard.list_kegiatan.laporan_harian', $id)->with('message', 'Data berhasil disimpan.');
        }
    }

    public function laporan_harian_search(Request $request, $id){
        $bencana = Bencana::findOrFail($id);

        $from = $request->tgl_awal;
        $to = $request->tgl_akhir;

        $datas = LaporanHarian::select('*', 
            'laporan_harian_bencana.id as id_laporan',
            'bencana.id as id_bencana'
            )
            ->join('bencana', 'bencana.id', '=', 'laporan_harian_bencana.id_bencana')
            ->where('bencana.id',$id);

        if($from !='' && $to !=''){
            $datas = $datas->whereBetween('tgl_laporan', [$from, $to])->get();
        }else{
            $datas = $datas->get();
        }

        return view('dashboard.list_kegiatan.laporan_harian', compact('bencana','datas', 'from', 'to'));
    }
}
