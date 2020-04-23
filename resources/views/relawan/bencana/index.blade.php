@extends('relawan.layout.app')

@section('title', 'Daftar Bencana Yang Kami Ikuti - Relawan')

@section('content')
<!-- Main Content --> 

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">Daftar Bencana Yang Kamu Ikuti</h3>
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
            @if(empty($bencanas) || count($bencanas) == 0) 
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-secondary">
                                    <p>Kamu belum pernah ikut bergabung, Ayo kita kerja sama bantu teman, sahabat, keluarga kita.</p>
                                    <a href="{{ url('/becana') }}">
                                        <button class="btn btn-success">Cari Bencana <i class="la la-angle-right"></i></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Header footer section start -->
            <section id="header-footer">
                <div class="row match-height">
                    @foreach($bencanas as $bencana)
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{$bencana->judul_bencana}}</h4>
                                @if($bencana->status_join == 1)
                                    <span class="badge badge-pill badge-success">Di Setujui</span>
                                @elseif($bencana->status_join == 2)
                                    <span class="badge badge-pill badge-danger">Di Batalkan</span>
                                @else
                                    <span class="badge badge-pill badge-info">Menunggu Konfirmasi</span>
                                @endif

                            </div>
                            
                            <img class="" src="{{ asset('uploads/bencana/'.$bencana->foto_bencana) }}" alt="Card image cap" style="max-height:150px;">

                            <div class="card-body">
                                <h6 class="card-subtitle text-muted"><i class="la la-map-marker"></i> {{$bencana->lokasi_tugas}}</h6>
                                <p class="card-link"><i class="la la-bank"></i> {{$bencana->instansi}}</p>
                                <span class="float-left"><i class="la la-calendar-check-o"></i> {{$bencana->tgl_mulai}} s/d {{$bencana->tgl_selesai}} </span>
                            </div>
                            <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                                @if($bencana->status_join == 1)
                                    <span class="float-left">
                                        <a onclick="return  myFunction();" href="{{ url('relawan/bencana/keluar?relawan_bencana='.$bencana->id_relawan_bencana) }}" class="card-link"><i class="la la-angle-left keluar_bencana"></i> Tinggalkan Bencana
                                        </a>
                                    </span>
                                @endif
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
<script>
function myFunction() {
    if (window.confirm("Do you really want to leave?")) { 
        return true;
    }else{
        return false;
    }
}
</script>
@stop
