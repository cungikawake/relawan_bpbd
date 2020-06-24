@extends('relawan.layout.app')

@section('title', 'Daftar Bencana Yang Kami Ikuti - Relawan')

@section('content')
<!-- Main Content --> 

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">Anda Butuh Bantuan ?</h3>
            </div>
            <div class="content-header-right col-md-8 col-12">
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('relawan.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Bantuan
                        </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Header footer section start -->
            <section id="header-footer">
                <div class="row match-height">
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>Kantor Bpbd Provinsi Bali</h4>
                                <a href="tel:+62361245395">
                                    <button class="btn btn-danger">
                                        <i class="la la-phone"></i> 0361 - 245395
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>Email</h4>
                                <a href="main:bpbdprovbali@gmail.com">
                                    <button class="btn btn-danger">
                                        <i class="la la-mail"></i> bpbdprovbali@gmail.com
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Header footer section End -->
        </div>
    </div>
</div>
<!--STOP CONTENT-->
@stop

@section('script') 
@stop
