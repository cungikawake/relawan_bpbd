<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;  
use App\Models\Skill;  
use App\Models\Persyaratan;  
use App\Models\Relawan;
use App\Models\RelawanBencana;  
use App\Models\Kategori;  
use Illuminate\Support\Facades\Auth;
use Mail;

class HomeController extends Controller
{

    public function index(Request $request){
        $kategoris = Kategori::orderBy('created_at', 'asc')->get();

        $today = date('Y-m-d');

        $bencanas = Bencana::where('status_jenis', '1') 
                    ->where('tgl_selesai', '>=', $today)
                    ->Orderby('id', 'Desc')
                    ->paginate(6);

        
        return view('mobile.home', compact('bencanas', 'kategoris'));
    }

    public function kategori(Request $request){
        $kategoris = Kategori::orderBy('created_at', 'asc')->get();
        return view('mobile.kategori', compact('kategoris'));
    }

    public function kategori_list($id){
        $today = date('Y-m-d');

        $bencanas = Bencana::where('status_jenis', '1')
                    ->where('id_kategori', $id)
                    ->where('tgl_selesai', '>=', $today)
                    ->Orderby('id', 'Desc')
                    ->paginate(9);

        $kategori =  Kategori::findOrFail($id); 

        return view('mobile.kategori_list', compact('bencanas', 'kategori'));
    }
}
