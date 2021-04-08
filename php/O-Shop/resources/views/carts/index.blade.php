@extends('layouts.app')
@section('content')
    <h1>Your Cart</h1>
        @if (! isset($cart) || $cart->products->isEmpty())
            <a class="btn btn-success mb-4" href="{{route('main')}}">Product List</a>
            <div class="alert alert-warning">
                Your cart is empty
            </div>
        @else
                <div class="row d-flex align-items-baseline">
                    <div class="col-6"><a href="{{route('orders.create')}}" class="btn btn-success mt-5 mb-3">View Order Details</a></div>
                    <div class="col-6"><h4 class="text-right text-success">Your cart total: <strong>Php{{number_format($cart->total, 2)}}</strong></h4></div>
                </div>
                <div class="row">
                    @foreach ($cart->products as $product)
                        <div class="col-3">
                            @include('components.product-main')
                        </div>
                    @endforeach
                </div>
        @endif
@endsection

