@extends('frontpage.layout.app')
@section('title', 'Detail Bencana - '.$bencana->judul_bencana)
@section('content')
<main style="margin-top:40px;">
    <!-- ======= About Section ======= -->
    <div id="about" class="about-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>{{$bencana->judul_bencana}}</h2>
            </div>
          </div>
        </div>

        <div class="row">
            @if(Session::has('message'))
                <div class="alert with-close alert-info mt-2">
                    {{Session::get('message')}}
                </div>
            @endif 
        </div>
        
        <div class="row">
          <!-- single-well start-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="well-left">
              <div class="single-well">
                <a href="#">
                  <img src="{{ asset('uploads/bencana/'.$bencana->foto_bencana) }}" alt="bencana" style="max-height:400px;">
                </a>
              </div>
            </div>
          </div>
          <!-- single-well end-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="well-middle">
              <div class="single-well">
                <a href="#">
                  <h4 class="sec-head">Tugas Relawan</h4>
                </a>
                <p>
                    {{$bencana->detail_tugas}}
                </p>
                <ul>
                  <li>
                    <i class="fa fa-map"></i> Lokasi : {{$bencana->lokasi_tugas}}
                  </li>
                  <li>
                    <i class="fa fa-calendar"></i> Tanggal : {{$bencana->tgl_mulai}} s/d {{$bencana->tgl_selesai}}
                  </li>
                  <li>
                    <i class="fa fa-blind"></i> Quota Relawan : {{$bencana->quota_relawan}}
                  </li>
                  <li>
                    <i class="fa fa-home"></i> Instansi : {{$bencana->instansi}}
                  </li>
                  <li>
                    <i class="fa fa-child"></i> Tim Pelaksana : {{$bencana->nama_pelaksana}}
                  </li> 
                  <li>
                    <?php 
                        $date1=date_create(date('Y-m-d'));
                        $date2=date_create($bencana->tgl_selesai);
                        //$diff=date_diff($date1,$date2);
                    ?>
                    @if($date1 >= $date2)
                        <span>
                            <a href="{{url('bencana/join/'.$bencana->id)}}" class="ready-btn right-btn page-scroll">Gabung Sekarang</a>
                        </span>
                    @else
                        <br>
                        <span class="alert alert-warning">
                            Kegiatan sudah berakhir.
                        </span>
                    @endif
                  </li> 
                </ul>
              </div>
            </div>
          </div>
          <!-- End col-->
        </div>
      </div>
    </div><!-- End About Section -->
</main>
@endsection
