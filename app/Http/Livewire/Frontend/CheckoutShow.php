<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class CheckoutShow extends Component
{
    public $totalAmount,$cartItems;
    public $fullname,$email,$phone,$pincode,$address;
    public $payment_mode,$payment_id=null;
    protected $listeners=['validationForAll','transactionEmit'=>'paidOnlineOrder'];

    public function mount(){
        $this->fullname=auth()->user()->name;
        $this->email=auth()->user()->email;
        $this->phone=auth()->user()->userDetail->phone ?? '';
        $this->address=auth()->user()->userDetail->address ?? '';
        $this->pincode=auth()->user()->userDetail->pincode ?? '';
    }

    public function rules(){
        return [
            'fullname'=>'required|string|max:200',
            'email'=>'required|email',
            'phone'=>'required|string|min:10|max:10',
            'pincode'=>'required|string|min:6|max:6',
            'address'=>'required|string|max:500',
        ];
    }

    public function placeOrder(){
        $this->validate();
        $order=Order::create([
            'user_id'=>auth()->user()->id,
            'tracking_no'=>Str::random(10),
            'fullname'=>$this->fullname,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'pincode'=>$this->pincode,
            'address'=>$this->address,
            'status_message'=>'in progress',
            'payment_mode'=>$this->payment_mode,
            'payment_id'=>$this->payment_id
        ]);
        foreach($this->cartItems as $cartItem){
            OrderItem::create([
                'order_id'=>$order->id,
                'product_id'=>$cartItem->product->id,
                'quantity'=>$cartItem->quantity,
                'price'=>$cartItem->product->selling_price
            ]);
        }
        return $order;
    }

    public function codorder(){
        $this->payment_mode="cod";
        $corder=$this->placeOrder();
        if($corder){
            Cart::where('user_id',auth()->user()->id)->delete();
            $this->emit('cartAddedOrUpdated');
            $this->dispatchBrowserEvent('message',[
                'text'=>'order placed',
                'type'=>'success',
                'status'=>200
            ]);
            return redirect()->to('thank-you');
        }
        else {
            $this->dispatchBrowserEvent('message',[
                'text'=>'something went wrong',
                'type'=>'error',
                'status'=>400
            ]);
        }
    }

public function validationForAll(){
    $this->validate();
}

public function paidOnlineOrder($id){
    $this->payment_mode="online";
    $this->payment_id=$id;
    $onlineorder=$this->placeOrder();
    if($onlineorder){
        Cart::where('user_id',auth()->user()->id)->delete();
        $this->emit('cartAddedOrUpdated');
        $this->dispatchBrowserEvent('message',[
            'text'=>'order placed',
            'type'=>'success',
            'status'=>200
        ]);
        return redirect()->to('thank-you');
    }
    else {
        $this->dispatchBrowserEvent('message',[
            'text'=>'something went wrong',
            'type'=>'error',
            'status'=>400
        ]);
    }
}

    public function totalCartAmount(){
        $this->totalAmount=0;
        $this->cartItems=Cart::where('user_id',auth()->user()->id)->get();
        foreach($this->cartItems as $cartItem){
                $this->totalAmount +=  ($cartItem->quantity * $cartItem->product->selling_price);
        }
        return $this->totalAmount;
    }
    public function render()
    {
        $this->totalAmount=$this->totalCartAmount();
        return view('livewire.frontend.checkout-show',['totalAmount'=>$this->totalAmount]);
    }
}
