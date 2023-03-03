@extends('layouts.app')

@section('title','Home Page')

@section('content')

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">

    <div class="carousel-inner">

        @foreach ($sliders as $key=>$sliderItem)   
        <div class="carousel-item {{$key==0?'active':''}}">
            @if($sliderItem->image)
            <img src="{{asset("$sliderItem->image")}}" width="128" height="500" class="d-block w-100" alt="...">
            @endif
            <div class="carousel-caption d-none d-md-block">
            <h5>{{$sliderItem->title}}</h5>
            <p>{{$sliderItem->description}}</p>
            </div>
        </div>   
        @endforeach

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
    
  <div class="py-5 bg-white">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 text-center">
          <h4>Welcome to Laravel Ecommerce
            <div class="underline">
              <p>

              </p>
            </div>
        </div>
      </div>
    </div>

    <div class="py-5 bg-white">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h4>Trending Products</h4>
            <div class="underline"></div>
          </div>
            @if($trendingProducts)
            @foreach($trendingProducts as $productItem)
            <div class="col-md-3">
                <div class="product-card">
                    <div class="product-card-img">
                        @if($productItem->quantity>0)
                        <label class="stock bg-success">In Stock</label>
                        @else    
                        <label class="stock bg-danger">Out of Stock</label>    
                        @endif
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

@endsection