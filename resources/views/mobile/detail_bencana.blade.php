@extends('mobile.layout.app')
@section('title', 'Detail Bencana - '.$bencana->judul_bencana)
@section('content')
<style>
#map {
        height: 300px;
        width:100%;
      }
</style>
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
                    Detail Informasi : {{$bencana->detail_tugas}}
                </p>
                <ul>
                  <li>
                    <div id="map"></div>
                  </li>
                   
                  <li>
                    <i class="fa fa-map"></i> Lokasi : {{$bencana->lokasi_tugas}}
                  </li>
                  <li>
                    <i class="fa fa-calendar"></i> Tanggal : {{$bencana->tgl_mulai}} s/d {{$bencana->tgl_selesai}}
                  </li>
                  <li>
                    <i class="fa fa-blind"></i> Kebutuhan Relawan : {{$bencana->quota_relawan}}
                      @if($bencana->jenis_bencana == 1)
                        <span class="badge badge-pill badge-primary">Private</span>
                      @else
                      <span class="badge badge-pill badge-success">Publik</span>
                      @endif
                  </li>
                  <li>
                    <i class="fa fa-home"></i> Instansi Pelaksana : {{$bencana->instansi}}
                  </li>
                  <li>
                    <i class="fa fa-child"></i> Ketua Pelaksana : {{$bencana->nama_pelaksana}}
                  </li> 
                  <li>
                    <i class="fa fa-list"></i> Kemampuan Minimal : 
                    @foreach($skill_minimal as $skill)
                      <p>* {{$skill->nama_skill}}</p>
                    @endforeach
                  </li> 
                  <li>
                    <i class="fa fa-list"></i> Ketentuan : 
                    @foreach($syarat_minimal as $syarat)
                      <p>* {{$syarat->nama}}</p>
                    @endforeach
                  </li> 
                  <li>
                    <?php 
                        $date1=date_create(date('Y-m-d'));
                        $date2=date_create($bencana->tgl_selesai);
                        //$diff=date_diff($date1,$date2);
                    ?>
                    @if($date1 <= $date2)
                      <span>
                          <a href="{{url('api/m/bencana/join/'.$bencana->id)}}" class="btn btn-success">Gabung Sekarang</a>
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

@section('scripts')
<script>

      function initMap() {
        var kor = {!! json_encode($bencana->koordinat_tugas) !!};
        kor = kor.split(",");

        var myLatLng = {lat: parseFloat(kor[0]), lng: parseFloat(kor[1])};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Lokasi Posko'
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvYG6uS3dswdGzItrY8_akP79eOEQYskY&callback=initMap">
    </script>
@endsection