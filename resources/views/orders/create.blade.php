@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <h1>Checkout</h1>
    <hr>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $id => $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if(isset($item['image']))
                                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="img-thumbnail me-3" style="width: 60px;">
                                                @else
                                                    <img src="https://via.placeholder.com/60?text=No+Image" alt="No Image" class="img-thumbnail me-3" style="width: 60px;">
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $item['name'] }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>${{ number_format($item['price'], 2) }}</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td><strong>${{ number_format($total, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Shipping Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->phone }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" rows="3" readonly>{{ auth()->user()->address }}</textarea>
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i> To update your shipping information, please update your profile first.
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Payment Method</h5>
                </div>
                <div class="card-body">
                    @if($paymentMethods->isEmpty())
                        <div class="alert alert-warning">
                            <p class="mb-0">You don't have any payment methods yet.</p>
                        </div>
                        <a href="{{ route('payment-methods.create') }}" class="btn btn-primary w-100">
                            <i class="fas fa-plus me-2"></i> Add Payment Method
                        </a>
                    @else
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                @foreach($paymentMethods as $method)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="payment_method_id" id="payment_method_{{ $method->id }}" value="{{ $method->id }}" {{ $method->is_default ? 'checked' : '' }}>
                                        <label class="form-check-label" for="payment_method_{{ $method->id }}">
                                            <i class="fas fa-credit-card me-2"></i> 
                                            **** **** **** {{ substr($method->card_number, -4) }}
                                            <br>
                                            <small class="text-muted">{{ $method->card_holder }} | Exp: {{ $method->expiry_date }}</small>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="alert alert-info">
                                <i class="fas fa-lock me-2"></i> Your payment information is encrypted using AES-256 encryption for maximum security.
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-lock me-2"></i> Place Order
                                </button>
                                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Back to Cart
                                </a>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Order Total</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping:</span>
                        <span>Free</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total:</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection