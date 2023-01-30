<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductFormRequest;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products=Product::all();
        return view('admin.products.index',compact('products'));
    }
    public function create()
    {
        $categories=Category::all();
        $brands=Brand::all();
        return view('admin.products.create',compact('categories','brands'));
    }
    public function store(ProductFormRequest $request)
    {
        $validatedData=$request->validated();
        $category=Category::findOrFail($validatedData['category_id']);
        $product=$category->products()->create([
            'category_id'=>$validatedData['category_id'],
            'name'=>$validatedData['name'],
            'slug'=>Str::slug($validatedData['slug']),
            'brand'=>$validatedData['brand'],
            'small_description'=>$validatedData['small_description'],
            'description'=>$validatedData['description'],
            'original_price'=>$validatedData['original_price'],
            'selling_price'=>$validatedData['selling_price'],
            'quantity'=>$validatedData['quantity'],
            'trending'=>$request->trending==true?'1':'0',
            'status'=>$request->status==true?'1':'0',
            'meta_title'=>$validatedData['meta_title'],
            'meta_keyword'=>$validatedData['meta_keyword'],
            'meta_description'=>$validatedData['meta_description'],
        ]);
        
        if($request->hasFile('image')){
            $uploadPath='uploads/products/';
            $i=1;
            foreach($request->file('image') as $imageFile)
            {
                $extention=$imageFile->getClientOriginalExtension();
                $filename=time().$i++.'.'.$extention;
                $imageFile->move($uploadPath,$filename);
                $finalImagePathName=$uploadPath.$filename;
                $product->productImages()->create([
                    'product_id'=>$product->id,
                    'image'=>$finalImagePathName, 
                ]);
            }
        }
        return redirect('admin/products')->with('message','Product Added Succesfully');
    }
    public function edit(int $id)
    {
        $categories=Category::all();
        $brands=Brand::all();
        $product=Product::findOrFail($id);
        return view('admin.products.edit',compact('categories','brands','product'));
    }
    public function Update(ProductFormRequest $request,int $id)
    {
        $validatedData=$request->validated();
        $product=Category::findOrFail($validatedData['category_id'])->products()->where('id',$id)->first();
        if($product)
        {
            $product->update([
                'category_id'=>$validatedData['category_id'],
                'name'=>$validatedData['name'],
                'slug'=>Str::slug($validatedData['slug']),
                'brand'=>$validatedData['brand'],
                'small_description'=>$validatedData['small_description'],
                'description'=>$validatedData['description'],
                'original_price'=>$validatedData['original_price'],
                'selling_price'=>$validatedData['selling_price'],
                'quantity'=>$validatedData['quantity'],
                'trending'=>$request->trending==true?'1':'0',
                'status'=>$request->status==true?'1':'0',
                'meta_title'=>$validatedData['meta_title'],
                'meta_keyword'=>$validatedData['meta_keyword'],
                'meta_description'=>$validatedData['meta_description'],
            ]);
            if($request->hasFile('image')){
                $uploadPath='uploads/products/';
                $i=1;
                foreach($request->file('image') as $imageFile)
                {
                    $extention=$imageFile->getClientOriginalExtension();
                    $filename=time().$i++.'.'.$extention;
                    $imageFile->move($uploadPath,$filename);
                    $finalImagePathName=$uploadPath.$filename;
                    $product->productImages()->create([
                        'product_id'=>$product->id,
                        'image'=>$finalImagePathName, 
                    ]);
                }
            }
            return redirect('admin/products')->with('message','Product Updated Succesfully');
        }
        else
        {
            return redirect('admin/products')->with('message','No Product ID found');
        }
    }

    public function destroyImage(int $id)
    {
        $productImage=ProductImage::findOrFail($id);
        if(File::exists($productImage->image))
        {
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message','Product Image Deleted');
    }
    public function destroy(int $id)
    {
        $product=Product::findOrFail($id);
        if($product->productImages){
            foreach($product->productImages as $image)
            {
                if(File::exists($image->image))
                {
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
        return redirect()->back()->with('message','Product Deleted Successfully');
    }
}
