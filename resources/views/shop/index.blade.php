@extends('layouts.master')

@section('title')
    Laravel Shopping Cart
@endsection

@section('content')
    @foreach($products->chunk(3) as $productChunk)
        <div class="row">
            @foreach($productChunk as $product)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="{{ $product->imgpath }}" alt="kucing" class="img-responsive" width="300px">
                        <div class="caption">
                            <h3>{{ $product->title }}</h3>
                            <p class="description">{{ $product->description }}</p>
                            <div class="clearfix">
                                <div class="pull-left price">${{ $product->price }}</div>
                                  @if(Auth::check())
                                <a href="{{ route('add.product.to.cart', ['id' => $product->id]) }}" class="btn btn-success pull-right" role="button">Add to Cart</a>
                                  @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
    {{  $products->links() }}
@endsection
