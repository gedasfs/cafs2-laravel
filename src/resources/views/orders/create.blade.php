@extends('layouts.shop')

@section('title', 'Orders - Create')

@section('content')
    <h1>Create Order</h1>

    <label for="productSelect" class="form-label">Please select a product to add it to cart:</label>
    <div class="input-group mb-3">
        <select class="form-select @error('category_id') is-invalid @enderror" aria-label="category_id" id="productSelect">
            <option value="0">Select Product</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->price }} €</option>
            @endforeach
        </select>
        <button class="btn btn-outline-primary" type="button" id="btnAddProduct">Add Product</button>
    </div>


    <form action="{{ route('orders.store') }}" method="POST" id="orderForm" class="d-none">
        @csrf
        <ul class="list-group">
            <li class="list-group-item d-flex align-items-center bg-light">
                <div class="row w-100 fw-bold">
                    <div class="col-4 ms-2">Product name</div>
                    <div class="col-3 ms-3">Price €</div>
                    <div class="col-3 ms-3">Qty</div>
                </div>
            </li>
        </ul>
        <ol class="list-group list-group-numbered">
        </ol>
        <button type="submit" class="btn btn-primary mt-3 float-end">Submit</button>
    </form>
    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <span class="invalid-feedback d-block">
                    <strong>{{ $error }}</strong>
                </span>
            @endforeach
        </div>
    @endif

@endsection
