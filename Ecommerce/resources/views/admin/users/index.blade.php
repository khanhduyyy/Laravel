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
                    <a href="{{url('admin/users/create')}}" class="btn btn-primary btn-sm text-white float-end">
                        Add Users
                    </a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>           
                                <td>{{$user->email}}</td>
                                <td>{{$user->role_as==1?'Admin':($user->role_as==0?'User':'None')}}</td>
                                <td>
                                    <a href="{{url('/admin/users/'.$user->id.'/edit')}}" class="btn btn-success btn-sm">Edit</a>
                                    <a href="{{url('/admin/users/'.$user->id.'/delete')}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure, you want to delete this data?')">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>No Users Available</td>
                            </tr>
                            @endforelse
                    </tbody>
                </table>
                {{$users->links()}}
            </div>
        </div>
    </div>
</div>
@endsection