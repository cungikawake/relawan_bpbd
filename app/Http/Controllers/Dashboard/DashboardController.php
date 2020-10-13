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
        $relawans = Relawan::select(
            'relawan.id as id_relawan', 
            'users.name as name',
            'users.id as id_user',
            'users.email as email',
            'users.tlp as tlp',
            'relawan.jenis_relawan as jenis_relawan',
            'relawan.nomor_relawan as nomor_relawan',
            'induk_organisasi.nama_organisasi as nama_organisasi',
            'skill.nama_skill as nama_skill',
            'relawan.ktp_file as ktp_file',
            'relawan.foto_file as foto_file'
        )
        ->rightJoin('users', 'users.id', '=', 'relawan.id_user')
        ->leftJoin('induk_organisasi', 'induk_organisasi.id', '=', 'relawan.id_induk_relawan')
        ->leftJoin('skill', 'skill.id', '=', 'relawan.skill_utama')
        ->orderBy('users.id', 'desc')
        ->limit(5)
        ->get();

        $relawans_pending = Relawan::select(
            'relawan.id as id_relawan', 
            'users.name as name',
            'users.id as id_user',
            'users.email as email',
            'users.tlp as tlp',
            'relawan.jenis_relawan as jenis_relawan',
            'relawan.nomor_relawan as nomor_relawan',
            'induk_organisasi.nama_organisasi as nama_organisasi',
            'skill.nama_skill as nama_skill',
            'relawan.ktp_file as ktp_file',
            'relawan.foto_file as foto_file'
        )
        ->rightJoin('users', 'users.id', '=', 'relawan.id_user')
        ->leftJoin('induk_organisasi', 'induk_organisasi.id', '=', 'relawan.id_induk_relawan')
        ->leftJoin('skill', 'skill.id', '=', 'relawan.skill_utama')
        ->whereNotNull('relawan.ktp_file')
        ->where('relawan.jenis_relawan', 1) 
        ->orderBy('users.id', 'desc')
        ->limit(5)
        ->get();

        $bencanas = Bencana::orderBy('id', 'desc')->limit(5)->get();

        return view('dashboard.dashboard', compact('total_bencana', 'total_relawan_private', 'total_relawan_publik', 'relawans', 'bencanas', 'relawans_pending'));
    }
}
