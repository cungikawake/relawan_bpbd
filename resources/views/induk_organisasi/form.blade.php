@extends('layout.app')

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
                  <li class="breadcrumb-item"><a href="{{ route('induk_organisasi.index') }}">Dashboard</a></li>
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
                                <h4 class="card-title">Induk Organisasi</h4>
                            </div>
                            <form action="@if($model->exists) {{ route('induk_organisasi.update', $model->id) }} @else {{ route('induk_organisasi.store') }} @endif" method="POST" enctype="multipart/form-data">
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
                                        
                                        <h5 class="mt-2">Nama <span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="nama" value="{{old('nama', $model->nama_organisasi)}}" placeholder="Nama">
                                        </fieldset>
                                        
                                        <h5 class="mt-2">Telepone <span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="tlp" value="{{old('tlp', $model->tlp_organisasi)}}" placeholder="Telepone">
                                        </fieldset>
                                        
                                        <h5 class="mt-2">Email <span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="email" value="{{old('email', $model->email_organisasi)}}" placeholder="Email">
                                        </fieldset>
                                        
                                        <h5 class="mt-2">Nama Pimpinan</h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="nama_pimpinan" value="{{old('nama_pimpinan', $model->nama_pimpinan_organisasi)}}" placeholder="Nama Pimpinan">
                                        </fieldset>
                                        
                                        <h5 class="mt-2">Alamat</h5>
                                        <fieldset class="form-group">
                                            <textarea class="form-control" name="alamat" rows="3" placeholder="Alamat">{{old('alamat', $model->alamat_organisasi)}}</textarea>
                                        </fieldset>
                                    </div>
                                    <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                                        <div class="float-right">
                                            <button type="submit" class="btn btn-primary btn-min-width mr-1 mb-1">Simpan</button>
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