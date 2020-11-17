@extends('dashboard.layout.app')

@section('title', 'Relawan')

@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<!-- Main Content -->
<div class="app-content content">
    <div class="content-wrapper">

        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Relawan</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  {{-- <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li> --}}
                  <li class="breadcrumb-item active">Relawan</li>
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
                            <h4 class="card-title">List Data Relawan</h4>
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
                                <!-- <a href="{{ route('dashboard.relawan.create') }}" class="btn btn-info btn-icon btn-sm mr-1 mb-1"><i class="la la-plus"></i> Buat Baru </a> -->
                                
                                @if(Session::has('message'))
                                    <div class="alert with-close alert-info mt-2">
                                        {{Session::get('message')}}
                                    </div>
                                @endif

                                @if(Session::has('message-warning'))
                                    <div class="alert with-close alert-warning mt-2">
                                        {{Session::get('message-warning')}}
                                    </div>
                                @endif  

                                <div class="alert alert-success">
                                    <form action="{{route('dashboard.relawan.search')}}" method="GET"  id="form_filter">
                                        <h4>Filter Data</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis</label>
                                                    <select name="jenis_relawan" class="form-control">
                                                        <option value="">Semua Jenis</option>
                                                        <option value="1" {{ ($filter['jenis_relawan'] == 1)? 'selected="selected"': ''}}>Umum</option>

                                                        <option value="2" {{ old('jenis_relawan', $filter['jenis_relawan']) == '2' ? 'selected' : '' }}>Terverifikasi</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Organisasi</label>
                                                    <select class="form-control" name="organisasi">
                                                        <option value=""> Semua Data</option>
                                                        @foreach($organisasi as $data)
                                                            <option value="{{ $data->id }}" {{ old('organisasi', $filter['organisasi']) == $data->id ? 'selected' : '' }}>{{$data->nama_organisasi}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <label>Keterampilan</label>
                                                    <select class="form-control" name="skill">
                                                        <option value=""> Semua Data</option>
                                                        @foreach($skill as $val)
                                                            <option value="{{ $val->id}}" {{ old('skill', $filter['skill']) == $val->id ? 'selected' : '' }}>{{$val->nama_skill}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button name="btn" class="btn btn-primary" style="margin-top:25px;" value="filter" id="filter">Filter</button>
                                                <button name="btn" class="btn btn-danger" style="margin-top:25px;" value="cetak" id="cetak">Cetak</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table display" id="myTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>No Hp</th>
                                                <th>Jenis</th> 
                                                <th>Verifikasi</th>
                                                <th>Nomor</th> 
                                                <th>Organisasi</th> 
                                                <th>Skill Utama</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($datas) > 0)
                                                @foreach($datas as $key => $data)
                                                    <tr>
                                                        <td>
                                                        @if($data->id_relawan)
                                                            <a href="{{route('dashboard.relawan.edit', $data->id_relawan)}}" class="btn btn-icon btn-warning btn-sm"><i class="ft-edit"></i></a>

                                                            <button type="button" class="btn btn-icon btn-danger btn-sm delete" data-id="{{$data->id_relawan}}" title="Hapus"><i class="la la-ban"></i></button>
                                                            <form action="{{route('dashboard.relawan.destroy', $data->id_relawan)}}" id="delete-{{$data->id_relawan}}" method="POST">
                                                                @csrf
                                                                
                                                            </form>

                                                            <a href="{{route('dashboard.relawan.print', $data->id_relawan)}}" target="_blank" class="btn btn-icon btn-primary btn-sm" title="Print" style="margin-top: 0.3rem !important;"><i class="la la-print"></i></a>

                                                            @if(!$data->userVerifyCheck() && $data->id_induk_relawan !='')
                                                                <button type="button" class="btn btn-icon btn-success btn-sm verify" data-id="{{$data->id_relawan}}" title="Verify" style="margin-top: 0.3rem !important;"><i class="la la-check"></i></button>
                                                                <form action="{{route('dashboard.relawan.verify', $data->id_relawan)}}" id="verify-{{$data->id_relawan}}" method="POST">
                                                                    @csrf
                                                                </form>
                                                            @else 
                                                                <br>
                                                            @endif
                                                        @else
                                                            Data Belum Lengkap
                                                        @endif
                                                        </td>
                                                         
                                                        <td>{{$data->name}}</td>
                                                        <td>{{$data->email}}</td>
                                                        <td>{{$data->tlp}}</td>
                                                        <td>{{($data->nomor_relawan !='' )? 'Terverifikasi': 'Umum'}}</td>
                                                        <td>{{($data->nomor_relawan != '' && $data->nomor_relawan !='')? 'Sudah': 'Belum'}}</td>
                                                        <td>{{$data->nomor_relawan}}</td>
                                                        <td>{{$data->nama_organisasi}}</td>
                                                        <td>{{$data->nama_skill}}</td>
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
            if(window.confirm('Yakin untuk menghapus relawan ?')){
                var id = $(this).attr('data-id');
                $('form#delete-'+id).submit();
            }
        });
        
        $('.verify').click(function(){
            if(window.confirm('Yakin untuk verifikasi relawan ?')){
                var id = $(this).attr('data-id');
                $('form#verify-'+id).submit();
            }
        });
        $('#myTable').DataTable();

        $('#cetak').click(function(){
            $('#form_filter').attr('target', '_blank');
        });
        $('#filter').click(function(){
            $('#form_filter').attr('target', '');
        });
    });
</script>
@endpush