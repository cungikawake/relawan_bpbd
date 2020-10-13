@extends('frontpage.layout.app')
@section('title', 'Daftar Bencana Terkini')
@section('content')
<main style="margin-top:40px;">
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
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="single-blog">
                <h4 style="min-height:50px;">
                    <a href="{{url('bencana/detail/'.$bencana->id)}}">
                    {{  substr($bencana->judul_bencana, 0, 100) }}</a>
                </h4>
                <div class="single-blog-img">
                  <a href="{{url('bencana/detail/'.$bencana->id)}}">
                    <img src="{{ asset('uploads/bencana/'.$bencana->foto_bencana) }}" alt="{{ $bencana->judul_bencana }}" style="min-width:200px; max-width:300px;">
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
                  <a href="{{url('bencana/detail/'.$bencana->id)}}" class="ready-btn">Detail</a>
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
@endsection
