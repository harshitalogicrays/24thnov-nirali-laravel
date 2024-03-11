<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Viewproduct extends Component
{
    public $category,$product;
    public $qtyCount=1;
    public function mount($category,$product){
        $this->category=$category;$this->product=$product;
    }

    public function increaseQty(){
        if($this->qtyCount < $this->product->qty){
            $this->qtyCount++;
        }
    }
    public function decreaseQty(){
        if($this->qtyCount>1){  $this->qtyCount--;}
    }

    public function addToCart($productid){
        if(Auth::check()){
                if($this->product->where('id',$productid)->where('status','1')->exists()){
                    //add to cart table 
                    Cart::create([
                        'user_id'=>auth()->user()->id,
                        'product_id'=>$productid,
                        'quantity'=>$this->qtyCount
                    ]);
                    session()->flash('success_message', 'Item added to cart.');
                    $this->emit('cartAddedOrUpdated');
                    
                    $this->dispatchBrowserEvent('message',[
                        'text'=>'product added to cart',
                        'type'=>'success',
                        'status'=>200
                    ]);
                }
                else {
                    $this->dispatchBrowserEvent('message',[
                        'text'=>'product does not exists',
                        'type'=>'warning',
                        'status'=>401
                    ]);
                }
        }
        else {
            $this->dispatchBrowserEvent('message',[
                'text'=>'please login first',
                'type'=>'error',
                'status'=>400
            ]);
        }
    }

    public function render()
    {
        return view('livewire.frontend.viewproduct',['catgory'=>$this->category,'product'=>$this->product]);
    }
}
