@extends('layouts.app')
@section('content')
    <h1>Edit Product</h1>
    <form action="{{route('products.update', ['product' => $product->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <label for="name">Item Name</label>
            <input type="text" id="name" name="name" value="{{old('name') ?? $product->name}}" class="form-control">
        </div>
        <div class="form-row">
            <label for="description">Item Description</label>
            <input type="text" id="description" name="description" value="{{ old('description') ?? $product->description}}" class="form-control">
        </div>
        <div class="form-row">
            <label for="price">Item Price</label>
            <input type="number" min="1.00" step="0.01" id="price" name="price" value="{{ old('price') ?? number_format( $product->price, 2)}}" class="form-control">
        </div>
        <div class="form-row">
            <label for="stock">Stock</label>
            <input type="number" min="0" id="stock" name="stock" value="{{ old('stock') ?? $product->stock}}" class="form-control">
        </div>
        <div class="form-row">
            <label for="status">Status</label>
            <select class="custom-select" name="status" id="status">
                <option value="available" {{ old('status') == 'available' ? 'selected' : ($product->status == 'available' ? 'selected' : '')}} >Available</option>
                <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : ($product->status == 'unavailable' ? 'selected' : '') }}>Unavailable</option>
            </select>
        </div>
        <div class="form-row">
            <label>{{ __('Product Images') }}</label>

            <div class="custom-file">
                <input type="file" name="images[]" accept="images/*" class="custom-file-input" multiple>
                <label class="custom-file-label">
                    Product Images...
                </label>
            </div>

        </div>
        <div class="form-row">
            <button class="btn btn-primary btn-lg mt-3" type="submit">Edit Product</button>
        </div>
    </form>
@endsection

