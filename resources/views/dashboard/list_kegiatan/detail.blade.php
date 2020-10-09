@extends('dashboard.layout.app')

@section('title', 'List Relawan')

@section('content')
<!-- Main Content -->
<div class="app-content content">
    <div class="content-wrapper">

        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">List Kegiatan Relawan</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.list_kegiatan.index') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Detail</li>
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
                            {{--   <h4 class="card-title">List Relawan</h4> --}}
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
                                
                                <h4 class="card-title">Relawan Pending</h4>
                                <p class="alert alert-primary">Pilih beberapa relawan sekaligus dan klik Terima atau Tolak </p>
                                <div class="table-responsive">
                                    <form action="{{route('dashboard.list_kegiatan.update', ['id' => $model->id])}}" method="POST" id="form-relawan">
                                        @csrf
                                        <input type="hidden" class="form-control" name="action" id="action">

                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th class="align-middle">#</th>
                                                    <th class="align-middle">Nama</th> 
                                                    <th class="align-middle">Tanggal Setujui</th>
                                                    <th width="20%" class="align-middle">Status</th>
                                                    <th width="10%" class="align-middle">Detail</th>
                                                    <th width="10%" class="align-middle">
                                                        Terima 
                                                        <input class="form-check-input m-0 checkbox-relawan" type="checkbox" id="join">
                                                    </th>
                                                    <th width="10%" class="align-middle">
                                                        Tolak 
                                                        <input class="form-check-input m-0 checkbox-relawan" type="checkbox" id="reject">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($model->pendingRelawan()) > 0)
                                                    @php $i=1; @endphp
                                                    @foreach($model->pendingRelawan() as $key => $row)
                                                        <tr>
                                                            <th scope="row">
                                                                {{ $i++ }}
                                                            </th>
                                                            <td>{{$row->relawanDisplay()->nama_lengkap}}</td>
                                                            <td>{{date('d M Y', strtotime($row->tgl_join))}}</td>
                                                            <td>
                                                                @if($row->relawan)
                                                                    @if(count($row->relawan->bencanaDetail($row->bencana->tgl_mulai, $row->bencana->tgl_selesai)))
                                                                        <span class="text-danger">Sudah bergabung dalam kegiatan {{$row->relawan->bencanaDetail($row->bencana->tgl_mulai, $row->bencana->tgl_selesai)->first()->judul_bencana}}.</span>
                                                                    @else 
                                                                        <span class="text-success">Tersedia.</span>
                                                                    @endif
                                                                @else 
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($row->relawan)
                                                                    <button type="button" class="btn btn-icon btn-primary btn-sm button-detail" onclick="detail({{$row->relawan}})"><i class="la la-user"></i></button>
                                                                @else 
                                                                    <button type="button" class="btn btn-icon btn-primary btn-sm" disabled><i class="la la-user"></i></button>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <input class="form-check-input m-0 checkbox-relawan checkbox-join" type="checkbox" value="{{$row->id}}" name="join[]">
                                                            </td>
                                                            <td>
                                                                <input class="form-check-input m-0 checkbox-relawan checkbox-reject" type="checkbox" value="{{$row->id}}" name="reject[]">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="5"></td>
                                                        <td>
                                                            <button type="button" class="btn btn-icon btn-warning btn-sm" id="submit-join"><i class="la la-user-plus"></i> Terima</button>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-icon btn-danger btn-sm" id="submit-reject"><i class="la la-user-times"></i> Tolak</button>
                                                        </td>
                                                    </tr>
                                                @else 
                                                    <tr>
                                                        <td colspan="7">tidak ada data.</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </form>
                                    
                                </div>
                                
                                
                                <h4 class="card-title mt-3">Relawan Di Setujui</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th> 
                                                <th>Tanggal Setujui</th>
                                                <th width="10%" class="align-middle">Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($model->joinRelawan()) > 0)
                                                @php $i=1; @endphp
                                                @foreach($model->joinRelawan() as $key => $row)
                                                     
                                                    <tr>
                                                        <th scope="row">
                                                            {{ $i++ }}
                                                        </th>
                                                        <td>
                                                        {{$row->relawanDisplay()->nama_lengkap}}
                                                        </td>
                                                        <td>{{date('d M Y', strtotime($row->tgl_join))}}</td>
                                                        <td>
                                                            @if($row->relawan)
                                                                <button type="button" class="btn btn-icon btn-primary btn-sm button-detail" onclick="detail({{$row->relawan}})"><i class="la la-user"></i> Detail</button>

                                                                 
                                                                <button type="button" class="btn btn-icon btn-danger btn-sm button-detail delete" data-id="{{$row->id}}"><i class="la la-close"></i> Hapus</button>

                                                                <form action="{{url('dashboard/list-kegiatan/'.$row->id.'/'.$row->id_bencana.'/reject')}}" id="delete-{{$row->id}}" method="POST">
                                                                    @csrf
                                                                    @method('POST')
                                                                </form>

                                                            @else 
                                                                <button type="button" class="btn btn-icon btn-primary btn-sm" disabled><i class="la la-user"></i></button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else 
                                                <tr>
                                                    <td colspan="4">tidak ada data.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    
                                </div>
                                
                                
                                <h4 class="card-title mt-3">Relawan Ditolak</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th> 
                                                <th>Tanggal Setujui</th>
                                                <th width="30%" class="align-middle">Tanggal Ditolak</th>
                                                <th width="10%" class="align-middle">Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($model->ditolakRelawan()) > 0)
                                                @php $i=1; @endphp
                                                @foreach($model->ditolakRelawan() as $key => $row)
                                                    <tr>
                                                        <th scope="row">
                                                            {{ $i++ }}
                                                        </th>
                                                        <td>{{$row->relawanDisplay()->nama_lengkap}}</td>
                                                        <td>{{date('d M Y', strtotime($row->tgl_join))}}</td>
                                                        <td>
                                                        {{date('d M Y', strtotime($row->tgl_keluar))}}
                                                        </td>
                                                        <td>
                                                            @if($row->relawan)
                                                                <button type="button" class="btn btn-icon btn-primary btn-sm button-detail" onclick="detail({{$row->relawan}})"><i class="la la-user"></i> Detail</button>

                                                            @else 
                                                                <button type="button" class="btn btn-icon btn-primary btn-sm" disabled><i class="la la-user"></i></button>
                                                            @endif
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

<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Info Relawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-01">Nama : <span id="modal-nama"></span></p>
                <p class="mb-01">Email : <span id="modal-email"></span></p>
                <p class="mb-01">Jenis Kelamin : <span id="modal-jenis_kelamin"></span></p>
                <p class="mb-01">Pendidikan : <span id="modal-pendidikan"></span></p>
                <p class="mb-01">Pekerjaan : <span id="modal-pekerjaan"></span></p>
                <p class="mb-01">Ktp : <span id="modal-ktp"></span></p>
                <p class="mb-01">Alamat : <span id="modal-alamat"></span></p>
                <p class="mb-01">Telepon : <span id="modal-tlp"></span></p>
                <br>
                 
            </div>
        </div>
    </div>
</div>

<!--STOP CONTENT-->
@stop

@push('style')
<style>
    .checkbox-relawan {
        margin-left: 1rem !important;
        position: inherit;
    }
    .mb-01 {
        margin-bottom: 0.1rem !important;
    }
</style>
@endpush

@push('script')
<script>
    function detail(data){
        console.log(data);
        $('#modal-nama').html(data.nama_lengkap);
        $('#modal-email').html(data.email);
        $('#modal-jenis_kelamin').html(data.jenis_kelamin);
        $('#modal-pendidikan').html(data.pendidikan);
        $('#modal-pekerjaan').html(data.pekerjaan);
        $('#modal-ktp').html(data.ktp);
        $('#modal-alamat').html(data.alamat);
        $('#modal-tlp').html(data.tlp); 
        $('#modalDetail').modal('show');
    }

    $('#submit-join').click(function(){
        if(window.confirm('Sure update this data?')){
            $('#action').val('join');
            $('#form-relawan').submit();
        }
    });

    $('#submit-reject').click(function(){
        if(window.confirm('Sure update this data?')){
            $('#action').val('reject');
            $('#form-relawan').submit();
        }
    });

    $('#join').click(function(){
        if($('#join:checkbox:checked').length > 0){
            $('input.checkbox-join').prop('checked', true);

        }else{
            $('input.checkbox-join').prop('checked', false);

        }
    });
    
    $('#reject').click(function(){
        if($('#reject:checkbox:checked').length > 0){
            $('input.checkbox-reject').prop('checked', true);

        }else{
            $('input.checkbox-reject').prop('checked', false);

        }
    });

    $('.delete').click(function(){
        if(window.confirm('Yakin untuk menghapus relawan ?')){
            var id = $(this).attr('data-id');
            $('form#delete-'+id).submit();
        }
    }); 
        
</script>
@endpush