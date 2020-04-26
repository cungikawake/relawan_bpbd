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

             
            <!--/ Statistics -->
        </div>
    </div>
</div>

<!--STOP CONTENT-->
@stop

@section('script')
<script></script>
@stop
