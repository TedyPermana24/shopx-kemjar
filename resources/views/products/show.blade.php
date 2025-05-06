@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-5">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
            @else
                <img src="https://via.placeholder.com/600x400?text=No+Image" class="img-fluid rounded" alt="No Image">
            @endif
        </div>
        <div class="col-md-7">
            <h1>{{ $product->name }}</h1>
            <p class="text-muted">Category: {{ $product->category->name }}</p>
            <hr>
            <p class="fs-4 fw-bold">${{ number_format($product->price, 2) }}</p>
            <p class="mb-4">{{ $product->description }}</p>
            
            <div class="d-flex align-items-center mb-4">
                <span class="me-3">Availability:</span>
                <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }} p-2">
                    {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                </span>
            </div>

            @if($product->stock > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST" class="d-flex align-items-center">
                    @csrf
                    <div class="input-group me-3" style="width: 130px;">
                        <span class="input-group-text">Qty</span>
                        <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                    </button>
                </form>
            @else
                <button class="btn btn-secondary" disabled>Out of Stock</button>
            @endif
        </div>
    </div>
@endsection