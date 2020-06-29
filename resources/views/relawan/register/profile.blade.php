@extends('relawan.layout.app')

@section('title', 'Profile Relawan')

@section('content')
<!-- Main Content -->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row"></div>
        
        @if(empty($model)) 
            <div class="content-body">
                <!-- Chart -->
                <div class="row match-height">
                    <div class="col-12">
                        <!-- profile -->
                        <div id="user-profile">
                            <div class="row">
                                @if(Session::has('message'))
                                    <div class="alert with-close alert-info mt-2">
                                        {{Session::get('message')}}
                                    </div>
                                @endif
                                <div class="col-sm-12 col-xl-8">
                                    <div class="media d-flex m-1 ">
                                        <div class="align-left p-1">
                                            <a href="#" class="profile-image">
                                                <img src="https://cdn.iseated.com/assets/img/nopicture.jpg" class="rounded-circle img-border height-100" alt="Card image">
                                            </a>
                                        </div>
                                        <div class="media-body text-left  mt-1">
                                            <h3 class="font-large-1 white">{{$user->name}}</h3>
                                            <span class="font-medium-1 white">({{$user->email}})</span>
                                            @if($user->status_verified == 1)
                                            <span class="badge badge-pill badge-success">Relawan Terverifikasi</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Relawan Umum</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-secondary">
                                    <p>Selamat Datang {{$user->name}}. Sekarang anda adalah Relawan Umum</p>
                                    <p>Apakah anda ingin menjadi Relawan Terverifikasi. Ajukan data diri  sekarang!</p>
                                    <a href="{{ route('relawan.verifikasi') }}">
                                        <button class="btn btn-success"><i class="la la-file"></i> Ya, Lanjutkan</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Chart -->
            </div>
        @else
        <div class="content-body">
            <!-- profile -->
            <div id="user-profile">
                <div class="row">
                    @if(Session::has('message'))
                        <div class="alert with-close alert-info mt-2">
                            {{Session::get('message')}}
                        </div>
                    @endif 
                </div>
                <div class="row">
                    <div class="col-sm-12 col-xl-8">
                        <div class="media d-flex m-1 ">
                            <div class="align-left p-1">
                                <a href="#" class="profile-image">
                                    <img src="{{ asset('uploads/relawan/'.$model->id.'/'.$model->foto_file) }}" class="rounded-circle img-border height-100" alt="Card image">
                                </a>
                            </div>
                            <div class="media-body text-left  mt-1">
                                <h3 class="font-large-1 white">{{$model->nama_lengkap}}
                                    <span class="font-medium-1 white">({{$model->email}})</span>
                                </h3>
                                <p class="white">
                                    <i class="ft-map-pin white"> </i>{{$model->alamat}} </p>
                                <p class="white">
                                    <i class="ft-phone white"> </i>{{$model->tlp}} </p>
                                <p class="white text-bold-300 d-none d-sm-block">
                                    @if($model->nomor_relawan == null)
                                        <div class="alert round bg-warning alert-icon-right alert-dismissible mb-2" role="alert">
                                            <span class="alert-icon">
                                                <i class="ft-watch"></i>
                                            </span>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                           Data Pribadi sudah terkiri, Akun anda belum terverifikasi oleh tim.
                                        </div>
                                    @else
                                        <i class="ft-file white"> </i>{{$model->nomor_relawan}}
                                    @endif
                                </p>
                                <!-- <ul class="list-inline">
                                    <li class="pr-1 line-height-1">
                                        <a href="#" class="font-medium-4 white ">
                                            <span class="ft-edit"></span> Edit Profile 
                                        </a>
                                    </li> 
                                </ul>  -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-5 col-md-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="card-title-wrap bar-primary">
                                    <div class="card-title">Data Pribadi</div>
                                    <hr>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body p-0 pt-0 pb-1">
                                    <ul>
                                        <li>
                                            NIK : {{$model->ktp}}
                                        </li>
                                        <li>
                                            JK : {{$model->jenis_kelamin}}
                                        </li>
                                        <li>
                                            Pekerjaan : {{$model->pekerjaan}}
                                        </li>
                                        <li>
                                            Pendidikan : {{$model->pendidikan}}
                                        </li>
                                        <li>
                                            Tgl Lahir : {{$model->tgl_lahir}}
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div> 
                    </div>
                    <div class="col-xl-9 col-lg-7 col-md-12">
                    <!--Project Timeline div starts-->
                    <div id="timeline">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title-wrap bar-primary">
                                <div class="card-title">Skill, Pelatihan, dan Pengalaman Relawan</div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="timeline">
                                        <h4>Skill Relawan</h4>
                                        <hr>
                                        <ul class="list-unstyled base-timeline activity-timeline mt-3">
                                            @foreach($model_skills as $skill)
                                            <li>
                                                <i class="ft-feather"></i>{{$skill->nama_skill}}
                                            </li>
                                            @endforeach
                                        </ul>

                                        <br>

                                        <h4>Pelatihan  Relawan</h4>
                                        <hr>
                                        <ul class="list-unstyled base-timeline activity-timeline mt-3">
                                            @foreach($pelatihan as $latihan)
                                                <li>
                                                    <div class="alert bg-primary white m-0">
                                                        Jenis Pelatihan : {{$latihan->jenis_pelatihan}}
                                                    </div>
                                                    <div class="act-time">- Tahun : {{$latihan->tahun}}</div>
                                                    <span class="d-block">- Penyelenggara : {{$latihan->penyelenggara}}</span>
                                                    <span class="d-block">- Tempat : {{$latihan->tempat}}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <br>

                                        <h4>Pengalaman</h4>
                                        <hr>
                                        <ul class="list-unstyled base-timeline activity-timeline mt-3">
                                            @foreach($pengalaman as $latihan)
                                                <li>
                                                    <div class="alert bg-primary white m-0">
                                                        Jenis Pelatihan : {{$latihan->jenis_bencana}}
                                                    </div>
                                                    <div class="act-time">- Tahun : {{$latihan->tahun}}</div>
                                                    <span class="d-block">- Tugas : {{$latihan->detail_pengalaman}}</span>
                                                    <span class="d-block">- Tempat : {{$latihan->lokasi}}</span>
                                                </li>
                                            @endforeach                          
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <a href="#" class="btn btn-primary font-medium-4 white ">
                            <span class="ft-edit"></span> Edit Profile 
                        </a> -->
                    </div>
                    <!--Project Timeline div ends-->
                    </div>
                </div>
                </div>
            <!-- Chart -->
        </div>
        @endif
    </div>
</div>

<!--STOP CONTENT-->
@stop

@section('script')
<script></script>
@stop
