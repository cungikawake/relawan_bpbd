<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::RELAWAN;
    // protected $redirectTo = 'dashboard';
    public function redirectTo(){
        
        // User role
        $role = Auth::user()->role; 
         
        // Check user role
        switch ($role) {
            case '1':
                    return '/dashboard';
                break;
            case '2':
                    return '/relawan/dashboard';
                break; 
            case '3':
                    return '/relawan/dashboard';
                break; 
            default:
                    return '/login'; 
                break;
        }
    }

     
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    { 
        $this->middleware('guest')->except('logout');
    }

    
}
