<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Relawan;
use App\Models\Bencana;
use App\User;

class DashboardController extends Controller
{
    public function index(){
        $total_bencana = Bencana::count();
        $total_relawan_private = User::where('role', '2')->count();
        $total_relawan_publik = User::where('role', '3')->count();

        return view('dashboard.dashboard', compact('total_bencana', 'total_relawan_private', 'total_relawan_publik'));
    }
}
