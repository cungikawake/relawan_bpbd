<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #000000;
        }
        .borderless td, .borderless th {
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <h3 class="text-center">
                    FORMULIR PENDATAAN <br> 
                    RELAWAN PENANGGULANGAN BENCANA INDONESIA <br>
                    NO : {{ ($model->nomor_relawan)? $model->nomor_relawan : '………………………………………………' }}
                </h3>
            </div>
            <div class="col-12 m-0 position-relative">
                <img src="{{ $model->displayFoto() }}" width="200" style="position: absolute; right: 10px; top: 50px; z-index: 10;">
            </div>
            <div class="col-12 mt-4">
                <ol type="I">
                    <li class="font-weight-bold mt-4">IDENTITAS DIRI
                        <ol type="a" class="font-weight-normal">
                            <table class="table borderless">
                                <tr>
                                    <td width="20%"><li>Nama</li></td>
                                    <td style="padding-right: 200px;">: {{ $model->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td><li>Tgl Lahir</li></td>
                                    <td style="padding-right: 200px;">: {{ $model->tgl_lahir }}</td>
                                </tr>
                                <tr>
                                    <td><li>Jenis Kelamin</li></td>
                                    <td style="padding-right: 200px;">: {{ $model->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <td><li>Pendidikan Terakhir</li></td>
                                    <td style="padding-right: 200px;">: {{ $model->pendidikan }}</td>
                                </tr>
                                <tr>
                                    <td><li>Pekerjaan</li></td>
                                    <td>: {{ $model->pekerjaan }}</td>
                                </tr>
                                <tr>
                                    <td><li>No. KTP/SIM</li></td>
                                    <td>: {{ $model->ktp }}</td>
                                </tr>
                                <tr>
                                    <td><li>Alamat Rumah</li></td>
                                    <td>: {{ $model->alamat }}</td>
                                </tr>
                                <tr>
                                    <td><li>No. Telp.</li></td>
                                    <td>: {{ $model->tlp }}</td>
                                </tr>
                                <tr>
                                    <td><li>E-mail</li></td>
                                    <td>: {{ $model->email }}</td>
                                </tr>
                            </table>
                        </ol>
                    </li>

                    <li class="font-weight-bold mt-4">ORGANISASI INDUK RELAWAN PB
                        
                        <ol type="a" class="font-weight-normal">
                            <table class="table borderless">
                                <tr>
                                    <td width="20%"><li>Nama Organisasi</li></td>
                                    <td>: {{ $model->induk_organisasi->nama_organisasi }}</td>
                                </tr>
                                <tr>
                                    <td><li>Alamat Organisasi:</li></td>
                                    <td>: {{ $model->induk_organisasi->alamat_organisasi }}</td>
                                </tr>
                                <tr>
                                    <td><li>No. Telp.</li></td>
                                    <td>: {{ $model->induk_organisasi->tlp_organisasi }}</td>
                                </tr>
                                <tr>
                                    <td><li>E-mail</li></td>
                                    <td>: {{ $model->induk_organisasi->email_organisasi }}</td>
                                </tr>
                                <tr>
                                    <td><li>Nama Pimpinan</li></td>
                                    <td>: {{ $model->induk_organisasi->nama_pimpinan_organisasi }}</td>
                                </tr>
                            </table>
                        </ol>
                    </li>

                    <li class="font-weight-bold mt-4">KECAKAPAN UTAMA DALAM PENANGGULANGAN BENCANA
                        <ol type="1" class="font-weight-normal">
                            <li class="p-3">{{ $model->namaSkillUtama() }}</li>
                        </ol>
                    </li>

                    <li class="font-weight-bold mt-4">KECAKAPAN PENDUKUNG DALAM PENANGGULANGAN BENCANA
                        <ol type="1" class="font-weight-normal">
                            @foreach($model->skills as $row)
                                <li class="p-3">{{ $row->skill->nama_skill }}</li>
                            @endforeach
                        </ol>
                    </li>

                    <li class="font-weight-bold mt-4">PELATIHAN PENANGGULANGAN BENCANA YANG PERNAH DIIKUTI
                        <table class="table table-bordered w-100 text-dark font-weight-normal mt-4" style="border-color:black;">
                            <tr>
                                <th>No</th>
                                <th>Jenis Pelatihan</th>
                                <th>Tempat</th>
                                <th>Penyelenggara</th>
                                <th>Tahun</th>
                            </tr>
                            @if(count($model->pelatihan) > 0)
                                @php $i=1; @endphp
                                @foreach($model->pelatihan as $row)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $row->jenis_pelatihan }}</td>
                                        <td>{{ $row->tempat }}</td>
                                        <td>{{ $row->penyelenggara }}</td>
                                        <td>{{ $row->tahun }}</td>
                                    </tr>
                                @endforeach
                            @else 
                                <tr><td colspan="5">Tidak ada data.</td></tr>
                            @endif
                        </table>
                    </li>

                    <li class="font-weight-bold mt-4">PENGALAMAN PENANGGULANGAN BENCANA YANG PERNAH DILAKUKAN
                        <table class="table table-bordered w-100 text-dark font-weight-normal mt-4" style="border-color:black;">
                            <tr>
                                <th>No</th>
                                <th>Jenis Bencana</th>
                                <th>Lokasi</th>
                                <th>Tahun</th>
                            </tr>
                            @if(count($model->pengalaman) > 0)
                                @php $i=1; @endphp
                                @foreach($model->pengalaman as $row)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $row->jenis_bencana }}</td>
                                        <td>{{ $row->lokasi }}</td>
                                        <td>{{ $row->tahun }}</td>
                                    </tr>
                                @endforeach
                            @else 
                                <tr><td colspan="4">Tidak ada data.</td></tr>
                            @endif
                        </table>
                    </li>

                    <li class="font-weight-bold mt-4">SURAT PERNYATAAN SEBAGAI RELAWAN PENANGGULANGAN BENCANA INDONESIA
                        <p class="font-weight-normal text-justify">Dengan ini menyatakan bahwa saya bersedia menjadi relawan penanggulangan bencana Indonesia yang siap untuk ditugaskan ke lokasi kejadian bencana. Selama menjalankan tugas saya sebagai Relawan akan mentaati ketentuan yang ditetapkan oleh Badan Nasional Penanggulangan Bencana.</p>
                        <p class="font-weight-normal text-justify">Demikian pernyataan ini saya buat dengan sungguh-sungguh dan penuh tanggung jawab.</p>
                        <p class="font-weight-normal text-right"></p>
                        <table class="w-100 font-weight-normal">
                            <tr>
                                <td width="40%">
                                    <p class="text-center">
                                        &nbsp; <br>
                                        Mengetahui, <br>
                                        Pimpinan Organisasi <br>
                                        ttd <br>
                                        &nbsp; <br>
                                        &nbsp; <br>
                                        ( &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; )
                                    </p>
                                </td>
                                <td  width="20%">&nbsp;</td>
                                <td  width="40%">
                                    <p class="text-center">
                                        ……………, ……/………………/…………… <br>
                                        &nbsp; <br>
                                        &nbsp; <br>
                                        ttd <br>
                                        &nbsp; <br>
                                        &nbsp; <br>
                                        ( &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; )
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </li>

                </ol>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            window.print();
        });
    </script>
</body>
</html>