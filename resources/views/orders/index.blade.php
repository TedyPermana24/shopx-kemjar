@extends('layouts.app')

@section('title', 'My Orders')

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
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">My Orders</h5>
                </div>
                <div class="card-body">
                    @if($orders->isEmpty())
                        <div class="alert alert-info">
                            <p class="mb-0">You haven't placed any orders yet.</p>
                        </div>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-basket me-2"></i> Browse Products
                        </a>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>${{ number_format($order->total_amount, 2) }}</td>
                                            <td>
                                                <span class="badge bg-{{ 
                                                    $order->status === 'completed' ? 'success' : 
                                                    ($order->status === 'cancelled' ? 'danger' : 
                                                    ($order->status === 'processing' ? 'warning' : 'info')) 
                                                }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection