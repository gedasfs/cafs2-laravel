<?php

namespace App\Services\Cart;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class CartService
{
    public function createCart(Request $request, User $user) : Cart
    {
        $productIds = $request->only('products');
        $productQtys = $request->only('qtys');

        $count = count($productIds['products']);

        $cartContent = [];
        $totalForItems = 0;

        for ($i = 0; $i < $count; $i++) {
            $productId = $productIds['products'][$i];
            $productQty = $productQtys['qtys'][$i];

            $product = Product::find($productId);
            $productPrice = $product->price;

            $cartContent[$i] = [
                'product_id' => $productId,
                'qty' => $productQty,
            ];

            $totalForItems += $productPrice * $productQty;
        }

        $cartContentJson = json_encode($cartContent);

        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->cart_content = $cartContentJson;
        $cart->total_for_items = $totalForItems;

        $cart->save();

        return $cart;
    }

    public function getCartContent(Cart $cart) : Array
    {
        $cartContent = json_decode($cart->cart_content, true);

        $lineItems = [];

        foreach ($cartContent as $line) {
            $lineItems[] = [
                'product' => Product::find($line['product_id']),
                'qty' => $line['qty'],
            ];
        }

        return $lineItems;
    }
}
