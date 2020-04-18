@extends('relawan.layout.app')

@section('title', 'Daftar Bencana Yang Kami Ikuti - Relawan')

@section('content')
<!-- Main Content --> 

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">Daftar Bencana Yang Kami Ikuti</h3>
            </div>
            <div class="content-header-right col-md-8 col-12">
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('relawan.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Bencana
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
                    @foreach($bencanas as $bencana)
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{$bencana->judul_bencana}}</h4>
                                <span class="badge badge-pill badge-danger">Menunggu Konfirmasi</span>
                            </div>
                            
                            <img class="" src="{{ asset('uploads/bencana/'.$bencana->foto_bencana) }}" alt="Card image cap" style="max-height:150px;">

                            <div class="card-body">
                                <h6 class="card-subtitle text-muted"><i class="la la-map-marker"></i> {{$bencana->lokasi_tugas}}</h6>
                                <p class="card-link"><i class="la la-bank"></i> {{$bencana->instansi}}</p>
                                <span class="float-left"><i class="la la-calendar-check-o"></i> {{$bencana->tgl_mulai}} s/d {{$bencana->tgl_selesai}} </span>
                            </div>
                            <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                                <span class="float-right">
                                    <a href="{{ url('bencana/detail/'.$bencana->id) }}" class="card-link">Lihat Detail
                                        <i class="la la-angle-right"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            <!-- Header footer section End -->
        </div>
    </div>
</div>
<!--STOP CONTENT-->
@stop

@section('script')
<script></script>
@stop
