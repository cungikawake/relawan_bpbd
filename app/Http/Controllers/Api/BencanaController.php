<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;  
use App\Models\Skill;  
use App\Models\Persyaratan;  
use App\Models\Relawan;
use App\Models\RelawanBencana;  
use Illuminate\Support\Facades\Auth;
use Mail;

class BencanaController extends Controller
{
    public function index(){
        $bencanas = Bencana::where('status_jenis', '1')
                    ->Orderby('id', 'Desc')
                    ->paginate(6); 

        return response()->json($bencanas, 200);
    }

    public function detail(Request $request)
    {
        $bencana = Bencana::where('status_jenis', '1') //aktif
                    ->where('id', $request->id_bencana)
                    ->Orderby('id', 'Desc')
                    ->first(); 
         
        $skill_minimal = array(); 
        foreach(json_decode($bencana->skill_minimal) as $id){
            $skill_minimal[] = Skill::where('id', $id)->first();
        }

        $syarat_minimal = array();
        foreach(json_decode($bencana->mental_minimal) as $id){
            $syarat_minimal[] = Persyaratan::where('id', $id)->first();
        }
         
        $response = array(
            'detail_bencana' => $bencana,
            'skill_minimal' => $skill_minimal,
            'syarat_minimal' => $syarat_minimal
        );

        return response()->json($response, 200);
    }
}
