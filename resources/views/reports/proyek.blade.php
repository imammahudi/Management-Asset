@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ trans('Proyek Reports') }} 
@parent
@stop

{{-- Page content --}}
@section('content')

<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>


<body>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">

                    <table>

                        <tr>
                            <th>Nama Proyek</th>
                            <th>Nama Dept</th>
                            <th>Nama PIC</th>
                            <th>Catatan</th>
                            <th>Action</th>
                        </tr>
                        @foreach($data_proyek as $proyek)
                        <tr>
                            <td>{{$proyek -> nama_proyek}}</td>
                            <td>{{$proyek -> nama_dept}}</td>
                            <td>{{$proyek -> nama_pic}}</td>
                            <td>{{$proyek -> catatan}}</td>
                            <td>
                            <a href="/reports/{{$proyek->id}}/exportPdf" class="fa fa-file-pdf-o btn btn-danger" placeholder="Print PDF"></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>


                </div><!-- /.box-body -->

                <div class="box-footer clearfix">
                </div>
            </div><!-- /.box -->
        </div>
    </div>

</body>
</head>

</html>



@stop

@section('moar_scripts')
    @include ('partials.bootstrap-table')
@stop
