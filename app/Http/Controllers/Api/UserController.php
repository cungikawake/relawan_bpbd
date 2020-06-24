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
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], 
            'tlp' => ['required', 'number', 'min:10', 'max:15', 'unique:users'],
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
            'tlp' => $request['tlp'],
            'api_token' => Str::random(16)
        ]); 
 
        return $this->registered($request, $user)?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
       
        return response()->json(['data' => $user->toArray()], 201);
    }
 

}
