<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders=Slider::where('status','0')->get();
        $trendingProducts=Product::where('trending','1')->latest()->take(15)->get();
        return view('frontend.index',compact('sliders','trendingProducts'));
    }

    public function newArrival()
    {
        $newArrivalsProducts=Product::latest()->take(15)->get();
        return view('frontend.pages.new-arrival',compact('newArrivalsProducts'));
    }

    public function categories()
    {
        $categories=Category::where('status','0')->get();
        return view('frontend.collections.category.index',compact('categories'));
    }
    public function products($category_slug)
    {
        $category=Category::where('slug',$category_slug)->first();
        if($category)
        {
            return view('frontend.collections.product.index',compact('category'));
        }
        else{
            return redirect()->back();
        }
    }
    public function productView(string $category_slug,string $product_slug)
    {
        $category=Category::where('slug',$category_slug)->first();
        if($category)
        {
            $product=$category->products()->where('slug',$product_slug)->where('status','0')->first();
            if($product)
            {
                return view('frontend.collections.product.view',compact('product','category'));
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect()->back();
        }
    }
    public function thankyou()
    {
        return view('frontend.thank-you');
    }
}
