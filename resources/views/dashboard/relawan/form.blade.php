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
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.relawan.index') }}">Dashboard</a></li>
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
                                <h4 class="card-title">Formulir Pendataan Relawan</h4>
                            </div>
                            <form action="@if($model->exists) {{ route('dashboard.relawan.update', $model->id) }} @else {{ route('dashboard.relawan.store') }} @endif" method="POST" enctype="multipart/form-data">
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

                                        <ul class="nav nav-pills mb-1" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Identitas Diri</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Kecakapan & Penanggulangan</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Pengalaman</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">id_user <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="text" class="form-control" name="id_user" value="{{old('id_user', $model->id_user)}}" placeholder="id_user">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">id_induk_relawan <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <select  class="form-control" name="id_induk_relawan">
                                                                <option hidden>Pikih Jenis Relawan</option>
                                                                @foreach($organisasi as $row)
                                                                    <option value="{{$row->id}}" {{ old('id_induk_relawan', $model->id_induk_relawan) == $row->id ? 'selected' : '' }}>{{$row->nama_organisasi}}</option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">nama_lengkap <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="text" class="form-control" name="nama_lengkap" value="{{old('nama_lengkap', $model->nama_lengkap)}}" placeholder="nama_lengkap">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">email <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="text" class="form-control" name="email" value="{{old('email', $model->email)}}" placeholder="email">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">tgl_lahir <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="date" class="form-control" name="tgl_lahir" value="{{old('tgl_lahir', $model->tgl_lahir)}}" placeholder="tgl_lahir">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">Jenis Kelamin <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <select  class="form-control" name="jenis_kelamin">
                                                                <option hidden>Pikih Jenis Kelamin</option>
                                                                <option value="laki-laki" {{ old('jenis_kelamin', $model->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                                <option value="perempuan" {{ old('jenis_kelamin', $model->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">pendidikan <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="text" class="form-control" name="pendidikan" value="{{old('pendidikan', $model->pendidikan)}}" placeholder="pendidikan">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">pekerjaan <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="text" class="form-control" name="pekerjaan" value="{{old('pekerjaan', $model->pekerjaan)}}" placeholder="pekerjaan">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">ktp <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="text" class="form-control" name="ktp" value="{{old('ktp', $model->ktp)}}" placeholder="ktp">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">ktp_file <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="file" class="form-control" name="ktp_file" value="{{old('ktp_file')}}" placeholder="ktp_file">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">foto_file <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="file" class="form-control" name="foto_file" value="{{old('foto_file')}}" placeholder="foto_file">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">tlp <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="text" class="form-control" name="tlp" value="{{old('tlp', $model->tlp)}}" placeholder="tlp">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">Jenis Relawan <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <select  class="form-control" name="jenis_relawan">
                                                                <option hidden>Pikih Jenis Relawan</option>
                                                                <option value="1" {{ old('jenis_relawan', $model->jenis_relawan) == '1' ? 'selected' : '' }}>Private</option>
                                                                <option value="0" {{ old('jenis_relawan', $model->jenis_relawan) == '0' ? 'selected' : '' }}>Public</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">nomor_relawan</h5>
                                                        <fieldset class="form-group">
                                                            <input type="text" class="form-control" name="nomor_relawan" value="{{old('nomor_relawan', $model->nomor_relawan)}}" placeholder="nomor_relawan">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h5 class="mt-2">alamat <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <textarea class="form-control" name="alamat" rows="3">{{old('alamat', $model->alamat)}}</textarea>
                                                        </fieldset>
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <div class="float-right">
                                                            <a class="btn btn-primary btn-min-width mr-1 mb-1 text-white btnNav" data-target="pills-profile-tab">Selanjutnya</a>
                                                        </div>
                                                        <div class="float-left">
                                                            <a href="{{ route('dashboard.relawan.index') }}">
                                                                <button type="button" class="btn btn-danger btn-min-width mr-1 mb-1">Batal</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="mt-2">Kecakapan <span class="danger">*</span></h5>
                                                        @if(count($skills) > 0)
                                                            @foreach($skills as $row)
                                                                <fieldset class="form-group">
                                                                    <input class="form-check-input m-0" type="checkbox" value="{{$row->id}}" name="skill[]" {{ in_array($row->id, old('skill', $model_skills)) ? 'checked' : '' }}> <span class="ml-2">{{$row->nama_skill}}</span>
                                                                </fieldset>
                                                            @endforeach
                                                        @endif
                                                    </div>

                                                    <div class="col-md-12">
                                                        <h5 class="mt-2">Penanggulangan <span class="danger">*</span></h5>
                                                        @for($i = 0; $i <= 1; $i++)
                                                            <fieldset class="form-group">
                                                                <input type="text" class="form-control" name="penanggulangan[]" value="" placeholder="penanggulangan">
                                                            </fieldset>
                                                        @endfor
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <div class="float-right">
                                                            <a class="btn btn-primary btn-min-width mr-1 mb-1 text-white btnNav" data-target="pills-contact-tab">Selanjutnya</a>
                                                        </div>
                                                        <div class="float-left">
                                                            <a href="{{ route('dashboard.bencana.index') }}">
                                                                <a class="btn btn-danger btn-min-width mr-1 mb-1 text-white btnNav" data-target="pills-home-tab">Sebelumnya</a>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="mt-2">Pengalaman <span class="danger">*</span></h5>
                                                        @for($i = 0; $i <= 1; $i++)
                                                            <fieldset class="form-group">
                                                                <input type="text" class="form-control" name="pengalaman[]" value="" placeholder="pengalaman">
                                                            </fieldset>
                                                        @endfor
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <div class="float-right">
                                                            <button type="submit" class="btn btn-primary btn-min-width mr-1 mb-1">Simpan</button>
                                                        </div>
                                                        <div class="float-left">
                                                            <a href="{{ route('dashboard.bencana.index') }}">
                                                                <a class="btn btn-danger btn-min-width mr-1 mb-1 text-white btnNav" data-target="pills-profile-tab">Sebelumnya</a>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

@push('script')
<script>
    $('.btnNav').click(function(){
        $('#'+$(this).attr('data-target')).click();
    });
</script>
@endpush