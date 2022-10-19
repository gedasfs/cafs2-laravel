@extends('layouts.shop')

@section('title', 'Products')

@section('content')
@include('products.partials.filter')
<h2>Products</h2>
<div class="list-group">
    @foreach ($products as $prod)
    <a href="{{ route('products.show', $prod->id) }}" class="list-group-item list-group-item-action" aria-current="true">
        <small># {{ $prod->id }}</small>
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ $prod->name }}</h5>
            <small>€ {{ $prod->price }}</small>
        </div>
        <p class="mb-1">{{ $prod->description }}</p>
    </a>
    @endforeach
</div>
@endsection
