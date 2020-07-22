@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ trans('Proyek') }}
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
                    <form action="/proyek/insert" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Proyek</label>
                            <input type="TEXT" class="form-control" placeholder="" name="nama_proyek" required="required">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Departemen</label>
                            <input type="TEXT" class="form-control" placeholder="" name="nama_dept" required="required">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama PIC</label>
                            <select name="nama_pic" id="asset" class="form-control">
                                    <option value="">Nama PIC</option>
                            @foreach ($data_pic as $id)     
                            <option value="{{ $id['username'] }}">{{ $id['username'] }}</option>
                            @endforeach
                    </select>              
                      </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Teknisi</label>
                            <input type="TEXT" class="form-control" placeholder="" name="nama_teknisi" required="required">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select id="cars" name="status" required="required">
                                <option value="Pending">Pending</option>
                                <option value="CheckIn">CheckIn</option>
                                <option value="CheckOut">CheckOut</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nominal</label>
                            <input type="number" class="form-control" placeholder="" name="nominal" required="required">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Catatan</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="catatan" required="required"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Mulai</label>
                            <input type="date" class="form-control" placeholder="" name="tanggal_mulai" required="required">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Selesai</label>
                            <input type="date" class="form-control" placeholder="" name="tanggal_selesai" required="required">
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">email</label>
                            <input type="email" class="form-control" placeholder="" name="email" required="required">
                        </div> --}}
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