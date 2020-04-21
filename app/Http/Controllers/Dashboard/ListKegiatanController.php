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
        $datas = RelawanBencana::where('email_status', 0)->orderBy('tgl_join', 'asc')->get();
        foreach($datas as $data){
            if($data->status_join == 1){
                \Mail::send(
                    'mail.konfirmasi-relawan-join',
                    compact('data'),
                    function ($m) use ($data) {
                        $m->from('e-relawan@mail.com', 'Admin'); 
                        $m->to($data->relawan->email, $data->relawan->nama_lengkap);
                        $m->subject('E-Relawan');
                    }
                );

                $data->email_status = 1;
                $data->save();

            }else if($data->status_join == 2){
                \Mail::send(
                    'mail.konfirmasi-relawan-reject',
                    compact('data'),
                    function ($m) use ($data) {
                        $m->from('e-relawan@mail.com', 'Admin'); 
                        $m->to($data->relawan->email, $data->relawan->nama_lengkap);
                        $m->subject('E-Relawan');
                    }
                );
                
                $data->email_status = 1;
                $data->save();
                
            }
        }

        return 'sendEmail';
    }
}
