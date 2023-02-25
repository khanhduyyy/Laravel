@extends('layouts.app')

@section('title','New Arrivals Product')

@section('content')



    <div class="py-5 bg-white">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h4>New Arrivals Products</h4>
            <div class="underline"></div>
          </div>
            @if($newArrivalsProducts)
            @foreach($newArrivalsProducts as $productItem)
            <div class="col-md-3">
                <div class="product-card">
                    <div class="product-card-img">
                        <label class="stock bg-danger">New</label>    
                        @if($productItem->productImages->count()>0)
                        <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                            <img src="{{asset($productItem->productImages[0]->image)}}" alt="{{$productItem->name}}">
                        </a>
                        @endif
                    </div>
                    <div class="product-card-body">
                        <p class="product-brand">{{$productItem->brand}}</p>
                        <h5 class="product-name">
                        <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                                {{$productItem->name}} 
                        </a>
                        </h5>
                        <div>
                            <span class="selling-price">${{$productItem->selling_price}}</span>
                            <span class="original-price">${{$productItem->original_price}}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-md-12">
              <div class="p-2">
                <h4>No Products Available</h4>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
  </div>


@endsection