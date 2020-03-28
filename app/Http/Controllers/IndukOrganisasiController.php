<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\IndukOrganisasi;

class IndukOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = IndukOrganisasi::orderBy('created_at', 'asc')->paginate(10);

        return view('induk_organisasi.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new IndukOrganisasi();

        return view('induk_organisasi.form', compact('model'));
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
                'nama' => 'required|unique:induk_organisasi,nama_organisasi',
                'tlp' => 'required',
                'email' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }else{
            $data = new IndukOrganisasi();
            $data->nama_organisasi = $request->nama;
            $data->tlp_organisasi = $request->tlp;
            $data->email_organisasi = $request->email;
            $data->nama_pimpinan_organisasi = $request->nama_pimpinan;
            $data->alamat_organisasi = $request->alamat;
            $data->save();

            return redirect()->route('induk_organisasi.index')->with('message', 'Data berhasil disimpan.');
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
        $model = IndukOrganisasi::findOrFail($id);

        return view('induk_organisasi.form', compact('model'));
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
                'nama' => 'required|unique:induk_organisasi,nama_organisasi'.($id ? ",$id" : '').',id',
                'tlp' => 'required',
                'email' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }else{
            $data = IndukOrganisasi::findOrFail($id);
            $data->nama_organisasi = $request->nama;
            $data->tlp_organisasi = $request->tlp;
            $data->email_organisasi = $request->email;
            $data->nama_pimpinan_organisasi = $request->nama_pimpinan;
            $data->alamat_organisasi = $request->alamat;
            $data->save();

            return redirect()->route('induk_organisasi.index')->with('message', 'Data berhasil diubah.');
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
        $data = IndukOrganisasi::findOrFail($id);
        $data->delete();

        return redirect()->route('induk_organisasi.index')->with('message', 'Data berhasil dihapus.');
    }
}
