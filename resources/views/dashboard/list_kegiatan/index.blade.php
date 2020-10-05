@extends('dashboard.layout.app')

@section('title', 'List Kegiatan')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<!-- Main Content -->
<div class="app-content content">
    <div class="content-wrapper">

        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Pantau Kegiatan</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  {{-- <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li> --}}
                  <li class="breadcrumb-item active">Pantau Kegiatan</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="content-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pantau Kegiatan</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    {{-- <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> --}}
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    {{-- <li><a data-action="close"><i class="ft-x"></i></a></li> --}}
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                
                                @if(Session::has('message'))
                                    <div class="alert with-close alert-info mt-2">
                                        {{Session::get('message')}}
                                    </div>
                                @endif
                                
                                <div class="table-responsive">
                                    <table class="table display" id="myTable">
                                        <thead class="thead-dark">
                                            <tr> 
                                                <th>Judul</th> 
                                                <th>Instansi</th>
                                                <th>Jenis</th>
                                                <th>Mulai</th>
                                                <th>Sampai</th> 
                                                <th>Total Relawan</th>
                                                <th>Status</th>
                                                <th width="20%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($datas) > 0)
                                                @foreach($datas as $key => $data)
                                                    <tr>
                                                         
                                                        <td>{{$data->judul_bencana}}</td> 
                                                        <td>{{$data->instansi}}</td>
                                                        <td>
                                                            @if($data->jenis_bencana == 2)
                                                                Publik
                                                            @else
                                                                Private
                                                            @endif
                                                        </td>
                                                        <td>{{date('d M Y', strtotime($data->tgl_mulai))}}</td>
                                                        <td>{{date('d M Y', strtotime($data->tgl_selesai))}}</td>
                                                        {{-- <td>
                                                            <img src="{{$data->displayImage()}}" width="100" alt="">
                                                        </td> --}}
                                                        <td>{{count($data->allRelawan())}}</td>
                                                        <td>
                                                            @if($data->tgl_mulai > date('Y-m-d'))
                                                                Akan Datang
                                                            @elseif($data->tgl_selesai > date('Y-m-d'))
                                                                Berlangsung
                                                            @else
                                                                Selesai
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a title="Detail" href="{{route('dashboard.list_kegiatan.detail', $data->id)}}" class="btn btn-icon btn-warning btn-sm"><i class="la la-users"></i></a>

                                                            <a title="Map"  href="{{route('dashboard.list_kegiatan.map', $data->id)}}" class="btn btn-icon btn-primary btn-sm"><i class="la la-map"></i></a>
                                                            
                                                            @if($data->tgl_selesai > date('Y-m-d'))
                                                                <a title="Laporan Harian" href="{{route('dashboard.list_kegiatan.laporan_harian', $data->id)}}" class="btn btn-icon btn-info btn-sm"><i class="la la-file"></i> </a>
                                                            @endif
                                                            
                                
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else 
                                                <tr>
                                                    <td colspan="6">tidak ada data.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!--STOP CONTENT-->
@stop

@push('script')

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.delete').click(function(){
            if(window.confirm('Sure delete this data?')){
                var id = $(this).attr('data-id');
                $('form#delete-'+id).submit();
            }
        });
        $('#myTable').DataTable();
    });
</script>
@endpush