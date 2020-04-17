<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//role admin 
Route::group(['middleware'=> ['auth', 'cekstatus']], function (){
    Route::group(['cekstatus'=> ['admin']], function () {
        Route::get('/dashboard', function () {
            return view('dashboard.dashboard');
        })->name('dashboard'); 
    });

    Route::group(['cekstatus'=> ['admin'], 'as' => 'dashboard.', 'prefix' => 'dashboard', 'namespace' => 'Dashboard'], function () {
        Route::resource('user', 'UserController')->names('user');
        Route::resource('induk-organisasi', 'IndukOrganisasiController')->names('induk_organisasi');
        Route::resource('skill', 'SkillController')->names('skill');
        Route::resource('bencana', 'BencanaController')->names('bencana');
        Route::resource('persyaratan', 'PersyaratanController')->names('persyaratan');
        Route::resource('relawan', 'RelawanController')->names('relawan');
        Route::get('relawan-mail', 'RelawanController@mail');
        Route::post('relawan/{id}/verify', 'RelawanController@verify')->name('relawan.verify');
        Route::get('relawan/{id}/print', 'RelawanController@print')->name('relawan.print');
    });
});


//route relawan
Route::group(['middleware'=> ['auth', 'cekstatus']], function (){
    //role private
    Route::group(['cekstatus'=> ['private','public']], function () {
        Route::get('/relawan/dashboard', 'Relawan\DashboardController@index')->name('relawan.dashboard');
        Route::get('relawan/verifikasi', 'Relawan\RelawanController@create')->name('relawan.verifikasi');  
        Route::post('relawan/verifikasi/store', 'Relawan\RelawanController@store')->name('relawan.verifikasi.store');
        Route::put('relawan/verifikasi/update', 'Relawan\RelawanController@store')->name('relawan.verifikasi.update'); 
        Route::get('relawan/profile', 'Relawan\RelawanController@profile')->name('relawan.profile');  
    }); 
});

Route::get('/', 'HomeController@index')->name('home'); 
Route::get('/relawan/register', 'Relawan\RelawanController@index')->name('home'); 
 