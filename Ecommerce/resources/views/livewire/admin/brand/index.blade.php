<div>
    @include('livewire.admin.brand.modal-form')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Brands List
                        <a href="#" class="btn btn-primary btn-sm float-end" data-toggle="modal" data-target="#addBrandModal">Add Brands</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-stiped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brands as $brand)
                            <tr>
                                <td>{{$brand->id}}</td>
                                <td>{{$brand->name}}</td>
                                @if($brand->category)
                                    <td>{{$brand->category->name}}</td>
                                @else
                                    <td>No Category</td>
                                @endif
                                <td>{{$brand->slug}}</td>
                                <td>{{$brand->status==1?'hidden':'visible'}}</td>
                                <td>
                                    <a href="#" wire:click="editBrand({{$brand->id}})" data-toggle="modal" data-target="#updateBrandModal" class="btn btn-sm btn-success" >Edit</a>
                                    <a href="#" wire:click="deleteBrand({{$brand->id}})" data-toggle="modal" data-target="#deleteBrandModal" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>    
                            @empty
                            <tr>
                                <td colspan="5">No Brand Found</td>
                            </tr>    
                            @endforelse
                            
                        </tbody>
                    </table>
                    <div class="">
                        {{$brands->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
@push('script')
    <script>
        window.addEventListener('close-modal',event=>{
            $("#addBrandModal").removeClass("in");
            $(".modal-backdrop").remove();
            $("#addBrandModal").hide();
            $("#updateBrandModal").removeClass("in");
            $(".modal-backdrop").remove();
            $("#updateBrandModal").hide();
            $("#deleteBrandModal").removeClass("in");
            $(".modal-backdrop").remove();
            $("#deleteBrandModal").hide();
        });
    </script>
@endpush
