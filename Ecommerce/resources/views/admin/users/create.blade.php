@extends('layouts.admin')
@section('title','Users List')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
            
        @endif
        <div class="card">
            <div class="card-header">
                <h4>Users
                    <a href="{{url('admin/users')}}" class="btn btn-danger btn-sm text-white float-end">
                        Back
                    </a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{url('admin/users')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                            @error('name')
                                <small class='text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control">
                            @error('email')
                                <small class='text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                                <small class='text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Select Role</label>
                            <select name="role_as" class="form-control" style="height: 45px;">
                                <option value="">Select Role</option>
                                <option value="0">User</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                        <div class="col-md-12 text-end">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection