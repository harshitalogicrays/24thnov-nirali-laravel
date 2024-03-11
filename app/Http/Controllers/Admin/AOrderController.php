<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceOrderMailable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AOrderController extends Controller
{
    public function orders(){
        $orders=Order::paginate(2);
        return view('admin.orders',compact('orders'));
    }
    public function vieworder($orderid){
        $order=Order::where('id',$orderid)->first();
        return view('admin.vieworder',compact('order'));
    }
    

    public function viewinvoice($orderid){
        $order=Order::where('id',$orderid)->first();
        return view('admin.generate-invoice',compact('order'));
    }
    public function downloadinvoice($orderid){
        $order=Order::where('id',$orderid)->first();
        $data=['order'=>$order];
        $pdf = Pdf::loadView('admin.generate-invoice', $data);
        return $pdf->download('invoice'.$orderid.'.pdf');
    }

    public function sendmail($orderid){
        $order=Order::where('id',$orderid)->first();
        $data=['order'=>$order];
        $pdf = Pdf::loadView('admin.generate-invoice', $data);
        $data1['order']=$order;
        $data1['pdf']=$pdf;
        $data1['subject']=$order->status_message;
        try{
            Mail::to($order->email)->send(new InvoiceOrderMailable($data1));
            return redirect('admin/orders')->with('message','Invoice Mail Sent Successfully');
        }
        catch(\Exeception $e){
            return redirect('admin/orders')->with('message','something went wrong');
        }
    }

    public function updatestatus($orderid,Request $request){
        $order=Order::where('id',$orderid)->first();
        if($order){
            $order->update([
                'status_message'=>$request->order_status
            ]);
            return redirect('admin/orders')->with('message','order status updated ');
        }
    }
}
