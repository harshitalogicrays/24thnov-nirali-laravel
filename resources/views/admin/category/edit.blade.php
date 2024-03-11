@extends('layouts.admin')
@section('content')
@if (session('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif
  <div class="card">
    <div class="card-header">
        <h1>Edit Category
            <a class="btn btn-danger float-end" href="{{url('/admin/category/view')}}" >view Categories</a>
            
        </h1>
        </div>
            <div class="card-body">
                <form method="POST" action="{{url('/admin/category/update/'.$category->id)}}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{$category->name}}"/>
                    @error('name')
                            <small  id="helpId" class="text-danger">{{$message}}</small>
                                                
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Choose file</label>
                    <input type="file" name="image" class="form-control"/>
                </div>
                @if ($category->image)
                      <img src="{{asset($category->image)}}" class="mb-3" width='50' height='50px'>
                @endif
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                   <textarea class="form-control" name="description" rows="3">{{$category->description}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Status</label>
                    <input class="form-check-input" type="checkbox"  name="status" value="1" {{$category->status=='1'?'checked':''}}/>
                </div>
                <button type="submit" class="btn btn-primary">submit</button>
         </form>
        
    </div>
  </div>
  
@endsection