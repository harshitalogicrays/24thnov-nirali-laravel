@extends('layouts.admin')
@section('content')
@if (session('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif
    <h1>!! Welcome Admin!!</h1>
    <div class="row">
        <div class="col-4 mb-3">
            <div class="card text-center p-3 bg-info">
                <h3>Total Orders</h3>
                <p>{{$totalOrders}}</p>
                <a class="btn btn-danger" href="{{'orders'}}">View</a >
                
            </div>
        </div>
        <div class="col-4 mb-3">
            <div class="card text-center p-3 bg-success">
                <h3>Total Products</h3>
                <p>{{$totalProducts}}</p>
                <a class="btn btn-warning" href="{{'product/view'}}">View</a >
                
            </div>
        </div>
        <div class="col-4 mb-3">
            <div class="card text-center p-3 bg-danger">
                <h3>Total Users</h3>
                <p>{{$totalUsers}}</p>
                <a class="btn btn-primary" href="{{'dashboard'}}">View</a >
            </div>
        </div>
        <div class="col-4 mb-3">
            <div class="card text-center p-3 bg-success">
                <h3>Delivered Orders</h3>
                <p>{{$totalDelivered}}</p>
                <a class="btn btn-warning" href="{{'orders'}}">View</a >
                
            </div>
        </div>

        <div class="col-4 mb-3">
            <div class="card text-center p-3 bg-danger">
                <h3>Month Order</h3>
                <p>{{$monthOrder}}</p>
                <a class="btn btn-primary" href="{{'orders'}}">View</a >
            </div>
        </div>
    </div>
@endsection