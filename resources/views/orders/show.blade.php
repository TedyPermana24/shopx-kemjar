@extends('layouts.app')

@section('title', 'Order #' . $order->id)

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Account</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('profile') }}" class="list-group-item list-group-item-action">Profile</a>
                    <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action active">My Orders</a>
                    <a href="{{ route('payment-methods.index') }}" class="list-group-item list-group-item-action">Payment Methods</a>
                    <a href="{{ route('profile.change-password') }}" class="list-group-item list-group-item-action">Change Password</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Order #{{ $order->id }}</h5>
                    <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to Orders
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Order Details</h6>
                            <p class="mb-1"><strong>Order ID:</strong> #{{ $order->id }}</p>
                            <p class="mb-1"><strong>Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
                            <p class="mb-1">
                                <strong>Status:</strong> 
                                <span class="badge bg-{{ 
                                    $order->status === 'completed' ? 'success' : 
                                    ($order->status === 'cancelled' ? 'danger' : 
                                    ($order->status === 'processing' ? 'warning' : 'info')) 
                                }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6>Payment Information</h6>
                            @if($order->paymentMethod)
                                <p class="mb-1"><strong>Payment Method:</strong> Credit Card</p>
                                <p class="mb-1"><strong>Card Number:</strong> **** **** **** {{ substr($order->paymentMethod->card_number, -4) }}</p>
                                <p class="mb-1"><strong>Card Holder:</strong> {{ $order->paymentMethod->card_holder }}</p>
                            @else
                                <p class="text-muted">Payment method information not available.</p>
                            @endif
                        </div>
                    </div>

                    <h6>Order Items</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item->product && $item->product->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="img-thumbnail me-3" style="width: 60px;">
                                                @else
                                                    <img src="https://via.placeholder.com/60?text=No+Image" alt="No Image" class="img-thumbnail me-3" style="width: 60px;">
                                                @endif
                                                <div>
                                                    @if($item->product)
                                                        <a href="{{ route('products.show', $item->product) }}" class="text-decoration-none">
                                                            {{ $item->product->name }}
                                                        </a>
                                                    @else
                                                        <span class="text-muted">Product no longer available</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>${{ number_format($item->price, 2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td><strong>${{ number_format($order->total_amount, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection