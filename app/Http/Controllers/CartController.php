<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');
    }

    /**
     * Update the cart.
     */
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);

        if ($request->has('quantity')) {
            foreach ($request->quantity as $productId => $quantity) {
                if (isset($cart[$productId])) {
                    $cart[$productId]['quantity'] = $quantity;
                }
            }
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
        }


        return redirect()->route('cart.index')->with('error', 'Unable to update cart.');
    }

    /**
     * Remove a product from the cart.
     */
    public function remove($product)
    {
        $cart = session()->get('cart', []);

        // Check if the product exists in the cart
        if (isset($cart[$product])) {
            unset($cart[$product]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully.');
        }

        return redirect()->route('cart.index')->with('error', 'Product not found in cart.');
    }

    /**
     * Clear the cart.
     */
    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');
    }
}
