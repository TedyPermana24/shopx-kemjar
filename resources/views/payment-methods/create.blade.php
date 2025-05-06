@extends('layouts.app')

@section('title', 'Add Payment Method')

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
                <div class="card-header">
                    <h5 class="mb-0">Add Payment Method</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-lock me-2"></i> Your payment information is encrypted using AES-256 encryption for maximum security.
                    </div>

                    <form action="{{ route('payment-methods.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="card_number" class="form-label">Card Number</label>
                            <input type="text" class="form-control @error('card_number') is-invalid @enderror" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
                            @error('card_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="card_holder" class="form-label">Card Holder Name</label>
                            <input type="text" class="form-control @error('card_holder') is-invalid @enderror" id="card_holder" name="card_holder" placeholder="John Doe" required>
                            @error('card_holder')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="expiry_date" class="form-label">Expiry Date</label>
                                <input type="text" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
                                @error('expiry_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control @error('cvv') is-invalid @enderror" id="cvv" name="cvv" placeholder="123" required>
                                @error('cvv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_default" name="is_default" value="1">
                            <label class="form-check-label" for="is_default">Set as default payment method</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('payment-methods.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Payment Method</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection