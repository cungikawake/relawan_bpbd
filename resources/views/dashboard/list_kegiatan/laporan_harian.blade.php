@extends('dashboard.layout.app')

@section('title', 'Laporan Harian Kegiatan')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<!-- Main Content -->
<div class="app-content content">
    <div class="content-wrapper">

        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Laporan Harian Kegiatan</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb"> 
                  <li class="breadcrumb-item active">Kegiatan</li>
                  <li class="breadcrumb-item active">Laporan Harian</li>
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
                            <h4 class="card-title">Laporan Harian Kegiatan - {{$bencana->judul_bencana}}</h4>
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
                                <div class="alert alert-success">
                                    <form action="{{route('dashboard.list_kegiatan.laporan_harian_search', $bencana->id)}}" method="GET">
                                        <h4>Filter Data</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Laporan</label>
                                                    <input type="date" name="tgl_awal" class="form-control" require value="{{old('tgl_awal', $from)}}"> s/d
                                                    <input type="date" name="tgl_akhir" class="form-control" require value="{{old('tgl_awal', $to)}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6"> 
                                                <button name="btn" class="btn btn-primary" style="margin-top:25px;" value="filter">Filter</button>
                                                <button name="btn" class="btn btn-danger" style="margin-top:25px;" value="print">Cetak</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <a href="{{ route('dashboard.list_kegiatan.laporan_harian_create', $bencana->id) }}" class="btn btn-info btn-icon btn-sm mr-1 mb-1"><i class="la la-plus"></i> Buat Baru </a>
                                
                                @if(Session::has('message'))
                                    <div class="alert with-close alert-info mt-2">
                                        {{Session::get('message')}}
                                    </div>
                                @endif
                                
                                <div class="table-responsive">
                                    <table class="table display" id="myTable">
                                        <thead class="thead-dark">
                                            <tr> 
                                                <th>Kegiatan</th> 
                                                <th>Judul</th> 
                                                <th>Laporan</th> 
                                                <th>Tanggal Laporan</th> 
                                                <th>Relawan</th> 
                                                <th>File</th> 
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($datas) > 0)
                                                @foreach($datas as $key => $data)
                                                    <tr>
                                                         
                                                        <td>{{$data->judul_bencana}}</td> 
                                                        <td>{{$data->judul_laporan}}</td> 
                                                        <td>{{$data->detail_laporan}}</td>
                                                        <td>{{date('d M Y', strtotime($data->tgl_laporan))}}</td> 
                                                        <td>
                                                            <p>Umum : {{$data->jml_relawan_umum}}<p>
                                                            <p>Terverifikasi : {{$data->jml_relawan_private}}<p>
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('uploads/laporan/'.$data->foto1) }}" target="_blank">{{ $data->foto1 }}</a>
                                                            <a href="{{ url('uploads/laporan/'.$data->foto2) }}" target="_blank">{{ $data->foto2 }}</a>
                                                            <a href="{{ url('uploads/laporan/'.$data->foto3) }}" target="_blank">{{ $data->foto3 }}</a>
                                                        </td>
                                                        <td>
                                                            <a title="Edit" href="{{route('dashboard.list_kegiatan.laporan_harian_edit', $data->id_laporan)}}" class="btn btn-icon btn-warning btn-sm"><i class="la la-edit"></i></a>

                                                            <a target="_blank" title="Print" href="{{route('dashboard.list_kegiatan.laporan_harian_print_one', $data->id_laporan)}}" class="btn btn-icon btn-success btn-sm"><i class="la la-print"></i></a>  
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else 
                                                <tr>
                                                    <td colspan="5">tidak ada data.</td>
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