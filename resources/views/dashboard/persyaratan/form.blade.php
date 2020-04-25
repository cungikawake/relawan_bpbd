@extends('dashboard.layout.app')

@section('title', 'Persyaratan')

@section('content')
<!-- Main Content -->
<div class="app-content content">
    <div class="content-wrapper">

        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Persyaratan</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.persyaratan.index') }}">Dashboard</a></li>
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
                             
                            <form action="@if($model->exists) {{ route('dashboard.persyaratan.update', $model->id) }} @else {{ route('dashboard.persyaratan.store') }} @endif" method="POST" enctype="multipart/form-data">
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
                                            <input type="text" class="form-control" name="nama" value="{{old('nama', $model->nama)}}" placeholder="Nama">
                                        </fieldset>
                                        
                                        <h5 class="mt-2">Prioritas <span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="prioritas" value="{{old('prioritas', $model->prioritas)}}" placeholder="Prioritas">
                                        </fieldset>
                                    </div>
                                    <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                                        <div class="float-left">
                                            <button type="submit" class="btn btn-primary btn-min-width mr-1 mb-1">Simpan</button>
                                        </div>
                                        <div class="float-right">
                                            <a href="{{ route('dashboard.persyaratan.index') }}">
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