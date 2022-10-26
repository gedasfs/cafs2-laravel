<?php

namespace App\Services\Order;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;


class OrderService
{
    public function createOrder(Cart $cart, User $user) : Order
    {
        // $userPaymentTypes =  UserPaymentType::where('user_id', $userId)->get();
        $userPaymentTypes =  $user->userPaymentType;
        $userPaymentTypeId = count($userPaymentTypes) != 0 ? $userPaymentTypes[0]->id : null;

        $order = new Order();

        $order->cart_id = $cart->id;
        $order->user_id = $user->id;
        $order->user_payment_type_id = $userPaymentTypeId;
        $order->number = fake()->numerify('order-####');
        $order->total_for_items = $cart->total_for_items;

        $shippingCost = 0;

        $order->total = $cart->total_for_items + $shippingCost;

        $order->save();

        return $order;
    }
}
