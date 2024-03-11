@extends('layouts.admin')
@section('content')
@if (session('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif
  <div class="card">
    <div class="card-header">
        <h1>All Categories
            <a class="btn btn-primary float-end" href="{{url('/admin/category/add')}}" >Add Category</a>
            
        </h1>
        </div>
            <div class="card-body">
            <div  class="table-responsive"
            >
                <table
                    class="table table-primary"
                >
                    <thead>
                        <tr>
                            <th scope="col">ID </th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Descripton</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $c)
                        <tr class="">
                            <td scope="row">{{$c->id}}</td>
                            <td>{{$c->name}}</td>
                            <td>                                
                                <img src="{{asset($c->image)}}"  height='50px' width='50px'/></td>
                            <td>{{$c->description}}</td>
                            <td>
                                @if ($c->status=='1')
                                    <span class="badge rounded-pill text-bg-success">active</span>
                                                                       
                                @else
                                <span class="badge rounded-pill text-bg-danger">inactive</span>
                                    
                                @endif
                            </td>
                            <td>
                                <a name="" class="btn btn-success me-2" href="{{url('/admin/category/edit/'.$c->id)}}">
                                <i class="bi bi-pencil-square"></i></a>

                                <a name="" class="btn btn-danger" href="{{url('/admin/category/delete/'.$c->id)}}"
                                    onclick="return window.confirm('are you sure want to delete this??')">
                                    <i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        @empty
                           <tr><td colspan="6">no category found</td></tr> 
                        @endforelse
                       
                    </tbody>
                </table>
            </div>
        {{$categories->links('pagination::bootstrap-5')}}
    </div>
  </div>
  
@endsection