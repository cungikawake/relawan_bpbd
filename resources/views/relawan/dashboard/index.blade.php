@extends('relawan.layout.app')

@section('title', 'Dashboard Relawan')

@section('content')
<!-- Main Content -->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row"></div>

        @if(empty($relawan))
            <div class="content-body">
                <!-- Chart -->
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Selamat Datang {{ $user->name }}, Sekarang Kamu Menjadi Relawan Non-Verifikasi</h4>
                                <h6 class="card-subtitle text-muted">Saat ini anda menjadi relawan jenis publik</h6>
                                <div class="alert alert-secondary">
                                    <p>Apakah anda ingin verifikasi akun ?</p>
                                    <a href="{{ route('relawan.verifikasi') }}">
                                        <button class="btn btn-success"><i class="la la-file"></i> Ya</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-secondary">
                                    <p>Ayo kita bekerja sama membantu teman, sahabat, keluarga kita.</p>
                                    <a href="{{ url('/bencana') }}">
                                        <button class="btn btn-success">Cari Bencana <i class="la la-angle-right"></i></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Relawan Non-Verifikasi</h4>
                                <div class="alert alert-secondary">
                                    <p> Relawan Non-Verifikasi adalah Relawan yang hanya bisa ikut membantu pada kegiatan bencana yang berstatus publik</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Relawan Terverifikasi</h4>
                                <div class="alert alert-secondary">
                                    <p> Relawan Terverifikasi adalah Relawan yang  bisa ikut membantu pada kegiatan bencana yang berstatus publik dan private, dan memiliki Nomor Relawan</p>
                                    <p> Verifikasi Sekarang 
                                        <a href="{{ route('relawan.verifikasi') }}">
                                            <button class="btn btn-success"><i class="la la-file"></i> Ya</button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            Mohon, menunggu akun anda belum terverifikasi.
                        </div>
                    @endif 
                </div>
                <!--/ eCommerce statistic --> 

                <!-- Chart -->
                <div class="row match-height">
                    <div class="col-md-2">
                         <a href="{{ url('/relawan/profile') }}">
                         <div class="card">
                            <div class="card-body">
                                <img src="https://image.flaticon.com/icons/svg/2825/2825345.svg" style="max-height:100px;">
                            </div>
                         </div>
                         </a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ url('/relawan/bencana') }}">
                         <div class="card">
                            <div class="card-body">
                                <img src="https://image.flaticon.com/icons/svg/1684/1684394.svg" style="max-height:100px;">
                            </div>
                         </div>
                         </a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ url('/relawan/bantuan') }}">
                         <div class="card">
                            <div class="card-body">
                                <img src="https://image.flaticon.com/icons/svg/544/544570.svg" style="max-height:100px;">
                            </div>
                         </div>
                        </a>
                    </div>
                </div>
                <!-- Chart -->

                
            </div>
        @endif

    </div>
</div>

<!--STOP CONTENT-->
@stop

@section('script')
<script></script>
@stop
