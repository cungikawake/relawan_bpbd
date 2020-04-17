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
                <!-- Chart -->
                <div class="row match-height">
                    <div class="col-12">
                        <div id="carousel-area" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-area" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-area" data-slide-to="1"></li>
                                <li data-target="#carousel-area" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <img src="{{ asset('theme-assets/images/carousel/08.jpg') }}" class="d-block w-100" alt="First slide" height="300px">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('theme-assets/images/carousel/03.jpg') }}" class="d-block w-100" alt="Second slide" height="300px">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('theme-assets/images/carousel/01.jpg') }}" class="d-block w-100" alt="Third slide" height="300px">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carousel-area" role="button" data-slide="prev">
                                    <span class="la la-angle-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            <a class="carousel-control-next" href="#carousel-area" role="button" data-slide="next">
                                    <span class="la la-angle-right icon-next" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                        </div>
                    </div>
                </div>
                <!-- Chart -->

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
            </div>
        @endif

    </div>
</div>

<!--STOP CONTENT-->
@stop

@section('script')
<script></script>
@stop
