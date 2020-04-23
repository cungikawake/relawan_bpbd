<?php

namespace App\Http\Controllers\Relawan;


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

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        
        $relawan = Relawan::join('users', 'users.id', '=', 'relawan.id_user')
                ->where('relawan.id_user', Auth::user()->id)
                ->first();
        
        return view('relawan.dashboard.index', compact('relawan', 'user'));
    }

    public function bantuan(){
        return view('relawan.bantuan.index');
    }
}
