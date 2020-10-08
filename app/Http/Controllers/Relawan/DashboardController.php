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
use App\Models\RelawanBencana; 
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

        $bencana['aktif'] = RelawanBencana::join('bencana', 'bencana.id', '=', 'relawan_bencana.id_bencana')
                ->select('*','relawan_bencana.id as id_relawan_bencana')
                ->where('relawan_bencana.id_user', $user->id)  
                ->where('relawan_bencana.status_join', '1')  
                ->count(); 
        
        $bencana['ditolak'] = RelawanBencana::join('bencana', 'bencana.id', '=', 'relawan_bencana.id_bencana')
                ->select('*','relawan_bencana.id as id_relawan_bencana')
                ->where('relawan_bencana.id_user', $user->id)  
                ->where('relawan_bencana.status_join', '2')  
                ->count();
        
        $bencana['keluar'] = RelawanBencana::join('bencana', 'bencana.id', '=', 'relawan_bencana.id_bencana')
                ->select('*','relawan_bencana.id as id_relawan_bencana')
                ->where('relawan_bencana.id_user', $user->id)  
                ->where('relawan_bencana.status_join', '3')  
                ->count();
        
        return view('relawan.dashboard.index', compact('relawan', 'user', 'bencana'));
    }

    public function bantuan(){
        return view('relawan.bantuan.index');
    }
}
