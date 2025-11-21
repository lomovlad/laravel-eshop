<?php

namespace App\Helpers\Cart;

use App\Models\Product;

class Cart
{
    // add product
    public static function add2Cart(int $productId, int $quantity = 1): bool
    {
        $added = false;

        if (self::hasProductInCart($productId)) {
            session(["cart.{$productId}.quantity" => session("cart.{$productId}.quantity") + $quantity]);
            $added = true;
        } else {
            $product = Product::find($productId);

            if ($product) {
                $newProduct = [
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'image' => $product->image,
                    'price' => $product->price,
                    'quantity' => $quantity,
                ];
                session(["cart.{$productId}" => $newProduct]);
                $added = true;
            }
        }

        return $added;
    }
    // remove product from cart
    // get cart
    public static function getCart(): array
    {
        return session('cart') ?: [];
    }

    // clear cart
    // get cart total sum
    // get cart items
    public static function getCartQuantityItems(): int
    {
        return count(self::getCart());
    }
    // get cart quantity
    public static function getCartQuantityTotal(): int
    {
        $cart = self::getCart();

        return array_sum(array_column($cart, 'quantity'));
    }
// has prosuct in cart
    public static function hasProductInCart(int $productId): bool
    {
        return session()->has("cart.$productId");
    }
// update item quantity


}
