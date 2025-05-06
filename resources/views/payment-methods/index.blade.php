@extends('layouts.app')

@section('title', 'Payment Methods')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Account</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('profile') }}" class="list-group-item list-group-item-action">Profile</a>
                    <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action">My Orders</a>
                    <a href="{{ route('payment-methods.index') }}" class="list-group-item list-group-item-action active">Payment Methods</a>
                    <a href="{{ route('profile.change-password') }}" class="list-group-item list-group-item-action">Change Password</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Payment Methods</h5>
                    <a href="{{ route('payment-methods.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus me-1"></i> Add New
                    </a>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-lock me-2"></i> Your payment information is encrypted using AES-256 encryption for maximum security.
                    </div>

                    @if($paymentMethods->isEmpty())
                        <div class="alert alert-warning">
                            <p class="mb-0">You don't have any payment methods yet.</p>
                        </div>
                    @else
                        <div class="row">
                            @foreach($paymentMethods as $method)
                                <div class="col-md-6 mb-4">
                                    <div class="card {{ $method->is_default ? 'border-primary' : '' }}">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="card-title mb-0">
                                                    <i class="fas fa-credit-card me-2"></i> 
                                                    **** **** **** {{ substr($method->card_number, -4) }}
                                                </h5>
                                                @if($method->is_default)
                                                    <span class="badge bg-primary">Default</span>
                                                @endif
                                            </div>
                                            <p class="card-text">{{ $method->card_holder }}</p>
                                            <p class="card-text">Expires: {{ $method->expiry_date }}</p>
                                            <div class="d-flex justify-content-between mt-3">
                                                @if(!$method->is_default)
                                                    <form action="{{ route('payment-methods.default', $method) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-outline-primary">Set as Default</button>
                                                    </form>
                                                @else
                                                    <div></div>
                                                @endif
                                                <form action="{{ route('payment-methods.destroy', $method) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to remove this payment method?')">
                                                        <i class="fas fa-trash me-1"></i> Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection