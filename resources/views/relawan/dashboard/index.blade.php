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
                                <h4 class="card-title">Selamat Datang {{ $user->name }}, Sekarang Kamu Menjadi Relawan</h4>
                                <h6 class="card-subtitle text-muted">Data anda belum terverifikasi, saat ini anda menjadi relawan jenis publik</h6>
                                <div class="alert alert-secondary">
                                    <p>Ajukan verifikasi akun sekarang ?</p>
                                    <a href="{{ route('relawan.verifikasi') }}">
                                        <button class="btn btn-success"><i class="la la-file"></i> Ya, Lanjutkan</button>
                                    </a>
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
