@extends('mobile.layout.app') 

@section('title', 'E-Relawan')

@section('content') 
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
                    <img src="{{$kategori->displayImage()}}"  alt="erelawan" class="img">
                    <p style="font-size:1rem;">
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

</main>
@stop