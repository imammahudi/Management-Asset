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
                    <form action="/proyek/{{$proyek->id}}/update" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Proyek</label>
                            <input type="TEXT" class="form-control" placeholder="" name="nama_asset" value="{{$proyek->nama_proyek}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Departemen</label>
                            <input type="TEXT" class="form-control" placeholder="" value="{{$proyek->nama_dept}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama PIC</label>
                            <input type="TEXT" class="form-control" placeholder="" name="nama_pic" value="{{$proyek->nama_pic}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Teknisi</label>
                            <input type="TEXT" class="form-control" placeholder="" name="nama_teknisi" value="{{$proyek->nama_teknisi}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select id="cars" name="status">
                                <option value="Pending" @if ($proyek->status == 'Pending')selected @endif>Pending</option>
                                <option value="CheckIn" @if ($proyek->status == 'Pending')selected @endif>CheckIn</option>
                                <option value="CheckOut" @if ($proyek->status == 'Pending')selected @endif>CheckOut</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nominal</label>
                            <input type="number" class="form-control" placeholder="" name="nominal" value="{{$proyek->nominal}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Catatan</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="catatan">{{$proyek->catatan}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Mulai</label>
                            <input type="date" class="form-control" placeholder="" name="tanggal_mulai" value="{{$proyek->tanggal_mulai}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Selesai</label>
                            <input type="date" class="form-control" placeholder="" name="tanggal_selesai" value="{{$proyek->tanggal_selesai}}">
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="/proyek">
                        <button type="button" class="btn btn-secondary">Cancel</button>
                        </a>
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