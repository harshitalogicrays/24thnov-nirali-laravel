<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartCount extends Component
{
    public $count;
    public $listeners=['cartAddedOrUpdated'=>'checkCartCount'];

    public function checkCartCount(){
        if(Auth::check()){
            return $this->count=Cart::where('user_id',auth()->user()->id)->count();
        }
          else return $this->count=0;
    }

    public function render()
    {   $this->count=$this->checkCartCount();
        return view('livewire.frontend.cart.cart-count',['count'=>$this->count]);
    }
}
