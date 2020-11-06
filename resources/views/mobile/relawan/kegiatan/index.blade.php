@extends('mobile.layout.app')

@section('title', 'Dashboard Relawan')

@section('content')
<!-- Main Content -->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">Daftar Kegiatan Yang Kamu Ikuti</h3>
            </div>
             
        </div>
        <div class="content-body">
            @if(Session::has('message'))
                <div class="alert with-close alert-info mt-2">
                    {{Session::get('message')}}
                </div>
            @endif

            @if(empty($bencanas) || count($bencanas) == 0) 
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-secondary">
                                    <i class="la la-frown-o"></i>
                                    <p>Saat ini kamu belum pernah ikut bergabung di kegiatan  manapun.</p>
                                     
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
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{$bencana->judul_bencana}}</h4>
                                @if($bencana->status_join == 1)
                                    <span class="badge badge-pill badge-success">Di Setujui {{ $bencana->tgl_join }}</span>
                                @elseif($bencana->status_join == 2)
                                    <span class="badge badge-pill badge-danger">Di Tolak</span>
                                @elseif($bencana->status_join == 3)
                                    <span class="badge badge-pill badge-danger">Anda Keluar {{ $bencana->tgl_keluar }} </span>
                                @else
                                    <span class="badge badge-pill badge-info">Menunggu Konfirmasi</span>
                                @endif

                            </div>
                            
                            <img class="" src="{{ asset('uploads/bencana/'.$bencana->foto_bencana) }}" alt="Card image cap" style="max-height:150px;">
 
                            <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                                @if($bencana->status_join == 1)
                                    <span class="float-left">
                                        <a onclick="return  myFunction();" href="{{ url('relawan/bencana/keluar?relawan_bencana='.$bencana->id_relawan_bencana) }}" class="card-link text-danger"><i class="la la-close keluar_bencana"></i> Tinggalkan Bencana
                                        </a>
                                    </span>
                                @endif
                                <span class="float-right">
                                    <a type="button"  data-toggle="modal" data-target="#exampleModal_{{$bencana->id}}" class="card-link" > Detail
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

                            @if($bencana->status_join == 2 || $bencana->status_join == 3) 
                            <a href="{{url('relawan/bencana/join/'.$bencana->id)}}">
                                <button type="button" class="btn btn-primary">Gabung Lagi</button>
                            </a>
                            @endif
                        </div>
                        </div>
                    </div>
                    </div>
                    <!--modal-->
                    @endforeach
                    
                </div>
                
                {{ $bencanas->links() }} <br>

                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-secondary">
                                    <p>Ayo kita bekerja sama membantu teman, sahabat, keluarga kita.</p>
                                    <a href="{{ url('relawan/bencana/search') }}">
                                        <button class="btn btn-success">Cari Kegiatan <i class="la la-angle-right"></i></button>
                                    </a>
                                </div>
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
