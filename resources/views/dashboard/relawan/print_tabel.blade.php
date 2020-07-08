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
                    DATA PENDATAAN<br> 
                    RELAWAN PENANGGULANGAN BENCANA <br>
                    BPBD PROVINSI BALI
                </h3>
                <hr>
            </div>
            <div class="col-md-12 mt-4">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Hp</th>
                            <th>Jenis</th> 
                            <th>Nomor Relawan</th> 
                            <th>Organisasi</th> 
                            <th>Keahlian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($datas) > 0)
                            <?php $i = 0; ?>
                            @foreach($datas as $key => $data)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->tlp}}</td>
                                    <td>{{($data->jenis_relawan == 1 && $data->nomor_relawan !='')? 'Terverifikasi': 'Umum'}}</td>
                                    <td>{{$data->nomor_relawan}}</td>
                                    <td>{{$data->nama_organisasi}}</td>
                                    <td>{{$data->nama_skill}}</td>
                                </tr>
                            @endforeach
                        @else 
                            <tr>
                                <td colspan="6">tidak ada data.</td>
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