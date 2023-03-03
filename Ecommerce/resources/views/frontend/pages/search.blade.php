@extends('layouts.app')

@section('title','Search')

@section('content')



    <div class="py-5 bg-white">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            @if($searchProducts->count()!=0)
            <h4>Search Results</h4>
            @endif
            <div class="underline"></div>
          </div>
            @if($searchProducts->count()!=0)
            @foreach($searchProducts as $productItem)
            <div class="col-md-3">
                <div class="product-card">
                    <div class="product-card-img">
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
                <h4>No Product Found</h4>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  </div>


@endsection