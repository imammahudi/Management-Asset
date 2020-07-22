@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ trans('Mapping '.$data_proyek->nama_proyek) }}
@parent
@stop


{{-- Page content --}}
@section('content')



<div class="tab-pane" id="asset_tab">
        <!-- checked out assets table -->
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

          tr:nth-child(even) {
            background-color: #dddddd;
          }
        </style>
            <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                <ul class="nav nav-tabs hidden-print">
                    <li class="active">
                    <a href="#details" data-toggle="tab">
                        <span class="hidden-lg hidden-md">
                        <i class="fa fa-info-circle"></i>
                        </span>
                        <span class="hidden-xs hidden-sm">{{ trans('Mapping Asset') }}</span>
                    </a>
                    </li>
                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane active" id="details">
                    <div class="table-responsive">
                    <div class="form-group">
                        <form action="/proyek/{{$data_proyek->id}}/insert_asset" method="POST">
                                    {{csrf_field()}}
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                        Mapping
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Nama Asset</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                               <div class="modal-body">
                                                 
                                                    <div class="row">               
                                                        @foreach ($data_asset as $id)
                                                    <div class="col-md-3">          
                                                        <label>
                                                            <input type="checkbox"  name="id_asset[]" value="{{ $id['id'] }}"> {{ $id['name'] }}
                                                        </label>
                                                    </div>                           
                                                        @endforeach
                                                    </div>
                                                
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success ">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>  
                                <br> 
                        <table class="table">  
                            <tr>
                                <th scope="col">Nama Asset</th>
                                <th scope="col">Action</th>
                            </tr>
                            @foreach ($detail_asset as $id)
                                <tr>
                                     <td>{{ $id['name'] }}</td></a>
                                    
                                    <td>
                                            <a href="/proyek/{{$id->id}}/hapus" class="btn btn-danger btn-sm">Checkout</a>
                                            <a href="/proyek/{{$id->id}}/lihat_asset" class="btn btn-info btn-sm" >Detail</a>
                                <!-- Button trigger modal -->

                                    </td>
                                </tr>
                                
                                @endforeach
                        </table> 
                       


{{-- 
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
                    <form action="/proyek/{{$data_proyek->id}}/insert_asset" method="POST">
                        {{csrf_field()}}
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Mapping
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @foreach ($data_asset as $id)
                                    <div class="modal-body">
                                            <input type="checkbox"  name="id_asset[]" value="{{ $id['id'] }}"> {{ $id['name'] }}
                                    </div>
                                    @endforeach
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <form action="">
                        <table>
                            <tr>
                                <th>nama Asset</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($detail_asset as $id)
                            <tr>
                                <td>{{ $id['name'] }}</td>
                                 <td>
                                <a href="/proyek/{{$id->id}}/hapus" class="btn btn-danger fa fa-trash btn sm"></a>
                            </td>
                            </tr>
                            @endforeach
                        </table>
                    </form>
                    <br>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div><!-- /.box-body -->

                <div class="box-footer clearfix">
                </div>
            </div><!-- /.box -->
        </div>
    </div>

</body>
</head>

</html> --}}
@stop

@section('moar_scripts')
@include ('partials.bootstrap-table')

@stop