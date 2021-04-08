@extends('layouts.app')
@section('content')
    <h1 class="text-info text-center">Payment Details</h1>
    <div class="row d-flex align-items-center">
        <div class="col-6">
            <form   action="{{route('orders.payments.store', ['order' => $order->id])}}"
                method="post"
                class="d-inline mt-auto"
                >
                @csrf
                <button type="submit" class="btn btn-success mt-3">Cornfirm Payment</button>
            </form>
        </div>
        <div class="col-6">
            <h4 class="text-right text-success"><strong>Grand Total: Php{{number_format($order->total, 2)}}</strong></h4>
        </div>
    </div>
    <div class="card mb-3 mt-5 d-flex justify-content-center">
        <div class="card-body">
            <div class="row text-center">
                <div class="col-2 font-weight-bold">Image</div>
                <div class="col-3 font-weight-bold">Item Name</div>
                <div class="col-3 font-weight-bold">Item Price</div>
                <div class="col-2 font-weight-bold">Quantity</div>
                <div class="col-2 font-weight-bold">Total</div>
            </div>
            @foreach ($cart->products as $product)
                <div class="row text-center mb-2">
                    @include('components.payment-details')
                </div>
            @endforeach
        </div>
    </div>
@endsection
