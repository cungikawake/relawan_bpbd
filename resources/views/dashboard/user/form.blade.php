@extends('dashboard.layout.app')

@section('title', 'User')

@section('content')
<!-- Main Content -->
<div class="app-content content">
    <div class="content-wrapper">

        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">User</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.user.index') }}">Dashboard</a></li>
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
                                <h4 class="card-title">User</h4>
                            </div>
                            <form action="@if($model->exists) {{ route('dashboard.user.update', $model->id) }} @else {{ route('dashboard.user.store') }} @endif" method="POST" enctype="multipart/form-data">
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
                                            <input type="text" class="form-control" name="name" value="{{old('name', $model->name)}}" placeholder="Nama">
                                        </fieldset>
                                        
                                        <h5 class="mt-2">Email <span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" name="email" value="{{old('email', $model->email)}}" placeholder="Email">
                                        </fieldset>
                                        
                                        <h5 class="mt-2">Password <span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="Password">
                                        </fieldset>
                                        
                                        <h5 class="mt-2">Konfirmasi Password <span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password">
                                        </fieldset>
                                        
                                        <h5 class="mt-2">Role <span class="danger">*</span></h5>
                                        <fieldset class="form-group">
                                            <select  class="form-control" name="role">
                                                <option hidden>Pilih Role</option>
                                                <option value="1" {{ old('role', $model->role) == '1' ? 'selected' : '' }}>Admin</option>
                                                <option value="2" {{ old('role', $model->role) == '2' ? 'selected' : '' }}>Private</option>
                                                <option value="3" {{ old('role', $model->role) == '3' ? 'selected' : '' }}>Public</option>
                                            </select>
                                        </fieldset>
                                        
                                        <!-- 
                                        <fieldset class="form-group" style="margin-top: 2rem !important;">
                                            <input type="checkbox" class="form-check-input m-0" name="status_verified" value="1" {{ old('status_verified', $model->status_verified) == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label ml-2">Verifikasi</label>
                                        </fieldset> -->
                                    </div>
                                    <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                                        <div class="float-left">
                                            <button type="submit" class="btn btn-primary btn-min-width mr-1 mb-1">Simpan</button>
                                        </div>
                                        <div class="float-right">
                                            <a href="{{ route('dashboard.user.index') }}">
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