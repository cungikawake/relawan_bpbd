<?php

namespace App\Http\Controllers\Relawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Relawan;
use Illuminate\Support\Facades\Auth;
use App\Models\RelawanBencana; 

class RelawanBencanaController extends Controller
{
    public function index(){
        $user = Auth::user();
        $relawan = Relawan::where('id_user', $user->id)->first();
        $bencanas = array();
        
        if(!empty($relawan)){
            $bencanas = RelawanBencana::join('bencana', 'bencana.id', '=', 'relawan_bencana.id_bencana')
                ->where('relawan_bencana.id_user', $user->id) 
                ->orderBy('relawan_bencana.id', 'desc')
                ->get();
        }
        
        
        return view('relawan.bencana.index', compact('relawan', 'user', 'bencanas'));        
    }

    public function keluar($id){
        $user = Auth::user();
        $relawan = Relawan::where('id_user', $user->id)->first();
        $bencanas = RelawanBencana::join('bencana', 'bencana.id', '=', 'relawan_bencana.id_bencana')
                ->where('relawan_bencana.id_relawan', $relawan->id) 
                ->where('relawan_bencana.id', $id)->first();
        $bencanas->update(['status_join', '2']);
        return redirect('relawan/bencana');
    }
}
