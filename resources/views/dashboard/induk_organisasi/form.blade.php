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
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.induk_organisasi.index') }}">Dashboard</a></li>
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
                            <form action="@if($model->exists) {{ route('dashboard.induk_organisasi.update', $model->id) }} @else {{ route('dashboard.induk_organisasi.store') }} @endif" method="POST" enctype="multipart/form-data">
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
                                        <h5 class="mt-2">Nama Organisasi <span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="nama" value="{{old('nama', $model->nama_organisasi)}}" placeholder="Nama">
                                        </fieldset> 
                                        
                                        <h5 class="mt-2">Alamat</h5>
                                        <fieldset class="form-group">
                                            <textarea class="form-control" name="alamat" rows="3" placeholder="Alamat">{{old('alamat', $model->alamat_organisasi)}}</textarea>
                                        </fieldset>
                                        
                                        
                                        <h5 class="mt-2">Nama Admin</h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="nama_pimpinan" value="{{old('nama_pimpinan', $model->nama_pimpinan_organisasi)}}" placeholder="Nama ">
                                        </fieldset>

                                        <h5 class="mt-2">Telepone Admin<span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="tlp" value="{{old('tlp', $model->tlp_organisasi)}}" placeholder="Telepone">
                                        </fieldset>

                                        <h5 class="mt-2">Email Admin<span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="email" value="{{old('email', $model->email_organisasi)}}" placeholder="Email">
                                        </fieldset>
                                        <hr> 
                                        
                                        <h5 class="mt-2">Nama Ketua</h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="ketua_nama" value="{{old('ketua_nama', $model->ketua_nama)}}" placeholder="Nama ">
                                        </fieldset>

                                        <h5 class="mt-2">Telepone Ketua<span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="ketua_tlp" value="{{old('ketua_tlp', $model->ketua_tlp)}}" placeholder="Telepone">
                                        </fieldset>

                                        <h5 class="mt-2">Email Ketua<span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="ketua_email" value="{{old('ketua_email', $model->ketua_email)}}" placeholder="Email">
                                        </fieldset>
                                        <hr>
                                        
                                        <h5 class="mt-2">Nama Sekretaris</h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="sekretaris_nama" value="{{old('sekretaris_nama', $model->sekretaris_nama)}}" placeholder="Nama ">
                                        </fieldset>

                                        <h5 class="mt-2">Telepone Sekretaris<span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="sekretaris_tlp" value="{{old('sekretaris_tlp', $model->sekretaris_tlp)}}" placeholder="Telepone">
                                        </fieldset>

                                        <h5 class="mt-2">Email Sekretaris<span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="sekretaris_email" value="{{old('sekretaris_email', $model->sekretaris_email)}}" placeholder="Email">
                                        </fieldset>
                                    </div>
                                    
                                    <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                                        <div class="float-left">
                                            <button type="submit" class="btn btn-primary btn-min-width mr-1 mb-1">Simpan</button>
                                        </div>
                                        <div class="float-right">
                                            <a href="{{ route('dashboard.induk_organisasi.index') }}">
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