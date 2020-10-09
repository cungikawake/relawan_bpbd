@extends('relawan.layout.app')

@section('title', 'Daftar Kegiatan  - Relawan')

@section('content')
<!-- Main Content --> 

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
         
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">Semua Daftar Kegiatan</h3>
            </div>
            <div class="content-header-right col-md-8 col-12">
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('relawan.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Daftar Kegiatan
                        </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            @if(Session::has('message'))
                <div class="alert with-close alert-info mt-2">
                    {{Session::get('message')}}
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
                                @if($bencana->jenis_bencana == 1)
                                    <span class="badge badge-pill badge-success">Private</span>
                                @else
                                    <span class="badge badge-pill badge-info">Publik</span>
                                @endif

                            </div>
                            
                            <img class="" src="{{ asset('uploads/bencana/'.$bencana->foto_bencana) }}" alt="Card image cap" style="max-height:150px;">

                            
                            <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted"> 
                                <span class="float-right">
                                    <a type="button"  data-toggle="modal" data-target="#exampleModal_{{$bencana->id}}" class="card-link"> Detail
                                        <i class="la la-angle-right"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal_{{$bencana->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{$bencana->judul_bencana}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-header">
                                    <img class="" src="{{ asset('uploads/bencana/'.$bencana->foto_bencana) }}" alt="Card image cap" style="max-height:150px;">

                                </div>
                                <div class="card-body">
                                    <h6 class="card-subtitle text-muted"><i class="la la-map-marker"></i> Lokasi {{$bencana->lokasi_tugas}}</h6>

                                    <p  ><i class="la la-bank"></i> Instansi {{$bencana->instansi}}</p>

                                    <p  ><i class="la la-calendar-check-o"></i> Tanggal  {{ date('d M Y', strtotime($bencana->tgl_mulai)) }} s/d {{ date('d M Y', strtotime($bencana->tgl_selesai)) }} </p>
                                     
                                    <p  ><i class="la la-user"></i>Max {{$bencana->quota_relawan}} Orang </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

                            <a href="{{url('relawan/bencana/join/'.$bencana->id)}}">
                            <button type="button" class="btn btn-primary">Gabung Sekarang</button>
                            </a>
                        </div>
                        </div>
                    </div>
                    </div>
                    @endforeach
                </div>
                
                {{ $bencanas->links() }} 
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
    if (window.confirm("Anda yakin untuk meninggalkan kegiatan ini ?")) { 
        return true;
    }else{
        return false;
    }
}
</script>
@stop
