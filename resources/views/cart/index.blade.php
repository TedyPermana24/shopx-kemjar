@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
    <h1>Shopping Cart</h1>
    <hr>

    @if (count($cart) > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $id => $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if (isset($item['image']))
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                            class="img-thumbnail me-3" style="width: 80px;">
                                    @else
                                        <img src="https://via.placeholder.com/80?text=No+Image" alt="No Image"
                                            class="img-thumbnail me-3" style="width: 80px;">
                                    @endif
                                    <div>
                                        <h5 class="mb-0">{{ $item['name'] }}</h5>
                                    </div>
                                </div>
                            </td>
                            <td>${{ number_format($item['price'], 2) }}</td>
                            <td>
                                <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <div class="input-group" style="width: 120px;">
                                        <input type="number" name="quantity[{{ $id }}]" class="form-control"
                                            value="{{ $item['quantity'] }}" min="1">
                                        <button type="submit" class="btn btn-outline-secondary">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                            <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', ['product' => $id]) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Total:</td>
                        <td colspan="2" class="fw-bold">${{ number_format($total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <div>
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                </a>
                <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger ms-2">
                        <i class="fas fa-trash me-2"></i> Clear Cart
                    </button>
                </form>
            </div>
            <div>
                @auth
                    <a href="{{ route('orders.create') }}" class="btn btn-primary">
                        <i class="fas fa-shopping-bag me-2"></i> Proceed to Checkout
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt me-2"></i> Login to Checkout
                    </a>
                @endauth
            </div>
        </div>
    @else
        <div class="alert alert-info">
            <p class="mb-0">Your cart is empty.</p>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-primary">
            <i class="fas fa-shopping-basket me-2"></i> Browse Products
        </a>
    @endif
@endsection
