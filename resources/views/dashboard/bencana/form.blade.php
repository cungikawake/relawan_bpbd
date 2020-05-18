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
                                                <h5 class="mt-2">Keperluan Bencana <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                     
                                                    <select class="form-control" name="jenis_bencana">
                                                        <option hidden>Pilih Keperluan Bencana</option>
                                                        <option value="1" {{ old('jenis_bencana', $model->jenis_bencana) == '1' ? 'selected' : '' }}>Private (Relawan Terverifikasi)</option>
                                                        <option value="2" {{ old('jenis_bencana', $model->jenis_bencana) == '2' ? 'selected' : '' }}>Publik (Semua Jenis Relawan)</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Quota Relawan <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="quota_relawan" value="{{old('quota_relawan', $model->quota_relawan)}}" placeholder="Quota Relawan">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Bencana di Publikasikan <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    {{-- <input type="text" class="form-control" name="status_jenis" value="{{old('status_jenis', $model->status_jenis)}}" placeholder="Status Jenis"> --}}
                                                    <select class="form-control" name="status_jenis">
                                                        <option hidden>Pilih Status Jenis</option>
                                                        <option value="1" {{ old('status_jenis', $model->status_jenis) == '1' ? 'selected' : '' }}>Ya</option>
                                                        <option value="0" {{ old('status_jenis', $model->status_jenis) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                                    </select>
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
                                                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#skillModal">
                                                        Daftar Skill Minimal
                                                    </button>
                                                </fieldset>

                                                <!-- Modal -->
                                                <div class="modal fade" id="skillModal" tabindex="-1" role="dialog" aria-labelledby="skillModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="skillModalLabel">Daftar Skill Minimal</h5>
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
                                                    {{-- <input type="text" class="form-control" name="mental_minimal" value="{{old('mental_minimal', $model->mental_minimal)}}" placeholder="Mental Minimal"> --}}
                                                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#persyaratanModal">
                                                        Daftar Mental Minimal
                                                    </button>
                                                </fieldset>
                                                

                                                <!-- Modal -->
                                                <div class="modal fade" id="persyaratanModal" tabindex="-1" role="dialog" aria-labelledby="persyaratanModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="persyaratanModalLabel">Daftar Mental Minimal</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if(count($persyaratan) > 0)
                                                                @foreach($persyaratan as $row)
                                                                    {{-- <p>{{$row->nama_skill}}</p> --}}
                                                                    <fieldset class="form-group">
                                                                        <input class="form-check-input m-0" type="checkbox" value="{{$row->id}}" name="mental_minimal[]" {{ in_array($row->id, old('mental_minimal', $model_persyaratan)) ? 'checked' : '' }}> <span class="ml-2">{{$row->nama}}</span>
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
                                                    <input type="text" class="form-control" name="lokasi_tugas" value="{{old('lokasi_tugas', $model->lokasi_tugas)}}" placeholder="Lokasi Tugas" id="lokasi_tugas" onFocus="geolocate()">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Koordinat Tugas <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="koordinat_tugas" value="{{old('koordinat_tugas', $model->koordinat_tugas)}}" placeholder="Koordinat Tugas" id="koordinat_tugas">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Supervisi Tugas <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="supervisi_tugas" value="{{old('supervisi_tugas', $model->supervisi_tugas)}}" placeholder="Supervisi Tugas">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <h5 class="mt-2">Jaminan Perlindungan <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    {{-- <input type="text" class="form-control" name="jaminan_perlindungan" value="{{old('jaminan_perlindungan', $model->jaminan_perlindungan)}}" placeholder="Jaminan Perlindungan"> --}}
                                                    <textarea class="form-control" name="jaminan_perlindungan" rows="3">{{old('jaminan_perlindungan', $model->jaminan_perlindungan)}}</textarea>
                                                </fieldset>
                                            </div>
                                            
                                            {{-- <div class="col-md-6">
                                                <h5 class="mt-2">Kordinator Relawan <span class="danger">*</span></h5>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="kordinator_relawan" value="{{old('kordinator_relawan', $model->kordinator_relawan)}}" placeholder="Kordinator Relawan">
                                                </fieldset>
                                            </div> --}}
                                            
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

@push('script')
<script>
    // This sample uses the Autocomplete widget to help the user select a
    // place, then it retrieves the address components associated with that
    // place, and then it populates the form fields with those details.
    // This sample requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script
    // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    var placeSearch, autocomplete;

    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('lokasi_tugas'), {types: ['geocode']});

        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(['address_component']);

        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        // autocomplete.addListener('place_changed', fillInAddress);

        // console.log(autocomplete.getPlace());

        
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('lokasi_tugas'), {types: ['geocode']});
        autocomplete.addListener('place_changed', getAddressDetails);
    }

    function getAddressDetails(){
        var place = autocomplete.getPlace();   
        var lat = place.geometry.location.lat();
        var long = place.geometry.location.lng();
        
        document.getElementById('koordinat_tugas').value = lat+','+long;
    }

    // function fillInAddress() {
    //     // Get the place details from the autocomplete object.
    //     var place = autocomplete.getPlace();
    //     console.log(place);

    //     // for (var component in componentForm) {
    //     //     document.getElementById(component).value = '';
    //     //     document.getElementById(component).disabled = false;
    //     // }

    //     // // Get each component of the address from the place details,
    //     // // and then fill-in the corresponding field on the form.
    //     // for (var i = 0; i < place.address_components.length; i++) {
    //     //     var addressType = place.address_components[i].types[0];
    //     //     if (componentForm[addressType]) {
    //     //         var val = place.address_components[i][componentForm[addressType]];
    //     //         document.getElementById(addressType).value = val;
    //     //     }
    //     // }
    // }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({center: geolocation, radius: position.coords.accuracy});
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places&callback=initAutocomplete" async defer></script>
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJTIHh1GRN37zuOlt-4XWrsm-XY2LwzNc&libraries=places&callback=initAutocomplete" async defer></script> --}}
@endpush