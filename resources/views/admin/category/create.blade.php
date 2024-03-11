@extends('layouts.admin')
@section('content')
@if (session('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif
  <div class="card">
    <div class="card-header">
        <h1>Add Category
            <a class="btn btn-danger float-end" href="{{url('/admin/category/view')}}" >view Categories</a>
            
        </h1>
        </div>
            <div class="card-body">
                <form method="POST" action="{{url('/admin/category/add')}}"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control"/>
                    @error('name')
                            <small  id="helpId" class="text-danger">{{$message}}</small>
                                                
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Choose file</label>
                    <input type="file" name="image" class="form-control"/>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                   <textarea class="form-control" name="description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Status</label>
                    <input class="form-check-input" type="checkbox" value="1"  name="status"/>
                </div>
                <button type="submit" class="btn btn-primary">submit</button>
         </form>
        
    </div>
  </div>
  
@endsection