@extends('dashboard.layout.app')

@section('title', 'Form Laporan Harian Kegiatan')

@section('content')
<!-- Main Content -->
<div class="app-content content">
    <div class="content-wrapper">

        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Form Laporan Harian</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.list_kegiatan.index') }}">Kegiatan</a></li>
                  <li class="breadcrumb-item active">Laporan Harian</li>
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
                            
                            <form action="@if($model->exists) {{ route('dashboard.list_kegiatan.laporan_harian_update', $model->id_laporan) }} @else {{ route('dashboard.list_kegiatan.laporan_harian_store', $bencana->id) }} @endif" method="{{ ($model->exists) ? 'POST' : 'POST' }}" enctype="multipart/form-data">
                                @csrf
                                @method($model->exists ? 'POST' : 'POST')

                                <div class="card-block">
                                    <div class="card-body">
                                        <h3>Form Laporan Harian - @if(isset($bencana->judul_bencana)) {{ $bencana->judul_bencana }} @else {{ $model->judul_bencana }} @endif</h3> 
                                        @if (count($errors) > 0)
                                            <div class="alert with-close alert-danger mt-2">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </div>
                                        @endif
                                        
                                        <h5 class="mt-2">Tanggal Laporan <span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="hidden" class="form-control" name="id_laporan" value="{{old('id_laporan', $model->id_laporan)}}">

                                            <input type="date" class="form-control" name="tgl_laporan" value="{{old('tgl_laporan', $model->tgl_laporan)}}" placeholder="Tanggal Laporan" max="{{date('Y-m-d')}}">
                                        </fieldset>

                                        <h5 class="mt-2">Judul <span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="judul_laporan" value="{{old('judul_laporan', $model->judul_laporan)}}" placeholder="Judul Laporan">
                                        </fieldset>
                                        
                                        <h5 class="mt-2">Detail Laporan <span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <textarea class="form-control" row="5" name="detail_laporan" style="height:300px;">{{old('detail_laporan', $model->detail_laporan)}}</textarea>
                                        </fieldset>

                                        <h5 class="mt-2">Total Relawan Umum<span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="jml_relawan_umum" value="{{old('jml_relawan_umum', $model->jml_relawan_umum)}}" placeholder="0">
                                        </fieldset>

                                        <h5 class="mt-2">Total Relawan Terverifikasi<span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="jml_relawan_private" value="{{old('jml_relawan_private', $model->jml_relawan_private)}}" placeholder="0">
                                        </fieldset>

                                        <h5 class="mt-2">Foto Dokumentasi </h5>
                                        <small>Semua file jenis .doc,.pdf,.jpg, size max 5MB</small>
                                        <fieldset class="form-group">
                                            <input type="file" class="form-control" name="foto1" value="{{old('foto1', $model->foto1)}}" placeholder="Foto 1">
                                            <input type="file" class="form-control" name="foto2" value="{{old('foto2', $model->foto2)}}" placeholder="Foto 2">
                                            <input type="file" class="form-control" name="foto3" value="{{old('foto3', $model->foto3)}}" placeholder="Foto 3">
                                        </fieldset>
                                    </div>
                                    <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                                        <div class="float-left">
                                            <button type="submit" class="btn btn-primary btn-min-width mr-1 mb-1">Simpan</button>
                                        </div>
                                        <div class="float-right">
                                            @if(isset($bencana->judul_bencana)) 
                                                <a href="{{ route('dashboard.list_kegiatan.laporan_harian', $bencana->id) }}">
                                            @else 
                                                <a href="{{ route('dashboard.list_kegiatan.laporan_harian', $model->id_bencana) }}">
                                            @endif
                                            
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