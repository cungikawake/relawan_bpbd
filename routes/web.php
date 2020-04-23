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
        
        Route::get('list-kegiatan', 'ListKegiatanController@index')->name('list_kegiatan.index');
        Route::get('list-kegiatan/{id}/detail', 'ListKegiatanController@detail')->name('list_kegiatan.detail');
        Route::post('list-kegiatan/{id}/update', 'ListKegiatanController@update')->name('list_kegiatan.update');
        Route::get('list-kegiatan/send-email', 'ListKegiatanController@sendEmail')->name('list_kegiatan.send_email');
    });
});


//route relawan
Route::group(['middleware'=> ['auth', 'cekstatus']], function (){
    //role private public
    Route::group(['cekstatus'=> ['private','public']], function () {
        Route::get('/relawan/dashboard', 'Relawan\DashboardController@index')->name('relawan.dashboard');
        Route::get('relawan/verifikasi', 'Relawan\RelawanController@create')->name('relawan.verifikasi');  
        Route::post('relawan/verifikasi/store', 'Relawan\RelawanController@store')->name('relawan.verifikasi.store');
        Route::put('relawan/verifikasi/update', 'Relawan\RelawanController@store')->name('relawan.verifikasi.update'); 
        Route::get('relawan/profile', 'Relawan\RelawanController@profile')->name('relawan.profile');  
        Route::get('relawan/bencana', 'Relawan\RelawanBencanaController@index')->name('relawan.bencana');  
        Route::get('relawan/bencana/keluar', 'Relawan\RelawanBencanaController@destroy');  
        Route::get('relawan/bantuan', 'Relawan\DashboardController@bantuan')->name('bantuan');  
    }); 
});

Route::get('/', 'HomeController@index')->name('home'); 
Route::get('/relawan/register', 'Relawan\RelawanController@index')->name('relawan.register'); 
Route::get('/bencana', 'BencanaController@index')->name('bencana'); 
Route::get('/bencana/detail/{id}', 'BencanaController@detail'); 
Route::get('/bencana/join/{id}', 'BencanaController@join'); 
 