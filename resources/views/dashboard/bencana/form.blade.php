@extends('dashboard.layout.app')

@section('title', 'Bencana')

@section('content')
<!-- Main Content -->
<div class="app-content content">
    <div class="content-wrapper">

        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Bencana</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.bencana.index') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Form</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="content-body">

            <section class="basic-inputs">
                <div class="row match-height">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Bencana</h4>
                            </div>
                            <form action="@if($model->exists) {{ route('dashboard.bencana.update', $model->id) }} @else {{ route('dashboard.bencana.store') }} @endif" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method($model->exists ? 'PUT' : 'POST')

                                <div class="card-block">
                                    <div class="card-body">
    
                                        @if (count($errors) > 0)
                                            <div class="alert with-close alert-danger mt-2">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Judul <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="judul_bencana" value="{{old('judul_bencana', $model->judul_bencana)}}" placeholder="Judul">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Nama Pelaksana <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="nama_pelaksana" value="{{old('nama_pelaksana', $model->nama_pelaksana)}}" placeholder="Nama Pelaksana">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Instansi <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="instansi" value="{{old('instansi', $model->instansi)}}" placeholder="Instansi">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Jenis Bencana <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="jenis_bencana" value="{{old('jenis_bencana', $model->jenis_bencana)}}" placeholder="Jenis Bencana">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Quota Relawan <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="quota_relawan" value="{{old('quota_relawan', $model->quota_relawan)}}" placeholder="Quota Relawan">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Status Jenis <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="status_jenis" value="{{old('status_jenis', $model->status_jenis)}}" placeholder="Status Jenis">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Tanggal Mulai <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="date" class="form-control" name="tgl_mulai" value="{{old('tgl_mulai', $model->tgl_mulai)}}" placeholder="Tanggal Mulai">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Tanggal Selesai <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="date" class="form-control" name="tgl_selesai" value="{{old('tgl_selesai', $model->tgl_selesai)}}" placeholder="Tanggal Selesai">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Skill Minimal <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    {{-- <input type="text" class="form-control" name="skill_minimal" value="{{old('skill_minimal', $model->skill_minimal)}}" placeholder="Skill Minimal"> --}}
                                                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#exampleModal">
                                                        Daftar Skill Minimal
                                                    </button>
                                                </fieldset>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Daftar Skill Minimal</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if(count($skills) > 0)
                                                                @foreach($skills as $row)
                                                                    {{-- <p>{{$row->nama_skill}}</p> --}}
                                                                    <fieldset class="form-group">
                                                                        <input class="form-check-input m-0" type="checkbox" value="{{$row->id}}" name="skill_minimal[]" {{ in_array($row->id, old('skill_minimal', $model_skills)) ? 'checked' : '' }}> <span class="ml-2">{{$row->nama_skill}}</span>
                                                                    </fieldset>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Submit</button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Mental Minimal <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="mental_minimal" value="{{old('mental_minimal', $model->mental_minimal)}}" placeholder="Mental Minimal">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <h5 class="mt-2">Detail Tugas <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <textarea class="form-control" name="detail_tugas" rows="3">{{old('detail_tugas', $model->detail_tugas)}}</textarea>
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <h5 class="mt-2">Durasi Tugas <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="durasi_tugas" value="{{old('durasi_tugas', $model->durasi_tugas)}}" placeholder="Durasi Tugas">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <h5 class="mt-2">Lokasi Tugas <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="lokasi_tugas" value="{{old('lokasi_tugas', $model->lokasi_tugas)}}" placeholder="Lokasi Tugas">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Koordinat Tugas <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="koordinat_tugas" value="{{old('koordinat_tugas', $model->koordinat_tugas)}}" placeholder="Koordinat Tugas">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Supervisi Tugas <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="supervisi_tugas" value="{{old('supervisi_tugas', $model->supervisi_tugas)}}" placeholder="Supervisi Tugas">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Jaminan Perlindungan <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="jaminan_perlindungan" value="{{old('jaminan_perlindungan', $model->jaminan_perlindungan)}}" placeholder="Jaminan Perlindungan">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Kordinator Relawan <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="kordinator_relawan" value="{{old('kordinator_relawan', $model->kordinator_relawan)}}" placeholder="Kordinator Relawan">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <h5 class="mt-2">Foto Bencana <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="file" class="form-control" name="foto_bencana" value="{{old('foto_bencana')}}" placeholder="Foto Bencana">
                                                </fieldset>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                                        <div class="float-left">
                                            <button type="submit" class="btn btn-primary btn-min-width mr-1 mb-1">Simpan</button>
                                        </div>
                                        <div class="float-right">
                                            <a href="{{ route('dashboard.bencana.index') }}">
                                                <button type="button" class="btn btn-danger btn-min-width mr-1 mb-1">Batal</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

<!--STOP CONTENT-->
@stop

@section('script')
<script></script>
@stop