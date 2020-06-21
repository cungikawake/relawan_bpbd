<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bencana; 
use App\Models\Kategori;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kategoris = Kategori::orderBy('created_at', 'asc')->get();

        $today = date('Y-m-d');

        $bencanas = Bencana::where('status_jenis', '1') 
                    ->where('tgl_selesai', '>=', $today)
                    ->Orderby('id', 'Desc')
                    ->paginate(6);

        

        return view('frontpage.home.index', compact('bencanas', 'kategoris'));
    }
}
