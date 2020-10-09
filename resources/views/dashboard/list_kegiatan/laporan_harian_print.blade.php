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
                    LAPORAN HARIAN<br> 
                    RELAWAN PENANGGULANGAN BENCANA <br>
                    BPBD PROVINSI BALI
                </h3>
                <hr>
            </div>
            <div class="col-md-12 mt-4">
                <h3>Periode : {{ $from }} s/d {{ $to }}</h3>
                <table class="table display" id="myTable">
                    <thead class="thead-dark">
                        <tr> 
                            <th>No</th>
                            <th>Kegiatan</th> 
                            <th>Judul</th> 
                            <th>Laporan</th> 
                            <th>Tanggal Laporan</th> 
                            <th>Relawan</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($datas) > 0)
                             <?php $no = 1; ?>
                            @foreach($datas as $key => $data)
                                <tr>
                                    <td>{{ $no++ }}</td>    
                                    <td>{{$data->judul_bencana}}</td> 
                                    <td>{{$data->judul_laporan}}</td> 
                                    <td>{{$data->detail_laporan}}</td>
                                    <td>{{date('d M Y', strtotime($data->tgl_laporan))}}</td> 
                                    <td>
                                        <p>Umum : {{$data->jml_relawan_umum}}<p>
                                        <p>Terverifikasi : {{$data->jml_relawan_private}}<p>
                                    </td>
                                     
                                </tr>
                            @endforeach
                        @else 
                            <tr>
                                <td colspan="5">tidak ada data.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>