<?php

namespace App\Http\Controllers\Orders;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function edit()
    {
        return view('orders.edit');
    }

    public function show()
    {
        return view('orders.show');
    }
}
