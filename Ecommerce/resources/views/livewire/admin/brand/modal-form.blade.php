<div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Brands</h5>
          <button type="button" wire:click="closeModal" class="btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent="storeBrand">
            <div class="modal-body">
              <div class="mb-3">
                <label>Select Category</label>  
                <select wire:model.defer="category_id" required class="form-control">
                  @foreach ($categories as $cateItem)
                  <option value="{{$cateItem->id}}">{{$cateItem->name}}</option>
                  @endforeach
                </select>
                @error('category_id') <small class="text-danger">{{$message}}</small> @enderror
              </div> 
                <div class="mb-3">
                    <label>Brand Name</label>
                    <input type="text" wire:model.defer="name" class="form-control">
                    @error('name') <small class="text-danger">{{$message}}</small> @enderror
                </div>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Brand Slug</label>
                    <input type="text" wire:model.defer="slug" class="form-control">
                    @error('slug') <small class="text-danger">{{$message}}</small> @enderror
                </div>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Status</label><br/>
                    <input type="checkbox" wire:model.defer="status" /> Checked=Hidden, Un-Checked=Visible
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" wire:click="closeModal" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Brands</h5>
          <button type="button" class="btn-close" wire:click="closeModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
      <div wire:loading class="p-2">
        <div class="spinner-border text-primary" role="status">
          <span class="sr-only">Loading...</span>
        </div>Loading...
      </div>

      
      <div wire:loading.remove>

      <form wire:submit.prevent="updateBrand">
          <div class="modal-body">
            <div class="mb-3">
              <label>Select Category</label>  
              <select wire:model.defer="category_id" required class="form-control">
                @foreach ($categories as $cateItem)
                <option value="{{$cateItem->id}}">{{$cateItem->name}}</option>
                @endforeach
              </select>
              @error('category_id') <small class="text-danger">{{$message}}</small> @enderror
            </div> 
              <div class="mb-3">
                  <label>Brand Name</label>
                  <input type="text" wire:model.defer="name" class="form-control">
                  @error('name') <small class="text-danger">{{$message}}</small> @enderror
              </div>
              <div class="mb-3">
                  <label>Brand Slug</label>
                  <input type="text" wire:model.defer="slug" class="form-control">
                  @error('slug') <small class="text-danger">{{$message}}</small> @enderror
              </div>
              <div class="mb-3">
                  <label>Status</label><br/>
                  <input type="checkbox" wire:model.defer="status" style="width:70px;height=70px"/> Checked=Hidden, Un-Checked=Visible
              </div>
          </div>
          <div class="modal-footer">
          <button type="button" wire:click="closeModal" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
          </div>
      </form>
      </div>
    </div>
  </div>
</div>


<div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Brands</h5>
          <button type="button" class="btn-close" wire:click="closeModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
      <div wire:loading class="p-2">
        <div class="spinner-border text-primary" role="status">
          <span class="sr-only">Loading...</span>
        </div>Loading...
      </div>

      
      <div wire:loading.remove>

      <form wire:submit.prevent="destroyBrand">
          <div class="modal-body">
              <h4>Are you sure want to delete this data?</h4>
          </div>
          <div class="modal-footer">
          <button type="button" wire:click="closeModal" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Delete</button>
          </div>
      </form>
      </div>
    </div>
  </div>
</div>