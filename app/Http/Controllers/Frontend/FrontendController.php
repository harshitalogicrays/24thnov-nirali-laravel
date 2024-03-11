<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class FrontendController extends Controller
{
    public function index(){
        $sliders=Slider::where('status','1')->get();
        $categories=Category::where('status','1')->get();
        return view('frontend.index',compact('sliders','categories'));
    }

    public function cproducts($cname){
       $category=Category::where('name',$cname)->first();
       if($category){
           $products = $category->products()->where('status','1')->get();
           return view('frontend.cproducts',compact('category','products')); }
       else return redirect('/');
    //    return redirect()->back();
    }

    public function viewproduct($category,$product){
        $category=Category::where('name',$category)->first();
        if($category){
           $product=$category->products()->where('name',$product)->where('status','1')->first();
            if($product){
                return view('frontend.viewproduct',compact('category','product'));
            }
            else return redirect()->back();
        }
        
    }

    public function searchproduct(Request $request){
        if($request->search!=null){
            $products=Products::where('name','LIKE','%'.$request->search.'%')->latest()->paginate(5);
            return view('frontend.search',compact('products'));
        }
        else {
            $products=Products::paginate(5);
            return view('frontend.search',compact('products'));
        }
    }

    public function profile(){
        return view('frontend.profile');
    }
    public function saveprofile(Request $request){
        $validated=$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone'=>'required|string|min:10|max:10',
            'pincode'=>'required|string|min:6|max:6',
            'address'=>'required|string|max:500',
        ]);
        $user=User::find(Auth()->user()->id);
        $user->update(['name'=>$request->name]);
        $user->userDetail()->updateOrcreate(
            [],
            [
               'user_id'=> $user->id,
               'phone'=>$request->phone,
               'pincode'=>$request->pincode,
               'address'=>$request->address
            ]
        );
        return redirect()->back()->with('messge','profile updated');
    }

    public function changepassword(){
        return view('frontend.changepassword');
    }
    public function updatepassword(Request $request){
        $request->validate([
            'current_password'=>['required', 'string', 'min:8'],
            'password'=> ['required', 'string', 'min:8', 'confirmed']
        ]);
        $currentpasswordstatus=Hash::check($request->current_password, auth()->user()->password);
        if($currentpasswordstatus){
            User::find(auth()->user()->id)->update([
                'password'=>Hash::make($request->password)
            ]);
            return redirect()->back()->with('message','password updated');
        }
        else {
            return redirect()->back()->with('message','password does not match with old password');
        }
    }
}
