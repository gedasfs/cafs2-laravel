@extends('layouts.shop')

@section('title', 'Contact Us')

@section('content')
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="name" class="form-control" id="name">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" placeholder="name@example.com">
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Your message:</label>
        <textarea class="form-control" id="message" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary">Send</button>
    </div>
@endsection
