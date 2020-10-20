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
                    LAPORAN <br>
                    <span style="text-transform: uppercase;">
                    {{ $datas->judul_bencana }}</span><br>
                    BPBD PROVINSI BALI
                </h3>
                <hr>
            </div>
            <div class="col-md-12 mt-4">
                <h5>Periode : {{ $datas->tgl_laporan }}</h5>
                <h5>Judul : {{$datas->judul_laporan}}</h5> 
                <h5>Relawan : {{$datas->jml_relawan_umum}} Umum, {{$datas->jml_relawan_private}} Terverifikasi</h5>
                <h5>Detail : </h5> 
                <p>{{$datas->detail_laporan}}</p>
                 
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>