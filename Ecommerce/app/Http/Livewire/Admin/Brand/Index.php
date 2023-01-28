<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $name,$slug,$status,$brand_id;
    public function rules()
    {
        return [
            'name'=>'required|string',
            'slug'=>'required|string',
            'status'=>'nullable'
        ];
    }
    public function resetInput()
    {
        $this->name=NULL;
        $this->slug=NULL;
        $this->status=NULL;
        $this->brand_id=NULL;
    }
    public function storeBrand()
    {
        $validatedData=$this->validate();
        Brand::create([
            'name' => $this->name,
            'slug'=>Str::slug($this->slug),
            'status'=>$this->status==true?'1':'0',
        ]);
        session()->flash('message','Brand Added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }
    public function closeModal()
    {
        $this->resetInput();
    }
    public function editBrand(int $id)
    {
        $brands=Brand::findOrFail($id);
        $this->name=$brands->name;
        $this->slug=$brands->slug;
        $this->status=$brands->status;
        $this->brand_id=$id;
    }
    public function openModal()
    {
        $this->resetInput();
    }
    public function updateBrand()
    {
        $validatedData=$this->validate();
        Brand::findOrFail($this->brand_id)->update([
            'name' => $this->name,
            'slug'=>Str::slug($this->slug),
            'status'=>$this->status==true?'1':'0',
        ]);
        session()->flash('message','Brand Update Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }
    public function deleteBrand($id)
    {
        $this->brand_id=$id;
    }
    public function destroyBrand()
    {
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message','Brand Delete Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }
    public function render()
    {
        $brands=Brand::orderBy('id','ASC')->paginate(2);
        return view('livewire.admin.brand.index',['brands'=>$brands])
                ->extends('layouts.admin')
                ->section('content')
        ;
    }
}
