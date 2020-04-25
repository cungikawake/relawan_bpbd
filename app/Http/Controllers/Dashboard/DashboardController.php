<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class DashboardController extends Controller
{
    public function index(){
        $user = new User();
        dd($user->isOnline());

        return view('dashboard.dashboard');
    }
}
