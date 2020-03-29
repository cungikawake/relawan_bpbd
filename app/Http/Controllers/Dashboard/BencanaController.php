<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Bencana;
use App\Models\Skill;

class BencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Bencana::orderBy('created_at', 'asc')->paginate(10);

        return view('dashboard.bencana.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Bencana();
        $skills = Skill::orderBy('nama_skill', 'asc')->get();
        $model_skills = array(); 

        return view('dashboard.bencana.form', compact('model', 'skills', 'model_skills'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make( $request->all(), [
                'judul_bencana' => 'required|unique:bencana,judul_bencana',
                'nama_pelaksana' => 'required',
                'instansi' => 'required',
                'jenis_bencana' => 'required',
                'quota_relawan' => 'required',
                'status_jenis' => 'required',
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'required|date|after:tgl_mulai',
                'skill_minimal' => 'required',
                'mental_minimal' => 'required',
                'detail_tugas' => 'required',
                'durasi_tugas' => 'required',
                'lokasi_tugas' => 'required',
                'koordinat_tugas' => 'required',
                'supervisi_tugas' => 'required',
                'jaminan_perlindungan' => 'required',
                'kordinator_relawan' => 'required',
                'foto_bencana' => 'required|image|mimes:jpeg,jpg,png||max:2048'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }else{
            $data = new Bencana();
            $data->judul_bencana = $request->judul_bencana;
            $data->nama_pelaksana = $request->nama_pelaksana;
            $data->instansi = $request->instansi;
            $data->jenis_bencana = $request->jenis_bencana;
            $data->quota_relawan = $request->quota_relawan;
            $data->status_jenis = $request->status_jenis;
            $data->tgl_mulai = date('Y-m-d', strtotime($request->tgl_mulai));
            $data->tgl_selesai = date('Y-m-d', strtotime($request->tgl_selesai));
            $data->skill_minimal = json_encode($request->skill_minimal);
            $data->mental_minimal = $request->mental_minimal;
            $data->detail_tugas = $request->detail_tugas;
            $data->durasi_tugas = $request->durasi_tugas;
            $data->lokasi_tugas = $request->lokasi_tugas;
            $data->koordinat_tugas = $request->koordinat_tugas;
            $data->supervisi_tugas = $request->supervisi_tugas;
            $data->jaminan_perlindungan = $request->jaminan_perlindungan;
            $data->kordinator_relawan = $request->kordinator_relawan;

            $image = $request->foto_bencana;
            $imageName = Str::slug(strtolower($request->judul_bencana), '_').'-'.date('dmYHis').'.'.$image->guessExtension();
            $upload = $image->move(public_path('uploads/bencana'), $imageName);
            $data->foto_bencana = $imageName;

            $data->save();

            return redirect()->route('dashboard.bencana.index')->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Bencana::findOrFail($id);
        $skills = Skill::orderBy('nama_skill', 'asc')->get();
        $model_skills = is_array(json_decode($model->skill_minimal)) ? json_decode($model->skill_minimal) : array(); 

        return view('dashboard.bencana.form', compact('model', 'skills', 'model_skills'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make( $request->all(), [
                'judul_bencana' => 'required|unique:bencana,judul_bencana'.($id ? ",$id" : '').',id',
                'nama_pelaksana' => 'required',
                'instansi' => 'required',
                'jenis_bencana' => 'required',
                'quota_relawan' => 'required',
                'status_jenis' => 'required',
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'required|date|after:tgl_mulai',
                'skill_minimal' => 'required',
                'mental_minimal' => 'required',
                'detail_tugas' => 'required',
                'durasi_tugas' => 'required',
                'lokasi_tugas' => 'required',
                'koordinat_tugas' => 'required',
                'supervisi_tugas' => 'required',
                'jaminan_perlindungan' => 'required',
                'kordinator_relawan' => 'required',
                'foto_bencana' => 'nullable|image|mimes:jpeg,jpg,png||max:2048'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }else{
            $data = Bencana::findOrFail($id);
            $data->judul_bencana = $request->judul_bencana;
            $data->nama_pelaksana = $request->nama_pelaksana;
            $data->instansi = $request->instansi;
            $data->jenis_bencana = $request->jenis_bencana;
            $data->quota_relawan = $request->quota_relawan;
            $data->status_jenis = $request->status_jenis;
            $data->tgl_mulai = date('Y-m-d', strtotime($request->tgl_mulai));
            $data->tgl_selesai = date('Y-m-d', strtotime($request->tgl_selesai));
            $data->skill_minimal = json_encode($request->skill_minimal);
            $data->mental_minimal = $request->mental_minimal;
            $data->detail_tugas = $request->detail_tugas;
            $data->durasi_tugas = $request->durasi_tugas;
            $data->lokasi_tugas = $request->lokasi_tugas;
            $data->koordinat_tugas = $request->koordinat_tugas;
            $data->supervisi_tugas = $request->supervisi_tugas;
            $data->jaminan_perlindungan = $request->jaminan_perlindungan;
            $data->kordinator_relawan = $request->kordinator_relawan;

            if ($request->has('foto_bencana')) {
                $path = 'uploads/bencana/';
                if (file_exists(public_path($path.$data->foto_bencana)) && !is_null($data->foto_bencana) && $data->foto_bencana != '') {
                    $del_image = unlink(public_path($path.$data->foto_bencana));
                }

                //Upload new image
                $image = $request->foto_bencana;
                $imageName = Str::slug(strtolower($request->judul_bencana), '_').'-'.date('dmYHis').'.'.$image->guessExtension();
                $upload = $image->move(public_path('uploads/bencana'), $imageName);

                $data->foto_bencana = $imageName;
            }

            $data->save();

            return redirect()->route('dashboard.bencana.index')->with('message', 'Data berhasil diubah.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Bencana::findOrFail($id);
        $path = 'uploads/bencana/';
        if (file_exists(public_path($path.$data->foto_bencana)) && !is_null($data->foto_bencana) && $data->foto_bencana != '') {
            $del_image = unlink(public_path($path.$data->foto_bencana));
        }
        $data->delete();

        return redirect()->route('dashboard.bencana.index')->with('message', 'Data berhasil dihapus.');
    }
}
