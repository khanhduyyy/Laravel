@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
            
        @endif
        <div class="card">
            <div class="card-header">
                <h4>Edit Sliders
                    <a href="{{url('admin/sliders')}}" class="btn btn-danger btn-sm text-white float-end">
                        Back
                    </a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{url('admin/sliders/'.$slider->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT');
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" value="{{$slider->title}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3">{{$slider->description}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                        <img src="{{asset("$slider->image")}}" style="width:50px;height: 50px;" alt="Slider">
                    </div>
                    <div class="mb-3">
                        <label>Status</label><br>
                        <input type="checkbox" {{$slider->status=='1'?'checked':''}} name="status" style="width: 25px;height: 25px;">Checked=Hidden,UnChecked=Visible
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection