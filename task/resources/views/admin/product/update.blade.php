@extends('admin.layout.master')

@section('title', 'update product')

@section('layoutContent')
<div class="container">
    <h2>Edit Product</h2>
    <form action="{{ route('product.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}" required>
        </div>

        <div class="form-group">
            <label for="quantity_stock">Quantity</label>
            <input type="number" name="quantity_stock" class="form-control" value="{{ $product->quantity_stock }}"
                required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>
@endsection