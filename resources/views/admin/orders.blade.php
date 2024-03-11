@extends('layouts.admin')
@section('content')
<div class="container mt-5">
    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body shadow p-4 bg-white">
            <h1>Orders</h1>
                <hr/>
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Tracking No</th>
                            <th scope="col">Username</th>
                            <th scope="col">Payment mode</th>
                            <th scope="col">Ordered Date</th>
                            <th scope="col">Status Message</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $item)
                        <tr class="">
                            <td>{{$item->id}}</td>
                            <td>{{$item->tracking_no}}</td>
                            <td>{{$item->fullname}}</td>
                            <td>{{$item->payment_mode}}</td>
                            <td>{{$item->created_at->format('d-M-Y')}}</td>
                            <td>
                             <span class="{{$item->status_message != 'delivered' ? 'text-danger':'text-success'}}">   
                                {{$item->status_message}}</span>
                            </td>
                            <td>
                                <a name="" id="" class="btn btn-primary" href="{{url('/admin/avieworder/'.$item->id)}}" role="button"  >view</a>
                            </td>
                        </tr>
                        @empty
                            <tr><td colspan="7">No Orders Found</td></tr>
                        @endforelse
                        
                    </tbody>
                </table>
                </div>
                {{$orders->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
@endsection