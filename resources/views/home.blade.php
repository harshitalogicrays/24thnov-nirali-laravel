@extends('layouts.app')

@section('content')
{{-- <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                   

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="container col-6 mt-2">
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
    </div>
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($sliders as $k=>$s)
        <div class="carousel-item {{$k=='0' ? 'active':''}}">
            <img src="{{asset($s->image)}}" class="d-block w-100" alt="{{$s->title}}"
            height='400px'>
            <div class="carousel-caption d-none d-md-block">
                <h5>{{$s->title}}</h5>
                <p>{{$s->description}}</p>
              </div>
          </div>
        @endforeach
    
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
<div class="container">
  <div class="row mt-5">
    <h1 class="text-center">------------------Categories-------------</h1> <hr/>
            @forelse ($categories as $c)
            <div class="col-3">
                <div class="card">
                    <img src="{{asset($c->image)}}" class="card-img-top" height='200px'>
                    <div class="card-body">
                        <h5 class="card-title">{{$c->name}}</h5>
                    </div>
                </div>
            </div>
            @empty
                <h1>No Category Found</h1>
            @endforelse
          
        
    </div>
  </div>
@endsection
