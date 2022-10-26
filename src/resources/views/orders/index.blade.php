@extends('layouts.shop')

@section('title', 'Orders')

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h2>Orders</h2>
    <a href="{{ route('orders.create') }}" class="btn btn-success">Create</a>
</div>

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
