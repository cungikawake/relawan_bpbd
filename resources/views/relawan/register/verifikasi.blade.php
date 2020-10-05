@extends('relawan.layout.app')

@section('title', 'Formulir Pendataan Relawan')

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
                  <li class="breadcrumb-item"><a href="{{ route('relawan.dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Relawan</li>
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
                                <p>Lengkapi form persyaratan pendaftaran dari form 1 s/d 3</p>
                            </div>
                            <form action="@if($model->exists) {{ route('relawan.verifikasi.update', $model->id) }} @else {{ route('relawan.verifikasi.store') }} @endif" method="POST" enctype="multipart/form-data">
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
                                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">1. Identitas Diri</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">2. Kecakapan & Penanggulangan</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">3. Pengalaman Relawan</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                <div class="row">
                                                    <div class="col-md-6" style="display:none;">
                                                        <h5 class="mt-2">Id User <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="text" class="form-control" name="id_user" value="{{old('id_user', $user->id)}}" placeholder="otomatis terisi" readonly>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h5 class="mt-2">Organisasi Relawan <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <select  class="form-control" name="id_induk_relawan">
                                                                <option hidden>Pilih Organisasi</option>
                                                                @foreach($organisasi as $row)
                                                                    <option value="{{$row->id}}" {{ old('id_induk_relawan', $model->id_induk_relawan) == $row->id ? 'selected' : '' }}>{{$row->nama_organisasi}}</option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">Nama Lengkap <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="text" class="form-control" name="nama_lengkap" value="{{old('nama_lengkap', $user->name)}}" placeholder="nama sesuai KTP">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">email <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="text" class="form-control" name="email" value="{{old('email', $user->email)}}" placeholder="email" readonly>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">Tgl Lahir <span class="danger">*</span></h5>
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
                                                        <h5 class="mt-2">Pendidikan <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="text" class="form-control" name="pendidikan" value="{{old('pendidikan', $model->pendidikan)}}" placeholder="pendidikan">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">Pekerjaan <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="text" class="form-control" name="pekerjaan" value="{{old('pekerjaan', $model->pekerjaan)}}" placeholder="pekerjaan">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">NIK Ktp / SIM <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="text" class="form-control" name="ktp" value="{{old('ktp', $model->ktp)}}" placeholder="ktp / sim">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">Upload Ktp / Sim <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="file" class="form-control" name="ktp_file" value="{{old('ktp_file')}}" placeholder="upload ktp / sim" required>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">Upload Pas Foto 4X6 <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="file" class="form-control" name="foto_file" value="{{old('foto_file')}}" placeholder="upload pas foto 4x6" required>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="mt-2">No Hp <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <input type="number" class="form-control" name="tlp" value="{{old('tlp', $model->tlp)}}" placeholder="contoh 081999122323">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6" style="display:none;">
                                                        <h5 class="mt-2">Jenis Relawan <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <select  class="form-control" name="jenis_relawan">
                                                                <option value="1" {{ old('jenis_relawan', $model->jenis_relawan) == '1' ? 'selected' : '' }}>Terverifikasi </option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6" style="display:none;">
                                                        <h5 class="mt-2">Nomor Relawan</h5>
                                                        <fieldset class="form-group">
                                                            <input type="text" class="form-control" name="nomor_relawan" value="{{old('nomor_relawan', $model->nomor_relawan)}}" placeholder="nomor_relawan" readonly>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h5 class="mt-2">Kabupaten/Kota <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <select  class="form-control" name="kota">
                                                                <option hidden>Pilih Kabupaten/Kota</option>
                                                                @foreach($kota as $row)
                                                                    <option value="{{$row->id}}" {{ old('kota', $model->kota_id) == $row->id ? 'selected' : '' }}>{{$row->name}}</option>
                                                                @endforeach
                                                            </select>
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
                                                            <a class="btn btn-primary btn-min-width mr-1 mb-1 text-white btnNav" data-target="pills-profile-tab" id="to-tab-2">Selanjutnya</a>
                                                        </div>
                                                        <div class="float-left">
                                                            <a href="{{ route('relawan.dashboard') }}">
                                                                <button type="button" class="btn btn-danger btn-min-width mr-1 mb-1">Batal</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="my-2">KECAKAPAN UTAMA DALAM PENANGGULANGAN BENCANA <span class="danger">*</span></h5>
                                                        <fieldset class="form-group">
                                                            <select  class="form-control" name="skill_utama">
                                                                <option value="" hidden>Pilih Kecakapan Utama</option>
                                                                @if(count($skills) > 0)
                                                                    @foreach($skills as $row)
                                                                        <option value="{{$row->id}}" {{ old('skill_utama', $model->skill_utama) == $row->id ? 'selected' : '' }}>{{$row->nama_skill}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="my-2">KECAKAPAN PENDUKUNG DALAM PENANGGULANGAN BENCANA <span class="danger">*</span></h5>
                                                        @if(count($skills) > 0)
                                                            @foreach($skills as $row)
                                                                <fieldset class="form-group">
                                                                    <input class="form-check-input m-0" type="checkbox" value="{{$row->id}}" name="skill[]" {{ in_array($row->id, old('skill', $model_skills)) ? 'checked' : '' }}> <span class="ml-2">{{$row->nama_skill}}</span>
                                                                </fieldset>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="mt-2">PELATIHAN PENANGGULANGAN BENCANA YANG PERNAH DIIKUTI <span class="danger">*</span></h5>
                                                    </div>
                                                </div>
                                                <div id="form-pelatihan">
                                                    @for($i=0; $i<count($pelatihan) ; $i++)
                                                        <div class="row mt-3 input-pelatihan">
                                                            <div class="col-md-6">
                                                                <h5 class="mt-0">Jenis Pelatihan</h5>
                                                                <fieldset class="form-group mb-1">
                                                                <input type="hidden" class="form-control" name="id_pelatihan[]" value="{{ $pelatihan[$i]->id }}" placeholder="ID Pelatihan">
                                                                    <input type="text" class="form-control" name="jenis_pelatihan[]" value="{{ $pelatihan[$i]->jenis_pelatihan }}" placeholder="Jenis Pelatihan">
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h5 class="mt-0">Tempat Pelatihan</h5>
                                                                <fieldset class="form-group mb-1">
                                                                    <input type="text" class="form-control" name="tempat_pelatihan[]" value="{{ $pelatihan[$i]->tempat }}" placeholder="Tempat Pelatihan">
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <h5 class="mt-0">Detail Pelatihan</h5>
                                                                
                                                                <fieldset class="form-group mb-1">
                                                                <textarea class="form-control" name="detail_pelatihan[]"  placeholder="Detail Pelatihan"> {{ $pelatihan[$i]->detail_pelatihan }} </textarea>     
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h5 class="mt-0">Penyelenggara</h5>
                                                                <fieldset class="form-group">
                                                                    <input type="text" class="form-control" name="penyelenggara_pelatihan[]" value="{{ $pelatihan[$i]->penyelenggara }}" placeholder="Penyelenggara">
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h5 class="mt-0">Tahun</h5>
                                                                <fieldset class="form-group">
                                                                    <input type="text" class="form-control" name="tahun_pelatihan[]" value="{{ $pelatihan[$i]->tahun }}" placeholder="Tahun">
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <h5 class="mt-0">&nbsp;</h5>
                                                                <div class="float-right">
                                                                    @if($i)
                                                                        <a class="btn btn-danger btn-min-width mr-1 mb-1 text-white remove-pelatihan" data-target="pills-home-tab">Hapus</a>
                                                                    @else 
                                                                        <a class="btn btn-success btn-min-width mr-1 mb-1 text-white" data-target="pills-home-tab" id="add-pelatihan">Tambah</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                </div>

                                                <div class="row mt-2">
                                                    <div class="col-md-12">
                                                        <div class="float-right">
                                                            <a class="btn btn-primary btn-min-width mr-1 mb-1 text-white btnNav" data-target="pills-contact-tab" id="to-tab-3">Selanjutnya</a>
                                                        </div>
                                                        <div class="float-left">
                                                            <a href="{{ route('dashboard.bencana.index') }}">
                                                                <a class="btn btn-danger btn-min-width mr-1 mb-1 text-white btnNav" data-target="pills-home-tab">Kembali</a>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="mt-2">PENGALAMAN PENANGGULANGAN BENCANA YANG PERNAH DILAKUKAN <span class="danger">*</span></h5>
                                                    </div>
                                                </div>

                                                <div id="form-pengalaman">
                                                    @for($i=0; $i<count($pengalaman) ; $i++)
                                                        <div class="row mt-3 input-pengalaman">
                                                            <div class="col-md-12">
                                                                <h5 class="mt-0">Jenis Bencana</h5>
                                                                <fieldset class="form-group mb-1">
                                                                    <input type="hidden" class="form-control" name="id_pengalaman[]" value="{{ $pengalaman[$i]->id }}" placeholder="ID Bencana">
                                                                    <input type="text" class="form-control" name="jenis_bencana[]" value="{{ $pengalaman[$i]->jenis_bencana }}" placeholder="Jenis Bencana">
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <h5 class="mt-0">Detail Pengalaman</h5>
                                                                <fieldset class="form-group mb-1">
                                                                    <input type="text" class="form-control" name="detail_pengalaman[]" value="{{ $pengalaman[$i]->detail_pengalaman }}" placeholder="Detail Pengalaman">
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h5 class="mt-0">Lokasi</h5>
                                                                <fieldset class="form-group">
                                                                    <input type="text" class="form-control" name="lokasi[]" value="{{ $pengalaman[$i]->lokasi }}" placeholder="Lokasi">
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h5 class="mt-0">Tahun</h5>
                                                                <fieldset class="form-group">
                                                                    <input type="text" class="form-control" name="tahun[]" value="{{ $pengalaman[$i]->tahun }}" placeholder="Tahun">
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <h5 class="mt-0">&nbsp</h5>
                                                                <div class="float-right">
                                                                    @if($i)
                                                                        <a class="btn btn-danger btn-min-width mr-1 mb-1 text-white remove-pengalaman" data-target="pills-home-tab">Hapus</a>
                                                                    @else 
                                                                        <a class="btn btn-success btn-min-width mr-1 mb-1 text-white" data-target="pills-home-tab" id="add-pengalaman">Tambah</a>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                </div>
                                                    
                                                <div class="row mt-2">
                                                    <div class="col-md-12">
                                                        <div class="float-right">
                                                            <button type="submit" class="btn btn-primary btn-min-width mr-1 mb-1" id="simpan">Simpan</button>
                                                        </div>
                                                        <div class="float-left">
                                                            <a href="{{ route('dashboard.bencana.index') }}">
                                                                <a class="btn btn-danger btn-min-width mr-1 mb-1 text-white btnNav" data-target="pills-profile-tab">Kembali</a>
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
    
    $("#add-pelatihan").click(function(){
        var data = '<div class="row mt-3 input-pelatihan">'+
                        '<div class="col-md-6">'+
                            '<h5 class="mt-0">Jenis Pelatihan</h5>'+
                            '<fieldset class="form-group mb-1">'+
                                '<input type="hidden" class="form-control" name="id_pelatihan[]" value="" placeholder="ID Pelatihan">'+
                                '<input type="text" class="form-control" name="jenis_pelatihan[]" value="" placeholder="Jenis Pelatihan">'+
                            '</fieldset>'+
                        '</div>'+
                        '<div class="col-md-6">'+
                            '<h5 class="mt-0">Tempat Pelatihan</h5>'+
                            '<fieldset class="form-group mb-1">'+
                                '<input type="text" class="form-control" name="tempat_pelatihan[]" value="" placeholder="Tempat Pelatihan">'+
                            '</fieldset>'+
                        '</div>'+
                        '<div class="col-md-12">'+
                            '<h5 class="mt-0">Detail Pelatihan</h5>'+
                            '<fieldset class="form-group mb-1">'+
                                '<textarea class="form-control" name="detail_pelatihan[]" value="" placeholder="Detail Pelatihan"></textarea>'+
                            '</fieldset>'+
                        '</div>'+
                        '<div class="col-md-6">'+
                            '<h5 class="mt-0">Penyelenggara</h5>'+
                            '<fieldset class="form-group">'+
                                '<input type="text" class="form-control" name="penyelenggara_pelatihan[]" value="" placeholder="Penyelenggara">'+
                            '</fieldset>'+
                        '</div>'+
                        '<div class="col-md-4">'+
                            '<h5 class="mt-0">Tahun</h5>'+
                            '<fieldset class="form-group">'+
                                '<input type="text" class="form-control" name="tahun_pelatihan[]" value="" placeholder="Tahun">'+
                            '</fieldset>'+
                        '</div>'+
                        '<div class="col-md-2">'+
                            '<h5 class="mt-0">&nbsp;</h5>'+
                            '<div class="float-right">'+
                                '<a class="btn btn-danger btn-min-width mr-1 mb-1 text-white remove-pelatihan" data-target="pills-home-tab">Hapus</a>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
        $("#form-pelatihan").append(data);
    });

    $(document).on('click', '.remove-pelatihan', function(){
        if(window.confirm('Sure delete this data?')){
            $(this).parents('.input-pelatihan').remove();
        }
    });
    
    
    
    $("#add-pengalaman").click(function(){
        var data = '<div class="row mt-3 input-pengalaman">'+
                        '<div class="col-md-12">'+
                            '<h5 class="mt-0">Jenis Bencana</h5>'+
                            '<fieldset class="form-group mb-1">'+
                                '<input type="hidden" class="form-control" name="id_pengalaman[]" value="" placeholder="ID Bencana">'+
                                '<input type="text" class="form-control" name="jenis_bencana[]" value="" placeholder="Jenis Bencana">'+
                            '</fieldset>'+
                        '</div>'+
                        '<div class="col-md-12">'+
                            '<h5 class="mt-0">Detail Pengalaman</h5>'+
                            '<fieldset class="form-group mb-1">'+
                                '<input type="text" class="form-control" name="detail_pengalaman[]" value="" placeholder="Detail Pengalaman">'+
                            '</fieldset>'+
                        '</div>'+
                        '<div class="col-md-6">'+
                            '<h5 class="mt-0">Lokasi</h5>'+
                            '<fieldset class="form-group">'+
                                '<input type="text" class="form-control" name="lokasi[]" value="" placeholder="Lokasi">'+
                            '</fieldset>'+
                        '</div>'+
                        '<div class="col-md-4">'+
                            '<h5 class="mt-0">Tahun</h5>'+
                            '<fieldset class="form-group">'+
                                '<input type="text" class="form-control" name="tahun[]" value="" placeholder="Tahun">'+
                            '</fieldset>'+
                        '</div>'+
                        '<div class="col-md-2">'+
                            '<h5 class="mt-0">&nbsp</h5>'+
                            '<div class="float-right">'+
                                '<a class="btn btn-danger btn-min-width mr-1 mb-1 text-white remove-pengalaman" data-target="pills-home-tab">Hapus</a>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
        
        $("#form-pengalaman").append(data);
    });

    $(document).on('click', '.remove-pengalaman', function(){
        if(window.confirm('Sure delete this data?')){
            $(this).parents('.input-pengalaman').remove();
        }
    });

    $(document).on('click', '#simpan', function(){
        var data_lengkap = 1;
        $('[required=required]').each(function(i, obj) {
            if($(this).val().length == 0){
                data_lengkap = 0;  
                alert('Periksa kembali data yang masih kosong');
                return false;

            }
        });

        if(data_lengkap == 1){
            return true;
        }
    });

</script>
@endpush