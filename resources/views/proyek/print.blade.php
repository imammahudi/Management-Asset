@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ trans('Proyek Reports') }} 
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

   <!-- Editable table -->
<div class="card">
 
  <div class="card-body">
    <div id="table" class="table-editable">
      <table class="table table-bordered table-responsive-md  text-center">
          <tr>
            <th class="text-center"><img src="{{url('img/logosisi.jpeg')}}" width="100px" height="80px"></th>
            <th class="text-center" style="font-size:25px">PT Sinergi Informatika Semen Indonesia</th>
          </tr>
      </table>
    </div>
  </div>
</div>
<!-- Editable table -->
<br>
<br>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
      <table class="table">
  <tbody>
    <tr>
      <th scope="row">Nama Proyek</th>
      <td>:</td>
      <td>Proyek A</td>
    </tr>
        <tr>
      <th scope="row">Nama Departemen</th>
      <td>:</td>
      <td>Enginering</td>
    </tr>
    <tr>
      <th scope="row">Nama PIC</th>
      <td>:</td>
      <td>Imam</td>
    </tr>
    <tr>
      <th scope="row">Nama PIC Teknisi</th>
      <td>:</td>
      <td>Mahudi</td>
    </tr>
  </tbody>
</table>
        </div>
    </div>
</div>

<br>
<br>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Nama Asset</th>
      <th scope="col">Asset Tag</th>
      <th scope="col">Serial</th>
      <th scope="col">Purchase Date</th>
      <th scope="col">Purchase Cost</th>
      <th scope="col">Order Number</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Coba 1</td>
      <td>0007</td>
      <td>aslkdnakjsdnkas</td>
      <td>2020-03-18</td>
      <td>20000.00</td>
      <td>3</td>
    </tr>
  </tbody>
</table>
<button type="button" class="btn btn-danger">Export Pdf</button>
        </div>
    </div>
</div>

</body>
</html>

@stop

@section('moar_scripts')
    @include ('partials.bootstrap-table')
@stop