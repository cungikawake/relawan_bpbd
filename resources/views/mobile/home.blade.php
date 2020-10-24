@extends('mobile.layout.app') 

@section('title', 'E-Relawan')

@section('content') 
<!-- ======= Slider Section ======= -->
<div id="home" class="slider-area" style="margin-top:0;">
    <div class="bend niceties preview-2">
      <div id="ensign-nivoslider" class="slides">
        <img src="{{ asset('frontpage/assets/img/slider/bencana2.jpeg') }}" alt="" title="#slider-direction-1" />
        <img src="{{ asset('frontpage/assets/img/slider/bencana3.jpeg') }}" alt="" title="#slider-direction-2" />
        <img src="{{ asset('frontpage/assets/img/slider/bencana4.jpg') }}" alt="" title="#slider-direction-3" />
      </div>

      <!-- direction 1 -->
      <div id="slider-direction-1" class="slider-direction slider-one">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow slideInDown" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1">Relawan Penanggulangan Bencana</h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">Meningkatkan kapasitas relawan agar dapat bekerja dengan terkoordinasi, efektif dan efisien</h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="{{route('register')}}">Register Relawan</a>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- direction 2 -->
      <div id="slider-direction-2" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content text-center">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1"></h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">Peran serta relawan dalam kegiatan
penanggulangan bencana</h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="{{route('register')}}">Jadi Relawan</a>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- direction 3 -->
      <div id="slider-direction-3" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1"></h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">Meningkatkan kinerja serta daya dan hasil guna kegiatan relawan</h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="{{route('register')}}">Jadi Relawan</a>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div><!-- End Slider -->
<main id="main">
    <!-- ======= Services Section ======= -->
    <div id="services" class="services-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline services-head text-center">
              <h2>Kategori Bencana</h2>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <!-- Start Left services -->
          @foreach($kategoris as $kategori)
          <div class="col-4">
            <div class="about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="{{ url('api/m/bencana/kategori/'.$kategori->id) }}">
                    <img src="{{$kategori->displayImage()}}"  alt="erelawan" class="img" style="width:60px;">
                    <p style="font-size:14px;">
                      {{ $kategori->nama_kategori }}
                    </p>
                  </a>
                </div>
              </div>
              <!-- end about-details -->
            </div>
          </div>
          @endforeach
          <!-- Start Left services --> 
        </div>
      </div>
    </div><!-- End Services Section -->

    @if(!empty($bencanas))
    <!-- ======= Blog Section ======= -->
    <div id="blog" class="blog-area">
      <div class="blog-inner area-padding">
        <div class="blog-overly"></div>
        <div class="container ">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Bencana Terupdate</h2>
              </div>
            </div>
          </div>
          <div class="row">
          @foreach($bencanas as $bencana)
            <!-- Start Left Blog -->
            <div class="col-md-4 col-sm-4 col-xs-12">
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
                      <a href="#">{{ $bencana->quota_relawan }} Orang</a>
                      @if($bencana->jenis_bencana == 1)
                        <span class="badge badge-pill badge-primary">Private</span>
                      @else
                      <span class="badge badge-pill badge-success">Publik</span>
                      @endif
                    </span>
                  </div>
                  <span class="date-type">
                    <i class="fa fa-calendar"></i> {{ date('d M Y', strtotime($bencana->tgl_mulai)) }} s/d {{ date('d M Y', strtotime($bencana->tgl_selesai)) }} 
                  </span>
                  <p>
                  {{  substr($bencana->detail_tugas, 0, 100) }}... 
                  </p>
                </div>
                
                <div class="blog-meta">
                  <span class="comments-type">
                    <i class="fa fa-map"></i>
                    <small>{{ $bencana->lokasi_tugas }}</small>
                  </span>
                </div>
                <span>
                  <a href="{{url('api/m/bencana/detail/'.$bencana->id.'/'.$token)}}" class="ready-btn">Detail</a>
                </span>
              </div>
              <!-- Start single blog -->
            </div>
            @endforeach
            <!-- End Left Blog-->
          </div>
        </div>
      </div>
    </div><!-- End Blog Section -->  
    @endif
</main>
@stop