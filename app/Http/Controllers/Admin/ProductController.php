<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function index(){
        $products=Products::paginate(2);
        return view('admin.product.index',compact('products'));
    }
    public function create(){
        $categories=Category::all();
        return view('admin.product.create',compact('categories'));
    }

    public function store(ProductFormRequest $request){
        // dd($request->all());
        $validatedData=$request->validated();
        $category=Category::find($validatedData['category_id']);
       
        $product=$category->products()->create([
            'category_id'=>$validatedData['category_id'],
            'name'=>$validatedData['name'],
            'original_price'=>$validatedData['original_price'],
            'selling_price'=>$validatedData['selling_price'],
            'qty'=>$validatedData['qty'],
            'brand'=>$request['brand'],
            'description'=>$request['description'],
            'status'=>$request->status==true ? '1':'0'
        ]);
        if($request->hasFile('image')){
            $uploadPath='uploads/products/';
            $i=1;
            foreach($request->file('image') as $imageFile){
                $ext=$imageFile->getClientOriginalExtension();
                $filename=time().$i++.'.'.$ext;
                $imageFile->move($uploadPath,$filename);
                $filenamefordb=$uploadPath.$filename;
                $product->productImages()->create([
                   'product_id'=>$product->id,
                   'image'=>$filenamefordb 
                ]);
            }
        }
        return redirect('/admin/product/view')->with('message','product added');
    }

    public function delete($id){
        $product=Products::find($id);
        if($product->productImages){
            foreach($product->productImages as $images){
                if(File::exists($images->image))
                    File::delete($images->image);
            }
        }
        $product->delete();
        return redirect('/admin/product/view')->with('message','product deleted');
    }
   public function edit($id){
        $categories=Category::all();
        $product=Products::find($id);
        return view('admin.product.edit',compact('categories','product'));
   }

   public function destroy($id){
        $productimage=ProductImages::find($id);
        if(File::exists($productimage->image))
        File::delete($productimage->image);
        $productimage->delete();
        return redirect()->back()->with('message','product image deleted');
    }

    public function update($id,ProductFormRequest $request){
        $validatedData=$request->validated();
        $product=Products::where('id',$id)->first();
        if($product){
            $product->update([
                'category_id'=>$validatedData['category_id'],
                'name'=>$validatedData['name'],
                'original_price'=>$validatedData['original_price'],
                'selling_price'=>$validatedData['selling_price'],
                'qty'=>$validatedData['qty'],
                'brand'=>$request['brand'],
                'description'=>$request['description'],
                'status'=>$request->status==true ? '1':'0'
            ]);
        }
            if($request->hasFile('image')){
                $uploadPath='uploads/products/';
                $i=1;
                foreach($request->file('image') as $imageFile){
                    $ext=$imageFile->getClientOriginalExtension();
                    $filename=time().$i++.'.'.$ext;
                    $imageFile->move($uploadPath,$filename);
                    $filenamefordb=$uploadPath.$filename;
                    $product->productImages()->create([
                       'product_id'=>$product->id,
                       'image'=>$filenamefordb 
                    ]);
                }
            }

        return redirect('/admin/product/view')->with('message','product added');
    }

}
       
