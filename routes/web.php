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
 
 
Route::group(['middleware'=> ['auth']], function (){
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('dashboard'); 

    Route::group(['as' => 'dashboard.', 'prefix' => 'dashboard', 'namespace' => 'Dashboard'], function () {
        Route::resource('induk-organisasi', 'IndukOrganisasiController')->names('induk_organisasi');
        Route::resource('skill', 'SkillController')->names('skill');
        Route::resource('bencana', 'BencanaController')->names('bencana');
        Route::resource('persyaratan', 'PersyaratanController')->names('persyaratan');
    });
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
