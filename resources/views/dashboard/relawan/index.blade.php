@extends('dashboard.layout.app')

@section('title', 'Relawan')

@section('content')
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
                  <li class="breadcrumb-item active">Dashboard</li>
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
                            <h4 class="card-title">Relawan</h4>
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
                                <a href="{{ route('dashboard.relawan.create') }}" class="btn btn-info btn-icon btn-sm mr-1 mb-1"><i class="la la-plus"></i> Buat Baru </a>
                                
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
                                
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>No Hp</th>
                                                <th>Jenis</th> 
                                                <th>Verifikasi</th>
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
                                                        <td>{{$data->nama_lengkap}}</td>
                                                        <td>{{$data->email}}</td>
                                                        <td>{{$data->tlp}}</td>
                                                        <td>{{($data->jenis_relawan == 1)? 'Private': 'Publik'}}</td>
                                                        <td>{!! $data->userVerifyDisplay() !!}</td>
                                                        <td>

                                                            <a href="{{route('dashboard.relawan.edit', $data->id)}}" class="btn btn-icon btn-warning btn-sm"><i class="ft-edit"></i></a>
                                                            <button type="button" class="btn btn-icon btn-danger btn-sm delete" data-id="{{$data->id}}" title="Hapus"><i class="la la-ban"></i></button>
                                                            <form action="{{route('dashboard.relawan.destroy', $data->id)}}" id="delete-{{$data->id}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>

                                                            <a href="{{route('dashboard.relawan.print', $data->id)}}" target="_blank" class="btn btn-icon btn-primary btn-sm" title="Print" style="margin-top: 0.3rem !important;"><i class="la la-print"></i></a>
                                                            @if(!$data->userVerifyCheck())
                                                                <button type="button" class="btn btn-icon btn-success btn-sm verify" data-id="{{$data->id}}" title="Verify" style="margin-top: 0.3rem !important;"><i class="la la-check"></i></button>
                                                                <form action="{{route('dashboard.relawan.verify', $data->id)}}" id="verify-{{$data->id}}" method="POST">
                                                                    @csrf
                                                                </form>
                                                            @else 
                                                                <br>
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
    });
</script>
@endpush