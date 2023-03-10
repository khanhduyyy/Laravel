@extends('layouts.app')

@section('title','Home Page')

@section('content')

<div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="shadow bg-white p-3">
                <div class="mb-4">
                    <h4 class="mb-4">My Orders</h4>
                    <hr>
                    <div class="table-reponsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>Order ID</th>
                                <th>Tracking No</th>
                                <th>Username</th>
                                <th>Payment Mode</th>
                                <th>Ordered Date</th>
                                <th>Status Message</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($orders as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->tracking_no}}</td>
                                        <td>{{$item->fullname}}</td>
                                        <td>{{$item->payment_mode}}</td>
                                        <td>{{$item->created_at->format('d-m-Y')}}</td>
                                        <td>{{$item->status_message}}</td>
                                        <td><a href="{{url('orders/'.$item->id)}}" class="btn btn-primary btn-sm">View</a><td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Orders available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{$orders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</div>

@endsection
