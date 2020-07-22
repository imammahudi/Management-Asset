@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ trans('Proyek') }}
@parent
@stop


@section('header_right')
<a href="/proyek/create" class="btn btn-primary">Create New</a>
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
                            <th>Proyek</th>
                            <th>Nama Dept</th>
                            <th>Nama PIC</th>
                            <th>Nama Teknisi</th>
                            <th>Status</th>
                            <th>Nominal</th>
                            <th>Catatan</th>
                            <th>Action</th>
                        </tr>
                        @foreach($data_proyek as $proyek)
                        <tr>
                            <td>
                                <a href="/proyek/{{$proyek->id}}/detail">
                                    {{$proyek -> nama_proyek}}
                                </a>
                            </td>
                            <td>{{$proyek -> nama_dept}}</td>
                            <td>{{$proyek -> nama_pic}}</td>
                            <td>{{$proyek -> nama_teknisi}}</td>
                            <td>{{$proyek -> status}}</td>
                            <td>{{$proyek -> nominal}}</td>
                            <td>{{$proyek -> catatan}}</td>
                            <td>
                                <a href="/proyek/{{$proyek->id}}/edit" class="fa fa-pencil btn btn-warning"></a>
                                <a href="/proyek/{{$proyek->id}}/delete" class="btn btn-danger fa fa-trash btn sm"></a>
                                <button type="button" class="btn btn-info fa fa-eye btn lg" data-toggle="modal" data-target="#exampleModal"></button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail Proyek</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="/proyek/{{$proyek->id}}">
                                            <table class="table">
                                                <tr>
                                                    <th>Nama Proyek</th>
                                                    <td>{{$proyek->nama_proyek}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Departemen</th>
                                                    <td>{{$proyek->nama_dept}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nama PIC</th>
                                                    <td>{{$proyek->nama_pic}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Teknisi</th>
                                                    <td>{{$proyek->nama_teknisi}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>{{$proyek->status}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nominal</th>
                                                    <td>{{$proyek->nominal}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Mulai</th>
                                                    <td>{{$proyek->tanggal_mulai}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal selesai</th>
                                                    <td>{{$proyek->tanggal_selesai}}</td>
                                                </tr>
                                            </table>
                                    </form>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
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