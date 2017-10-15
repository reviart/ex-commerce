@extends('layouts.master')

@section('title')
  Shop
@endsection

@section('content')
<div class="container">
  <div class="row">
     <div class="col-sm-6 col-md-4 text-center" style="background-color:yellow;">
         <h1 class="title-page">Transfer</h1>
         <h4>Your Total : ${{$total}}</h4>
         <hr>
         <h4>BCA - 723121217353</h4>
         <h4>MANIDIRI - 9663253625</h4>
         <h4>BNI - 113232443</h4>
         <h4>BRI - 9943436200032</h4>
         <hr>
         <h4>Your limit 06:19 PM</h4>
     </div>
     <div class="col-sm-6 col-md-4 text-center">
     </div>
     <div class="col-sm-6 col-md-4 text-center" style="background-color:yellow;">
       <br><br>
       <a href="{{ route('get.checkout') }}" class="btn btn-danger"> Cupay </a>
       <br><br><br>
     </div>
  </div>
</div>
@endsection
