@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Products</h1>
        </div>
        <div class="col-md-4">
            <form action="{{ route('products.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search products..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">Search</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Categories</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="{{ route('products.index') }}" class="text-decoration-none {{ !request('category') ? 'fw-bold' : '' }}">All Categories</a>
                        </li>
                        @foreach($categories as $category)
                            <li class="list-group-item">
                                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="text-decoration-none {{ request('category') == $category->id ? 'fw-bold' : '' }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card product-card">
                            @if($product->image)
                                <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top" alt="No Image">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-truncate">{{ $product->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">${{ number_format($product->price, 2) }}</span>
                                    <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                        {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                                @if($product->stock > 0)
                                    <form action="{{ route('cart.add', $product) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">Add to Cart</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            No products found.
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection