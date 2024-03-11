@extends('layouts.admin')
@section('content')
@if (session('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif
  <div class="card">
    <div class="card-header">
        <h1>All Products
            <a class="btn btn-primary float-end" href="{{url('/admin/product/add')}}" >Add Product
            </a> </h1>
        </div>
            <div class="card-body">
            <div class="table-responsive mb-3" >
              <table class="table table-primary">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($products as $product)
                    <tr class="">
                      <td>{{$product->id}}</td>
                      <td>{{$product->category->name}}</td>
                      <td>{{$product->name}}</td>
                      <td><img src="{{asset($product->productImages[0]->image)}}" height='50px' width='50px'/></td>
                      <td>{{$product->selling_price}}</td>
                      <td>
                        @if ($product->status=='1')
                          <span class="badge rounded-pill text-bg-success" >Active</span >
                          
                        @else
                        <span class="badge rounded-pill text-bg-danger" >InActive</span >
                        @endif
                      </td>
                      <td>
                        <a class="btn btn-success me-2"  href="{{url('/admin/product/edit/'.$product->id)}}"><i class="bi bi-pen"></i></a>
                        <a class="btn btn-danger" onclick="return window.confirm('are you sure to delete this??')"  href="{{url('admin/product/delete/'.$product->id)}}"><i class="bi bi-trash"></i></a>
                      </td>
                    </tr>
                  @empty
                    <tr><td colspan="7">No Product Found</td></tr>
                  @endforelse
                  
                </tbody>
              </table>
            </div>
            {{$products->links('pagination::bootstrap-5')}}
    </div>
   
  </div>
  
@endsection