<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart;
    public function increaseQty($cartId){
        $cartData=Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();
        if($cartData->product->qty > $cartData->quantity){
            $cartData->increment('quantity');
            $this->dispatchBrowserEvent('message',[
                'text'=>'product qty increased by 1 to cart',
                'type'=>'success',
                'status'=>200
            ]);
        }
        else {
            $this->dispatchBrowserEvent('message',[
                'text'=>'something went wrong',
                'type'=>'error',
                'status'=>400
            ]);
        }
    }
    public function decreaseQty($cartId){
        $cartData=Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();
        if($cartData->quantity > 1){
            $cartData->decrement('quantity');
            $this->dispatchBrowserEvent('message',[
                'text'=>'product qty decreased by 1 to cart',
                'type'=>'success',
                'status'=>200
            ]);
        }
        else {
            $this->dispatchBrowserEvent('message',[
                'text'=>'something went wrong',
                'type'=>'error',
                'status'=>400
            ]);
        }
    }

    public function removeCartItem($cartId){
        $cartData=Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->delete();
        $this->emit('cartAddedOrUpdated');
        $this->dispatchBrowserEvent('message',[
            'text'=>'product removed from cart',
            'type'=>'success',
            'status'=>200
        ]);
    }

    public function render()
    {
        $this->cart=Cart::where('user_id',auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show',['cart'=>$this->cart]);
    }
}
