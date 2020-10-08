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
        Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');
    }); 

    Route::group(['cekstatus'=> ['admin'], 'as' => 'dashboard.', 'prefix' => 'dashboard', 'namespace' => 'Dashboard'], function () {
        Route::resource('user', 'UserController')->names('user');
        Route::resource('induk-organisasi', 'IndukOrganisasiController')->names('induk_organisasi');
        Route::resource('skill', 'SkillController')->names('skill');
        Route::resource('bencana', 'BencanaController')->names('bencana');
        Route::resource('kategori', 'KategoriController')->names('kategori');
        Route::resource('persyaratan', 'PersyaratanController')->names('persyaratan');
        Route::resource('relawan', 'RelawanController')->names('relawan');
        Route::get('relawan-mail', 'RelawanController@mail');
        Route::post('relawan/{id}/verify', 'RelawanController@verify')->name('relawan.verify');
        Route::get('relawan/{id}/print', 'RelawanController@print')->name('relawan.print');
        Route::get('relawan/search/data', 'RelawanController@search')->name('relawan.search');
        
        Route::get('list-kegiatan', 'ListKegiatanController@index')->name('list_kegiatan.index');
        Route::get('list-kegiatan/{id}/detail', 'ListKegiatanController@detail')->name('list_kegiatan.detail');
        Route::post('list-kegiatan/{id}/update', 'ListKegiatanController@update')->name('list_kegiatan.update');
        Route::get('list-kegiatan/send-email', 'ListKegiatanController@sendEmail')->name('list_kegiatan.send_email');
        Route::get('list-kegiatan/{id}/map', 'ListKegiatanController@map')->name('list_kegiatan.map');

        Route::get('list-kegiatan/{id}/laporan_harian', 'ListKegiatanController@laporan_harian')->name('list_kegiatan.laporan_harian');
        
        Route::get('list-kegiatan/{id}/laporan_harian/create', 'ListKegiatanController@laporan_harian_create')->name('list_kegiatan.laporan_harian_create');
        
        Route::post('list-kegiatan/{id}/laporan_harian/store', 'ListKegiatanController@laporan_harian_store')->name('list_kegiatan.laporan_harian_store');
        
        Route::get('list-kegiatan/{id}/laporan_harian/edit', 'ListKegiatanController@laporan_harian_edit')->name('list_kegiatan.laporan_harian_edit');

        Route::post('list-kegiatan/{id}/laporan_harian/update', 'ListKegiatanController@laporan_harian_update')->name('list_kegiatan.laporan_harian_update');

        Route::get('list-kegiatan/{id}/laporan_harian/search', 'ListKegiatanController@laporan_harian_search')->name('list_kegiatan.laporan_harian_search');
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
        
        Route::get('relawan/bencana/search', 'Relawan\RelawanBencanaController@search')->name('relawan.search');  
        Route::get('relawan/bencana/join/{id}', 'Relawan\RelawanBencanaController@join')->name('relawan.join');  
    }); 
});

Route::get('/', 'HomeController@index')->name('home'); 
Route::get('/relawan/register', 'Relawan\RelawanController@index')->name('relawan.register'); 
Route::get('/bencana', 'BencanaController@index')->name('bencana');
Route::get('/bencana/kategori/{id}', 'BencanaController@listKategori'); 
Route::get('/bencana/detail/{id}', 'BencanaController@detail'); 
Route::get('/bencana/join/{id}', 'BencanaController@join'); 
 