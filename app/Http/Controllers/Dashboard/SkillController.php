<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Skill;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Skill::orderBy('created_at', 'asc')->paginate(10);

        return view('dashboard.skill.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Skill();

        return view('dashboard.skill.form', compact('model'));
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
                'nama' => 'required|unique:skill,nama_skill',
                'prioritas' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }else{
            $data = new Skill();
            $data->nama_skill = $request->nama;
            $data->prioritas_skill = $request->prioritas;
            $data->save();

            return redirect()->route('dashboard.skill.index')->with('message', 'Data berhasil disimpan.');
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
        $model = Skill::findOrFail($id);

        return view('dashboard.skill.form', compact('model'));
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
                'nama' => 'required|unique:skill,nama_skill'.($id ? ",$id" : '').',id',
                'prioritas' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }else{
            $data = Skill::findOrFail($id);
            $data->nama_skill = $request->nama;
            $data->prioritas_skill = $request->prioritas;
            $data->save();

            return redirect()->route('dashboard.skill.index')->with('message', 'Data berhasil disimpan.');
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
        $data = Skill::findOrFail($id);
        $data->delete();

        return redirect()->route('dashboard.skill.index')->with('message', 'Data berhasil dihapus.');
    }
}
