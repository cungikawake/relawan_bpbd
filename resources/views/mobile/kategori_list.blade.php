@extends('mobile.layout.app') 

@section('title', 'E-Relawan')

@section('content') 
<main id="main">
    <!-- ======= Blog Section ======= -->
    <div id="blog" class="blog-area">
      <div class="blog-inner area-padding">
        <div class="container ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="section-headline text-center">
                    <h3>Daftar Bencana {{ (isset($kategori->nama_kategori))? $kategori->nama_kategori : ''}}</h3>
                    <p>Mari kita bekerja sama untuk dapat membantu di setiap bencana</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row" style="margin-top:20px;">
          @foreach($bencanas as $bencana)
            <!-- Start Left Blog -->
            <div class="col-6 col-md-4 col-lg-4 ">
              <div class="single-blog">
                <h4 style="font-size:14px;">
                    <a href="{{url('api/m/bencana/detail/'.$bencana->id.'/'.$token)}}">{{ $bencana->judul_bencana }}</a>
                </h4>
                <div class="single-blog-img">
                  <a href="{{url('api/m/bencana/detail/'.$bencana->id.'/'.$token)}}">
                    <img src="{{ asset('uploads/bencana/'.$bencana->foto_bencana) }}" alt="">
                  </a>
                </div>
                <div class="blog-text"> 
                  <div class="blog-meta">
                    <span class="comments-type">
                      <i class="fa fa-user"></i>
                      <a href="#" style="font-size:12px;">{{ $bencana->quota_relawan }} Orang</a>
                      @if($bencana->jenis_bencana == 1)
                        <span class="badge badge-pill badge-primary">Private</span>
                      @else
                      <span class="badge badge-pill badge-success">Publik</span>
                      @endif
                    </span>
                  </div>
                  <span class="date-type" style="font-size:12px;">
                    <i class="fa fa-calendar" style="font-size:12px;"></i> {{ date('d M Y', strtotime($bencana->tgl_mulai)) }} s/d {{ date('d M Y', strtotime($bencana->tgl_selesai)) }} 
                  </span>
                  <p style="font-size:12px;">
                  {{  substr($bencana->detail_tugas, 0, 100) }}... 
                  </p>
                </div>
                
                <div class="blog-meta">
                  <span class="comments-type">
                    <i class="fa fa-map"></i>
                    <small style="font-size:12px;">{{ $bencana->lokasi_tugas }}</small>
                  </span>
                </div>
                <span>
                  <a href="{{url('api/m/bencana/detail/'.$bencana->id.'/'.$token)}}" class="ready-btn">Detail</a>
                </span>
              </div>
              <!-- Start single blog -->
            </div>
          @endforeach
          </div>
          <br>
          <div class="m-0">
            {{ $bencanas->links() }}
          </div>
        </div>
      </div>
    </div><!-- End Blog Section --> 
</main>
@stop