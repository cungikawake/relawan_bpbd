<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Relawan;
use App\Models\Skill;
use App\Models\SkillRelawan;
use App\Models\RelawanPelatihan;
use App\Models\RelawanPengalaman;
use App\Models\IndukOrganisasi;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Auth;


class RelawanController extends Controller
{
    //
    public function organisasi(){
        $organisasi = IndukOrganisasi::orderBy('nama_organisasi', 'asc')->get();
        return response()->json($organisasi, 200);
    }

    public function skill(){
        $skills = Skill::orderBy('nama_skill', 'asc')->get();
        return response()->json($skills, 200);
    }

    
}
