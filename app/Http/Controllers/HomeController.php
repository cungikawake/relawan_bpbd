<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bencana; 

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
        $bencanas = Bencana::where('status_jenis', '1')
                    ->Orderby('id', 'Desc')
                    ->limit(3)
                    ->get(); 

        return view('frontpage.home.index', compact('bencanas'));
    }
}
