@extends('mobile.layout.app')

@section('title', 'Dashboard Relawan')

@section('content')
<!-- Main Content -->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row"></div>

        @if(empty($user->status_verified) || $relawan->id_induk_relawan == 0)
            <div class="content-body">
                <!-- Chart -->
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Selamat Datang {{ $user->name }}, Sekarang anda adalah Relawan Umum</h4>
                                <h6 class="card-subtitle text-muted">Anda hanya bisa mengikuti kegiatan  jenis publik</h6>

                                <!-- <div class="row">
                                    <div class="col-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Relawan Umum</h4>
                                                <div class="alert alert-secondary">
                                                    <p> Relawan Umum adalah Relawan yang hanya bisa ikut membantu pada kegiatan bencana yang bersifat umum</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Relawan Terverifikasi</h4>
                                                <div class="alert alert-secondary">
                                                    <p> Relawan Terverifikasi adalah Relawan yang  bisa mengikuti kegiatan bencana bersifat umum dan private, dan memiliki Nomor Relawan</p>
                                                    <p> Ajukan diri sekarang 
                                                        <a href="{{ route('relawan.verifikasi') }}">
                                                            <button class="btn btn-success"><i class="la la-file"></i> Ya</button>
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 -->
                                <div class="alert alert-secondary">
                                    <p>Apakah anda ingin menjadi Relawan Terverifikasi, Ajukan data diri  sekarang!</p>
                                    <a href="{{ route('relawan.bencana') }}">
                                        <button class="btn btn-danger"><i class="la la-cros"></i> Nanti Saja</button>
                                    </a>
                                    <a href="{{ route('relawan.verifikasi') }}">
                                        <button class="btn btn-success"> Lanjutkan <i class="la la la-angle-right"></i></button>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-secondary">
                                    <p>Ayo kita bekerja sama membantu teman, sahabat, keluarga kita disetiap kegiatan bencana.</p>
                                    <a href="{{ url('/bencana') }}">
                                        <button class="btn btn-success">Cari Kegiatan <i class="la la-angle-right"></i></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    
                </div>
                <!-- Chart -->
            </div>
        @else
            <div class="content-body">
                <!-- eCommerce statistic -->
                <div class="row">
                    @if(Session::has('message'))
                        <div class="alert with-close alert-info mt-2">
                            {{Session::get('message')}}
                        </div>
                    @endif 
                </div>
                <!--/ eCommerce statistic --> 

                <!-- eCommerce statistic -->
                <div class="row">
                    @if($relawan->nomor_relawan == null)
                        <div class="alert with-close alert-info mt-2">
                            Mohon, menunggu akun anda sedang proses di tinjau.
                        </div>
                    @endif 
                </div>
                <!--/ eCommerce statistic --> 

                <!-- Chart -->
                <div class="row match-height">
                    <!-- <div class="col-md-4">
                         <a href="{{ url('/relawan/profile') }}">
                         <div class="card">
                            <div class="card-body text-center">
                                <img src="https://image.flaticon.com/icons/svg/2825/2825345.svg" style="max-height:100px;">
                                <h3>Profile</h3>
                            </div>
                         </div>
                         </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ url('/relawan/bencana') }}">
                         <div class="card">
                            <div class="card-body text-center">
                                <img src="https://image.flaticon.com/icons/svg/1684/1684394.svg" style="max-height:100px;">
                                <h3>Kegiatan</h3>
                            </div>
                         </div>
                         </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ url('/relawan/bantuan') }}">
                         <div class="card">
                            <div class="card-body text-center">
                                <img src="https://image.flaticon.com/icons/svg/544/544570.svg" style="max-height:100px;">
                                <h3>Bantuan</h3>
                            </div>
                         </div>
                        </a>
                    </div>  -->
                </div>
                <!-- Chart --> 
            </div>
        @endif

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    
                    <div class="card-body text-center">
                        <h5>Total Disetujui</h5>
                        <h2 class="  p-1">{{ $bencana['aktif'] }}</h2>
                    </div>
                </div> 
            </div>
            <div class="col-md-4">
                <div class="card">
                    
                    <div class="card-body text-center">
                        <h5>Total Ditolak</h5>
                        <h2 class="  p-1">{{ $bencana['ditolak'] }}</h2>
                    </div>
                </div> 
            </div>
            <div class="col-md-4">
                <div class="card">
                    
                    <div class="card-body text-center">
                        <h5>Total Keluar</h5>
                        <h2 class="  p-1">{{ $bencana['keluar'] }}</h2>
                    </div>
                </div> 
            </div> 
        </div>


    </div>
</div>

<!--STOP CONTENT-->
@stop

@section('script')
<script></script>
@stop
