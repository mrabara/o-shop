@extends('layouts.app')
@section('content')
    <h1>Add a Product</h1>
    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <label for="name">Item Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}">
        </div>
        <div class="form-row">
            <label for="description">Item Description</label>
            <input type="text" id="description" name="description" class="form-control" value="{{old('description')}}">
        </div>
        <div class="form-row">
            <label for="price">Item Price</label>
            <input type="number" min="1.00" step="0.01" id="price" name="price" class="form-control" value="{{old('price')}}">
        </div>
        <div class="form-row">
            <label for="stock">Stock</label>
            <input type="number" min="0" id="stock" name="stock" class="form-control" value="{{old('stock')}}">
        </div>
        <div class="form-row">
            <label for="status">Status</label>
            <select class="custom-select" name="status" id="status">
                <option value="" selected>Select...</option>
                <option value="available" {{old('status') == 'available' ? 'selected' : ''}} >Available</option>
                <option value="unavailable" {{old('status') == 'unavailable' ? 'selected' : ''}}>Unavailable</option>
            </select>
        </div>
        <div class="form-row">
            <label>{{ __('Product Images') }}</label>

            <div class="custom-file">
                <input type="file" name="images[]" accept="images/*" class="custom-file-input" multiple value="{{old('name')}}">
                <label class="custom-file-label">
                    Product Images...
                </label>
            </div>

        </div>
        <div class="form-row">
            <button class="btn btn-primary btn-lg mt-3" type="submit">Add Product</button>
        </div>
    </form>
@endsection

