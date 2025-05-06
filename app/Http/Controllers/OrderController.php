<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = auth()->user()->orders()->orderBy('created_at', 'desc')->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $paymentMethods = auth()->user()->paymentMethods;
        $defaultPaymentMethod = $paymentMethods->where('is_default', true)->first();

        return view('orders.create', compact('cart', 'total', 'paymentMethods', 'defaultPaymentMethod'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
        ]);

        // Check if the payment method belongs to the authenticated user
        $paymentMethod = auth()->user()->paymentMethods()->findOrFail($validated['payment_method_id']);

        // Calculate total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $total,
            'status' => 'pending',
            'payment_method_id' => $paymentMethod->id,
        ]);

        // Create order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            // Update product stock
            $product = Product::find($item['id']);
            $product->stock -= $item['quantity'];
            $product->save();
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully.');
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        // Check if the order belongs to the authenticated user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }
}