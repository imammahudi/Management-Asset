<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>Invoice</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
        .text-right {
            text-align: right;
        }
    </style>

</head>
<body class="login-page" style="background: white">

    <div>
        <div class="row">
            <div class="col-xs-7">
                <h4>From:</h4>
                <strong>Semen Indonesia</strong><br>
                Tlogobendung, Tuban Barat, <br>
                Kec. Gresik, Kabupaten Gresik, <br>
                Jawa Timur 61122
                <br>
            </div>

            <div class="col-xs-6">
                <h3>Sinergi Informatika Semen Indonesia</h3>
            </div>
        </div>

        <div style="margin-bottom: 0px">&nbsp;</div>

        <div class="row">
            <div class="col-xs-5">
                <table style="width: 100%">
                    {{$limit = 0}}
                    <tbody>
                        @foreach ($data_proyek as $proyek)
                        {{$limit++ }}
                            @if ($limit == 1) 
                        <tr>
                            <th>Nama Proyek:</th>
                            <td class="text-right">{{ $proyek['nama_proyek'] }}</td>
                        </tr>
                        <tr>
                            <th>Nama Departemen:</th>
                            <td class="text-right">{{ $proyek['nama_dept'] }}</td>
                        </tr>
                        <tr>
                            <th>Nama PIC:</th>
                            <td class="text-right">{{ $proyek['nama_pic'] }}</td>
                        </tr>
                        <tr>
                            <th>Nama Teknisi:</th>
                            <td class="text-right">{{ $proyek['nama_teknisi'] }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    
                </table>

                <div style="margin-bottom: 0px">&nbsp;</div>

            </div>
        </div>

        <table class="table">
            <thead style="background: #F5F5F5;">
                <tr>
                    <th>Asset List</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                        <th scope="col">Nama Asset</th>
                        <th scope="col">Asset Tag</th>
                        <th scope="col">Serial</th>
                        <th scope="col">Note</th>
                        <th scope="col">Purchase Date</th>
                        <th scope="col">Purchase Cost</th>

                    </tr>
                    @foreach ($detail_asset as $print)
                    <tr>
                        <td>{{ $print['name'] }}</td>
                        <td>{{ $print['tag'] }}</td>
                        <td>{{ $print['serial'] }}</td>
                        <td>{{ $print['note'] }}</td>
                        <td>{{ $print['purchase_date'] }}</td>
                        <td>{{ $print['purchase_cost'] }}</td>
                    </tr>
                    @endforeach
            </tbody>
        </table>

           
            <div style="margin-bottom: 0px">&nbsp;</div>

            <div class="row">
                <div class="col-xs-8 invbody-terms">
                    Thank you for your business. <br>
                </div>
            </div>
        </div>

    </body>
    </html>