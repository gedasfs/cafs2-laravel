@extends('layouts.shop')

@section('title', 'Products - Edit')

@section('content')
@include('products.partials.productForm', [
    'route' => route('products.store'),
])
@endsection
