@extends('layouts.app')
@section('content')
    <livewire:frontend.cproducts :products="$products" :category="$category"/>
@endsection