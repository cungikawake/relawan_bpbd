<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Setup CORS */
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");




Route::get('/', function () {
    return [
        'app' => 'Api E-Relawan',
        'version' => '1.0.0',
    ];
});

/* User register */
Route::post('register', 'Api\UserController@register');  

//get user
/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

// Route::post('login', 'Auth\LoginController@ApiLogin');
Route::post('login', function (Request $request) {
    
    if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
        // Authentication passed...
        $user = auth()->user();
        $user->api_token = Str::random(16);
        $user->save();
        return $user;
    }
    
    return response()->json([
        'error' => 'Unauthenticated user',
        'code' => 401,
    ], 401);
});

Route::middleware('auth:api')->post('logout', function (Request $request) {
    
    if (auth()->user()) {
        $user = auth()->user();
        $user->api_token = null; // clear api token
        $user->save();

        return response()->json([
            'code' => 200,
            'message' => 'Logout Success, Thank you for using our application',
        ]);
    }
    
    return response()->json([
        'error' => 'Unable to logout user',
        'code' => 401,
    ], 401);
});

//bencana
Route::get('berita', 'Api\BeritaController@index'); 

//bencana
Route::get('list_bencana', 'Api\BencanaController@index');  //where kategori
Route::get('list_bencana/detail', 'Api\BencanaController@detail');  
Route::get('kategori', 'Api\BencanaController@getKategori');  
//master data
Route::get('organisasi', 'Api\RelawanController@organisasi');
Route::get('skill', 'Api\RelawanController@skill'); 

//relawan
Route::group(['middleware'=> ['auth:api']], function (){
    Route::get('m/home/', 'Api\WebviewController@index'); 

    //data pribadi
    Route::get('/user', 'Api\RelawanController@profile');

    //ajukan data pribadi
    Route::post('relawan/verifikasi', 'Api\RelawanController@store');

    //join bencana
    Route::post('relawan/join/bencana', 'Api\BencanaController@join');
    Route::post('relawan/gps/bencana', 'Api\BencanaController@storeGps');

});

//home view mobile
Route::get('m/home/', 'Api\WebviewController@index'); 
Route::get('m/bencana/kategori/', 'Api\WebviewController@kategori'); 
Route::get('m/bencana/kategori/{id}/{token}', 'Api\WebviewController@kategori_list'); 
Route::get('m/bencana/detail/{id}/{token}', 'Api\WebviewController@bencana_detail'); 
Route::get('m/bencana/join/{id}/{token}', 'Api\WebviewController@bencana_join'); 


