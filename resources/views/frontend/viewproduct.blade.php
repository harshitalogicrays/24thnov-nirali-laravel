@extends('layouts.app')
@section('content')
    <livewire:frontend.viewproduct :category="$category" :product="$product"/>
@endsection