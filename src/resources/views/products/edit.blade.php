@extends('layouts.shop')

@section('title', 'Products - Edit')

@section('content')
@include('products.partials.productForm', [
    'route' => route('products.update', $product->id),
    'name' => $product->name,
    'code' => $product->code,
    'description' => $product->description,
    'price' => $product->price,
    'categoryId' => $product->category_id
])
@endsection
