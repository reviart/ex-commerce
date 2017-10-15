@extends('layouts.master')

@section('title')
  Shop
@stop
@section('content')
<div class="row">
   <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
       <h1 class="title-page">Checkout</h1>
       <h4>Your Total : ${{$total}}</h4>
       <h4>Cupay saldo : $XXXXXXXXXXXX</h4>
       <div class="charge-error"
        class="alert alert-danger {{ !Session::has('error') ? 'hidden': '' }}">
        {{Session::get('error')}}
       </div>
         <form  action="{{route('post.checkout')}}" method="post" id="checkout-form">
            <div class="row">
              <!-- <input type="hidden" id="name" class="form-control" required name="{{ Auth::user()->name }}"> -->
              <div class="col-xs-12">
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" id="address" class="form-control" required name="address">
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label for="courier">Courier</label><br>
                  <input type="radio" name="courier"  value="Curtner"> Curtner
                  <input type="radio" name="courier"  value="Gojek"> Gojek
                </div>
              </div>
            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-success">Finish</button>
         </form>
   </div>
</div>
<br><br>
@stop

@section('script')
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script type="text/javascript" src="{{URL::asset('js.checkout.js')}}"></script>
@stop
