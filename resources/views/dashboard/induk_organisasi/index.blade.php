@extends('dashboard.layout.app')

@section('title', 'Dashboard')

@section('content')
<!-- Main Content -->
<div class="app-content content">
    <div class="content-wrapper">

        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Induk Organisasi</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  {{-- <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li> --}}
                  <li class="breadcrumb-item active">Organisasi</li>
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
                            <h4 class="card-title">Induk Organisasi</h4>
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
                                <a href="{{ route('dashboard.induk_organisasi.create') }}" class="btn btn-info btn-icon btn-sm mr-1 mb-1"><i class="la la-plus"></i> Buat Baru </a>
                                
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
                                                <th>Nama Organiasi</th>
                                                <th>Admin Telepone</th>
                                                <th>Admin Email</th>
                                                <th>Admin Nama </th>

                                                <th>Ketua Telepone</th>
                                                <th>Ketua Email</th>
                                                <th>Ketua Nama </th>

                                                <th>Sekretaris Telepone</th>
                                                <th>Sekretaris Email</th>
                                                <th>Sekretaris Nama </th>
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
                                                        <td>{{$data->nama_organisasi}}</td>
                                                        <td>{{$data->tlp_organisasi}}</td>
                                                        <td>{{$data->email_organisasi}}</td>
                                                        <td>{{$data->nama_pimpinan_organisasi}}</td>

                                                        <td>{{$data->ketua_tlp}}</td>
                                                        <td>{{$data->ketua_email}}</td>
                                                        <td>{{$data->ketua_nama}}</td>

                                                        <td>{{$data->sekretaris_tlp}}</td>
                                                        <td>{{$data->sekretaris_email}}</td>
                                                        <td>{{$data->sekretaris_nama}}</td>
                                                        <td>
                                                            <a href="{{route('dashboard.induk_organisasi.edit', $data->id)}}" class="btn btn-icon btn-warning btn-sm"><i class="ft-edit"></i></a>
                                                            <button type="button" class="btn btn-icon btn-danger btn-sm delete" data-id="{{$data->id}}"><i class="la la-ban"></i></button>
                                                            <form action="{{route('dashboard.induk_organisasi.destroy', $data->id)}}" id="delete-{{$data->id}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
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