@extends('layouts.app')
@section('content')
    <a class="btn btn-success" href="{{route('products.index')}}">Product List</a>
    <div class="row justify-content-center">
        <div class="col-4">
            @include('components.product-admin')
        </div>
    </div>
@endsection

