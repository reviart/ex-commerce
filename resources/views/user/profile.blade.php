@extends('layouts.master')

@section('title')
  Apotek revi
@endsection

@section('content')
<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <h1 class="title-page">User Profile</h1>
    <hr>
    <h4>Name : {{ Auth::user()->name }}</h4>
    <h4>Email : {{ Auth::user()->email }}</h4>
  </div>
</div><br><br>

<div class="row">

   <div class="col-md-8 col-md-offset-2">
     <h2>History order</h2>
    @foreach($orders as $order)
    <div class="panel panel-default">
      <div class="panel-body">
        <ul class="list-group">
          @foreach($order->cart->items as $item)
            <li class="list-group-item">
              <span class="badge">${{$item['price']}}</span>
              {{$item['item']['title']}} | {{$item['qty']}}
              @if( $item['qty'] > 1)
                <span class="label label-primary">Units</span>
              @else
                <span class="label label-default">Unit</span>
              @endif
            </li>
          @endforeach
        </ul>
      </div>
      <div class="panel-footer">
        <strong>Total Price: ${{ $order->cart->totalPrice}}</strong>
        <i>{{$order->created_at->diffForHumans()}}</i>
      </div>
    </div>
    @endforeach
   </div>
</div>
@endsection
