@extends('layouts.admin')
@section('content')
@if (session('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif
  <div class="card">
    <div class="card-header">
        <h1>Add Product
            <a class="btn btn-danger float-end" href="{{url('/admin/product/view')}}" >view Products</a>            
        </h1>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="{{url('/admin/product/add')}}">
                @csrf
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">details</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images-tab-pane" type="button" role="tab" aria-controls="images-tab-pane" aria-selected="false">images</button>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Category</label>
                                <select
                                    class="form-select"  name="category_id" >
                                    <option selected value=''>Select one</option>
                                    @foreach ($categories as $c )
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name"  class="form-control" placeholder=""
                        />
                        </div>
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                        <div class="mb-3">
                            <label for="" class="form-label">Brand</label>
                            <input type="text" name="brand"  class="form-control" placeholder=""
                        />
                        </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label">original price</label>
                                <input type="number" name="original_price"  class="form-control" placeholder=""
                        />
                        </div>
                        @error('original_price')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                        <div class="mb-3">
                            <label for="" class="form-label">selling price</label>
                            <input type="number" name="selling_price"  class="form-control" placeholder=""
                        />
                        </div>
                        @error('selling_price')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                        <div class="mb-3">
                            <label for="" class="form-label">stock</label>
                            <input type="number" name="qty"  class="form-control" placeholder=""
                        />
                        </div>
                        @error('qty')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                        <div class="mb-3">
                            <label>Status</label>
                            <input type="checkbox" name="status"/>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="images-tab-pane" role="tabpanel" aria-labelledby="images-tab" tabindex="0">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Upload Images</label>
                                <input type="file" class="form-control"name="image[]" multiple />
                            </div>
                            <button type="submit" class="btn btn-primary" > Submit </button>
                            
                        </div>
                    </div>
                </div>
              </div>    
            </form>
    </div>
  </div>
  
@endsection