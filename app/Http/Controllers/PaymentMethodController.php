<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the payment methods.
     */
    public function index()
    {
        $paymentMethods = auth()->user()->paymentMethods;

        return view('payment-methods.index', compact('paymentMethods'));
    }

    /**
     * Show the form for creating a new payment method.
     */
    public function create()
    {
        return view('payment-methods.create');
    }

    /**
     * Store a newly created payment method in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'card_number' => ['required', 'string', 'max:19'],
            'card_holder' => ['required', 'string', 'max:255'],
            'expiry_date' => ['required', 'string', 'max:7'],
            'cvv' => ['required', 'string', 'max:4'],
            'is_default' => ['boolean'],
        ]);

        $user = auth()->user();

        // If this is the first payment method or is_default is true, set all other payment methods to not default
        if ($request->has('is_default') && $request->is_default) {
            $user->paymentMethods()->update(['is_default' => false]);
        }

        $user->paymentMethods()->create($validated);

        return redirect()->route('payment-methods.index')->with('success', 'Payment method added successfully.');
    }

    /**
     * Remove the specified payment method from storage.
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        // Check if the payment method belongs to the authenticated user
        if ($paymentMethod->user_id !== auth()->id()) {
            abort(403);
        }

        $paymentMethod->delete();

        return redirect()->route('payment-methods.index')->with('success', 'Payment method removed successfully.');
    }

    /**
     * Set the specified payment method as default.
     */
    public function setDefault(PaymentMethod $paymentMethod)
    {
        // Check if the payment method belongs to the authenticated user
        if ($paymentMethod->user_id !== auth()->id()) {
            abort(403);
        }

        // Set all payment methods to not default
        auth()->user()->paymentMethods()->update(['is_default' => false]);

        // Set the specified payment method as default
        $paymentMethod->update(['is_default' => true]);

        return redirect()->route('payment-methods.index')->with('success', 'Default payment method updated successfully.');
    }
}