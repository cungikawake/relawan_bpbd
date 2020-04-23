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
        
        $bencanas = RelawanBencana::join('bencana', 'bencana.id', '=', 'relawan_bencana.id_bencana')
                ->select('*','relawan_bencana.id as id_relawan_bencana')
                ->where('relawan_bencana.status_join', '0')
                ->orWhere('relawan_bencana.status_join', '1')
                ->where('relawan_bencana.id_user', $user->id) 
                ->orderBy('relawan_bencana.id', 'desc')
                ->get();
        
        
        return view('relawan.bencana.index', compact('relawan', 'user', 'bencanas'));        
    }

    public function destroy(Request $request){
        $user = Auth::user(); 
        if(isset($request->relawan_bencana) && !empty($request->relawan_bencana)){
            $bencana = RelawanBencana::where('id', $request->relawan_bencana)
            ->where('id_user', $user->id)
            ->first(); 
             
            if($bencana != null){
                $bencana = RelawanBencana::findOrFail($request->relawan_bencana);
                $bencana->status_join = '3'; //keluar
                $bencana->save();

                //notif
            }

            return redirect('relawan/bencana');
        }

        return redirect('relawan/bencana');
        
    }
}
