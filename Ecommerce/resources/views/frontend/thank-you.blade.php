@extends('layouts.app')

@section('title','Thank you for shopping')

@section('content')

<div class="py-3 pyt-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text text-center">
                <div class="p-4 shadow bg-white">
                    <img src="{{asset('uploads/thanks.jfif')}}" width="300px" height="200px" alt="">
                    <h4>Thanks for shopping with Laravel Ecommerce&lt3</h4>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection