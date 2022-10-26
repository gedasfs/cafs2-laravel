<?php

namespace App\Http\Controllers\Orders;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\UserPaymentType;
use App\Http\Controllers\Controller;
use App\Services\Order\OrderService;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Orders\StoreOrderRequest;
use App\Services\Cart\CartService;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();

        return view('orders.create', compact('products'));
    }

    public function edit()
    {
        return view('orders.edit');
    }

    public function show(Order $order, CartService $cartService)
    {
        $cart = $order->cart;

        $lineItems = $cartService->getCartContent($cart);

        return view('orders.show', compact('order', 'lineItems'));
    }

    public function store(StoreOrderRequest $request, OrderService $orderService, CartService $cartService)
    {
        // Get current user
        $userId = 11;
        $user = User::find($userId);

        $cart = $cartService->createCart($request, $user);

        $order = $orderService->createOrder($cart, $user);

        return redirect()->route('orders.show', $order->id);
    }
}
