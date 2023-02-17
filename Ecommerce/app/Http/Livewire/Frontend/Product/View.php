<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Wishlist;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;


class View extends Component
{
    public $category,$product,$quantityCount=1;
    public function addToWishList($productId)
    {
        if(Auth::check())
        {
            if(Wishlist::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists())
            {
                session()->flash('message','Already added to wishlist');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already added to wishlist',
                    'type'=> 'warning',
                    'status'=> 409
                ]);
                return false;
            }
            else
            {
                $wishlist=Wishlist::create([
                    'user_id'=>auth()->user()->id,
                    'product_id'=>$productId,
                ]);
                $this->emit('wishlistAddedUpdated');
                session()->flash('message','Wishlist Added Successfully');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Wishlist Added Successfully',
                    'type'=> 'success',
                    'status'=> 200
                ]);
            }
        }
        else
        {
            session()->flash('message','Please login to continue');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please login to continue',
                'type'=> 'info',
                'status'=> 401
            ]);
            return false;
        }
    }
    public function incrementQuantity()
    {
        $this->quantityCount++;
    }
    public function decrementQuantity()
    {
        if($this->quantityCount>1)
        {
            $this->quantityCount--;
        }
    }
    public function addToCart(int $productId)
    {
        if(Auth::check())
        {
            if($this->product->where('id',$productId)->where('status','0')->exists())
            {
                if(Cart::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists())
                {
                    if($this->product->quantity>0)
                    {
                        if($this->product->quantity>$this->quantityCount)
                        {
                            $updateqtyCart=Cart::where('user_id',auth()->user()->id)->where('product_id',$productId)->first();
                            Cart::where('user_id',auth()->user()->id)->where('product_id',$productId)->update(['quantity'=>$updateqtyCart->quantity+$this->quantityCount]);
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Product Added To Cart',
                                'type'=> 'success',
                                'status'=> 200
                            ]);
                        }
                        else
                        {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Only '.$this->product->quantity.' Quantity Available',
                                'type'=> 'warning',
                                'status'=> 404
                            ]);
                        }
                    }
                    else
                    {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Out of stock',
                            'type'=> 'warning',
                            'status'=> 404
                        ]);
                    }
                }
                else
                {
                    if($this->product->quantity>0)
                    {
                        if($this->product->quantity>$this->quantityCount)
                        {
                            Cart::create([
                                'user_id'=>auth()->user()->id,
                                'product_id'=>$productId,
                                'quantity'=>$this->quantityCount
                            ]);
                            $this->emit('CartAddedUpdated');
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Product Added To Cart',
                                'type'=> 'success',
                                'status'=> 200
                            ]);
                        }
                        else
                        {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Only '.$this->product->quantity.' Quantity Available',
                                'type'=> 'warning',
                                'status'=> 404
                            ]);
                        }
                    }
                    else
                    {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Out of stock',
                            'type'=> 'warning',
                            'status'=> 404
                        ]);
                    }
                }
            }
            else
            {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product not exists',
                    'type'=> 'warning',
                    'status'=> 404
                ]);
            }
        }
        else
        {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please login to add to cart',
                'type'=> 'warning',
                'status'=> 401
            ]);
        }
    }
    public function mount($category,$product)
    {
        $this->category=$category;
        $this->product=$product;
    }
    public function render()
    {
        return view('livewire.frontend.product.view',[
            'category'=>$this->category,
            'product'=>$this->product
        ]);
    }
}
