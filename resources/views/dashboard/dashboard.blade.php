@extends('dashboard.layout.app')

@section('title', 'Dashboard')

@section('content')
<!-- Main Content -->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row"></div>

        <div class="content-body">
            <!-- Chart -->
            <div class="row match-height">
                <div class="col-12">
                    <div class="">
                        <h3 class="text-white">Selamat datang di Dashboard e-Relawan</h3>
                    </div>
                </div>
            </div>
            <!-- Chart -->

            <!-- eCommerce statistic -->
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="card pull-up ecom-card-1 bg-white">
                        <div class="card-content ecom-card2 height-180">
                            <div class="card-header">
                                <h5 class="text-muted danger position-absolute p-1">Total Bencana</h5>
                                <div>
                                    <i class="ft-map danger font-large-1 float-right p-1"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <h2 class="position-absolute p-1">{{$total_bencana}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="card pull-up ecom-card-1 bg-white">
                        <div class="card-content ecom-card2 height-180">
                            <div class="card-header">
                                <h5 class="text-muted info position-absolute p-1">Relawan Private</h5>
                                <div>
                                    <i class="ft-user info font-large-1 float-right p-1"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <h2 class="position-absolute p-1">{{$total_relawan_private}}</h2>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12">
                    <div class="card pull-up ecom-card-1 bg-white">
                        <div class="card-content ecom-card2 height-180">
                            <div class="card-header">
                                <h5 class="text-muted warning position-absolute p-1">Relawan Publik</h5>
                                <div>
                                    <i class="ft-users warning font-large-1 float-right p-1"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <h2 class="position-absolute p-1">{{$total_relawan_publik}}</h2>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <!--/ eCommerce statistic -->

            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="card pull-up ecom-card-1 bg-white">
                        <div class="card-content ecom-card2">
                            <div class="card-header">
                                <h5 class="text-muted primary position-absolute p-1">Kegiatan Terupdate</h5>
                                <div>
                                    <i class="ft-map primary font-large-1 float-right p-1"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="recent-buyers" class="media-list">
                                    @foreach($bencanas as $model)
                                        <a href="{{ url('dashboard/bencana/'.$model->id.'/edit') }}" class="media border-0">
                                            <div class="media-left pr-1">
                                                <span class="avatar avatar-md avatar-online"> 
                                                    <img src="{{$model->displayImage()}}" class="media-object rounded-circle" alt="Foto"> 
                                                </span>
                                            </div>
                                            <div class="media-body w-100">
                                                <span class="list-group-item-heading">
                                                    {{ $model->judul_bencana }} 
                                                </span>
                                                <ul class="list-unstyled users-list m-0 float-right"> 
                                                    <li> @if($model->jenis_bencana == 2)
                                                            Umum
                                                        @else
                                                            Private
                                                        @endif</li> 
                                                </ul>
                                                <p class="list-group-item-text mb-0">
                                                    <span class="blue-grey lighten-2 font-small-3"> 
                                                    <i class="la la-calendar-check-o"></i>  {{ date('d M Y', strtotime($model->tgl_mulai)) }} s/d {{ date('d M Y', strtotime($model->tgl_selesai)) }}
                                                    </span>
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach 
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="card  bg-white">
                        <div class="card-header">
                            <h5 class="text-muted primary position-absolute p-1">Relawan Terupdate</h5>
                            <div>
                                <i class="ft-users primary font-large-1 float-right p-1"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div id="recent-buyers" class="media-list">
                                @foreach($relawans as $model)
                                    <a href="#" class="media border-0">
                                        <div class="media-left pr-1">
                                            <span class="avatar avatar-md avatar-online"> 
                                                @if(empty($model->foto_file))
                                                    <img src="https://cdn.iseated.com/assets/img/nopicture.jpg" class="media-object rounded-circle" alt="Card image">
                                                @else
                                                    <img src="{{ asset('uploads/relawan/'.$model->id_relawan.'/'.$model->foto_file) }}" class="media-object rounded-circle" alt="Card image"> 
                                                @endif
                                                <i></i>
                                            </span>
                                        </div>
                                        <div class="media-body w-100">
                                            <span class="list-group-item-heading">
                                                {{ $model->name }} 
                                            </span>
                                            <ul class="list-unstyled users-list m-0 float-right">
                                                
                                                @if(empty($model->ktp_file))
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="KTP" class="avatar avatar-sm pull-up"> 

                                                    </li>
                                                @else
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="KTP File" class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="{{ asset('uploads/relawan/'.$model->id_relawan.'/'.$model->ktp_file) }}" alt="Avatar">
                                                    </li> 
                                                @endif
                                                
                                                 
                                            </ul>
                                            <p class="list-group-item-text mb-0">
                                                <span class="blue-grey lighten-2 font-small-3"> @if($model->nomor_relawan !='')#{{ $model->nomor_relawan }} (Terverifikasi) @else Umum @endif </span>
                                            </p>
                                        </div>
                                    </a>
                                @endforeach 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="card  bg-white">
                        <div class="card-header">
                            <h5 class="text-muted primary position-absolute p-1">Relawan Menunggu Verifikasi</h5>
                            <div>
                                <i class="ft-users primary font-large-1 float-right p-1"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div id="recent-buyers" class="media-list">
                                @foreach($relawans_pending as $model)
                                    <a href="{{ route('dashboard.relawan.edit', $model->id_relawan) }}" class="media border-0">
                                        <div class="media-left pr-1">
                                            <span class="avatar avatar-md avatar-online"> 
                                                @if(empty($model->foto_file))
                                                    <img src="https://cdn.iseated.com/assets/img/nopicture.jpg" class="media-object rounded-circle" alt="Card image">
                                                @else
                                                    <img src="{{ asset('uploads/relawan/'.$model->id_relawan.'/'.$model->foto_file) }}" class="media-object rounded-circle" alt="Card image"> 
                                                @endif
                                                <i></i>
                                            </span>
                                        </div>
                                        <div class="media-body w-100">
                                            <span class="list-group-item-heading">
                                                {{ $model->name }} 
                                            </span>
                                            <ul class="list-unstyled users-list m-0 float-right">
                                                
                                                @if(empty($model->ktp_file))
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="KTP" class="avatar avatar-sm pull-up"> 

                                                    </li>
                                                @else
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="KTP File" class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="{{ asset('uploads/relawan/'.$model->id_relawan.'/'.$model->ktp_file) }}" alt="Avatar">
                                                    </li> 
                                                @endif
                                                
                                                 
                                            </ul>
                                            <p class="list-group-item-text mb-0">
                                                <span class="blue-grey lighten-2 font-small-3"> @if($model->nomor_relawan !='')#{{ $model->nomor_relawan }} (Terverifikasi) @else Umum @endif </span>
                                            </p>
                                        </div>
                                    </a>
                                @endforeach 
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <!--/ Statistics -->
        </div>
    </div>
</div>

<!--STOP CONTENT-->
@stop

@section('script')
<script></script>
@stop
