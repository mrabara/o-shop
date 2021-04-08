@extends('layouts.app')
@section('content')
    <h1 class="text-info text-center">Order Details</h1>
    <h4 class="text-right text-success"><strong>Grand Total: Php{{number_format($cart->total, 2)}}</strong></h4>


    <div class="mb-3 mt-5">
        <form   action="{{route('orders.store')}}"
            method="post"
            class="d-inline mt-auto"
            >
            @csrf
            <button type="submit" class="btn btn-success">Confirm Order</button>
        </form>
    </div>


    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-light text-center">
                <th>Image</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </thead>
            <tbody class="text-center">
                @foreach ($cart->products as $product)
                    <tr>
                        <td>
                            <img src="{{asset($product->images->first()->path)}}" width="50" class="rounded img-thumbnail"/>
                        </td>
                        <td>{{$product->name}}</td>
                        <td>Php{{number_format($product->price, 2)}}</td>
                        <td>{{$product->pivot->quantity}}</td>
                        <td>Php{{number_format($product->total, 2)}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
