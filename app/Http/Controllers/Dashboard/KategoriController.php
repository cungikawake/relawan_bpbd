<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Kategori::orderBy('created_at', 'asc')->paginate(10);

        return view('dashboard.bencana.index', compact('datas'));
    }
}
