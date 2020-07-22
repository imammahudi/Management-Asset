@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ trans('Detil Asset') }}
@parent
@stop


{{-- Page content --}}
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table class="table">
    @foreach ($data_assets as $data)
  <tbody>
    <tr>
      <th scope="row">Nama Asset</th>
      <td>{{$data->nama}}</td>
    </tr>
    <tr>
      <th scope="row">Asset Tag</th>
      <td>{{$data->tag}}</td>
    </tr>
    <tr>
      <th scope="row">Serial</th>
      <td>{{$data->serial}}</td>
    </tr>
    <tr>
      <th scope="row">Notes</th>
      <td>{{$data->note}}</td>
    </tr>
    <tr>
      <th scope="row">purchase_date</th>
      <td>{{$data->purchase_date}}</td>
    </tr>
    <tr>
      <th scope="row">purchase_cost</th>
      <td>{{$data->purchase_cost}}</td>
    </tr>
    <tr>
      <th scope="row">Order Number</th>
      <td>{{$data->number}}</td>
    </tr>
@endforeach
</tbody>
</table>
 <a href="/proyek">
 <button type="button" class="btn btn-secondary">Close</button>
 </a>
                    
</body>
</html>
@stop

@section('moar_scripts')
@include ('partials.bootstrap-table')

@stop