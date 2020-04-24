<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Relawan;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], 
        ]);
    }

    public function register(Request $request)
    {
         
        $this->validator($request->all())->validate();
 
        $user =   User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 3,
            'api_token' => Str::random(16)
        ]); 
 
        return $this->registered($request, $user)?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
       
        return response()->json(['data' => $user->toArray()], 201);
    }
 

}
