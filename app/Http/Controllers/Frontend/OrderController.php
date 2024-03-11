<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function myorders(){
        $orders=Order::where('user_id',auth()->user()->id)->paginate(2);
        return view('frontend.myorders',compact('orders'));
    }
    public function vieworder($orderid){
        $order=Order::where('user_id',auth()->user()->id)->where('id',$orderid)->first();
        return view('frontend.vieworder',compact('order'));
    }
}
