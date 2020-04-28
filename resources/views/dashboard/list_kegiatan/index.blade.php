@extends('dashboard.layout.app')

@section('title', 'List Kegiatan')

@section('content')
<!-- Main Content -->
<div class="app-content content">
    <div class="content-wrapper">

        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">List Kegiatan</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  {{-- <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li> --}}
                  <li class="breadcrumb-item active">Kegiatan</li>
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
                            <h4 class="card-title">List Kegiatan</h4>
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
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Judul</th> 
                                                <th>Instansi</th>
                                                {{-- <th>Jenis</th> --}}
                                                <th>Mulai</th>
                                                <th>Sampai</th>
                                                {{-- <th width="20%">Foto</th> --}}
                                                <th>Relawan</th>
                                                <th width="20%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($datas) > 0)
                                                @foreach($datas as $key => $data)
                                                    <tr>
                                                        <th scope="row">
                                                            {{ ($datas->perPage() * ($datas->currentPage() - 1)) + ($key + 1) }}
                                                        </th>
                                                        <td>{{$data->judul_bencana}}</td> 
                                                        {{-- <td>{{$data->instansi}}</td> --}}
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
                                                            <a href="{{route('dashboard.list_kegiatan.detail', $data->id)}}" class="btn btn-icon btn-warning btn-sm"><i class="ft-edit"></i></a>
                                                            <a href="{{route('dashboard.list_kegiatan.map', $data->id)}}" class="btn btn-icon btn-primary btn-sm"><i class="la la-map"></i></a>
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
                                    {{ $datas->links() }}
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
<script type="text/javascript">
    $(document).ready(function(){
        $('.delete').click(function(){
            if(window.confirm('Sure delete this data?')){
                var id = $(this).attr('data-id');
                $('form#delete-'+id).submit();
            }
        });
    });
</script>
@endpush