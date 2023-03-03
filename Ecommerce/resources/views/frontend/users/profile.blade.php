@extends('layouts.app')

@section('title','User Profile')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4>User Profile</h4>
                <div class="underline mb-4">

                </div>
                <div class="col-md-10">
                    @if (session('message')) 
                        <p class="alert alert-success">{{ session('message') }}</p>
                    @endif
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                        
                    @endif
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h4 class="mb-0 text-white">User Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('profile') }}">
                            @csrf
                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Username</label>
                                            <input value="{{ Auth::user()->name }}" type="text" name="username" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Email Address</label>
                                            <input readonly value="{{ Auth::user()->email }}" type="text" name="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Phone Number</label>
                                            <input type="text" name="phone" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Zip/Pin Code</label>
                                            <input type="text" name="zip_code" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="">Address</label>
                                            <textarea name="address" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Save Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection