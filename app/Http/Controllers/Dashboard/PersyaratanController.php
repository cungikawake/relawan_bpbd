<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Persyaratan;

class PersyaratanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Persyaratan::orderBy('created_at', 'asc')->paginate(10);

        return view('dashboard.persyaratan.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Persyaratan();

        return view('dashboard.persyaratan.form', compact('model'));
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
                'nama' => 'required|unique:persyaratan,nama',
                'prioritas' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }else{
            $data = new Persyaratan();
            $data->nama = $request->nama;
            $data->prioritas = $request->prioritas;
            $data->save();

            return redirect()->route('dashboard.persyaratan.index')->with('message', 'Data berhasil disimpan.');
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
        $model = Persyaratan::findOrFail($id);

        return view('dashboard.persyaratan.form', compact('model'));
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
                'nama' => 'required|unique:persyaratan,nama'.($id ? ",$id" : '').',id',
                'prioritas' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }else{
            $data = Persyaratan::findOrFail($id);
            $data->nama = $request->nama;
            $data->prioritas = $request->prioritas;
            $data->save();

            return redirect()->route('dashboard.persyaratan.index')->with('message', 'Data berhasil disimpan.');
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
        $data = Persyaratan::findOrFail($id);
        $data->delete();

        return redirect()->route('dashboard.persyaratan.index')->with('message', 'Data berhasil dihapus.');
    }
}
