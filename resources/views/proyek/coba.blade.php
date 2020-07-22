@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ trans('Edit Proyek') }}
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
        <div class="col-md-8">
            <div class="box">
                <div class="box-body">
                    <form action="assets/{{$assets->id}}/update" method="POST">
                        {{csrf_field()}}
                        <table>
                            <tr>
                                <th>nama Asset</th>
                            </tr>
                            <tr>
                                <td>{{$assets->nama_asset}}</td>
                            </tr>
                        </table>
                    </form>

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