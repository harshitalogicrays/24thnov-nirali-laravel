<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $totalOrders=Order::count();
        $totalProducts=Products::count();
        $totalUsers=User::count();
        $totalDelivered= Order::where('status_message','delivered')->count();
        $thisMonth=Carbon::now()->format('m');
        $monthOrder=Order::whereMonth('created_at',$thisMonth)->count();
        return view('admin.dashboard',compact('totalOrders','totalProducts','totalUsers','totalDelivered','monthOrder'));
    }
}
