@extends('layouts.shop')

@section('title', 'Order')

@section('content')
    <div class="d-flex justify-content-between align-items-center my-3">
        <h3 class="">Order No.: {{ $order->number }}</h3>
        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary">Edit</a>
    </div>

    <ul class="list-group">
        <li class="list-group-item d-flex bg-light">
            <div class="row w-100">
                <div class="col-4 ms-4 fw-bold">Product</div>
                <div class="col-2 fw-bold d-none d-md-block">Price €</div>
                <div class="col-2 fw-bold">Qty</div>
                <div class="col-3 fw-bold">Total €</div>
            </div>
        </li>
    </ul>

    <ol class="list-group list-group-numbered">
        @foreach ($lineItems as $item)
        <li class="list-group-item d-flex">
            <div class="row w-100">
                <div class="col-4 ms-2">
                    <div class="fw-bold">{{ $item['product']->name }}</div>
                    <small>({{ $item['product']->code }})</small>
                </div>
                <div class="col-2 d-none d-md-block">{{ $item['product']->price }}</div>
                <div class="col-2">{{ $item['qty'] }}</div>
                <div class="col-3 ms-1">{{ $item['product']->price * $item['qty'] }}</div>
            </div>
        </li>
        @endforeach
    </ol>

    <div>
        <ul class="list-group">
            <li class="list-group-item d-flex bg-light">
                <div class="row w-100">
                    <div class="col-6 col-md-8 fw-bold text-end">Total:</div>
                    <div class="col-3 fw-bold ms-4">{{ $order->total_for_items }}</div>
                </div>
            </li>
        </ul>
    </div>
@endsection
