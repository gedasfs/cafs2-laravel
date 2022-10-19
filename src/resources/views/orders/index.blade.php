@extends('layouts.shop')

@section('title', 'Orders')

@section('content')
<h2>Orders</h2>
<div class="list-group">
    @foreach ($orders as $order)
    <a href="{{ route('orders.show', $order->id) }}" class="list-group-item list-group-item-action" aria-current="true">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ $order->number }}</h5>
            <small></small>
        </div>
    </a>
    @endforeach
</div>
@endsection
