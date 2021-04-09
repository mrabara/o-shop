@extends('layouts.app')
@section('content')
    <h1 class="text-info text-center">List of Orders</h1>

    @empty ($orders)
        <div class="alert alert-warning">
            The table is empty
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light text-center">
                    <th>Id</th>
                    <th>Customer Id</th>
                    <th>Status</th>
                    <th>Actions</th>
                </thead>
                <tbody class="text-center">
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->customer_id}}</td>
                            <td>{{$order->status}}</td>
                            <td>
                                <form class="d-inline" action="{{route('orders.update', ['order' => $order->id])}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success" {{$order->status == 'shipped' ? 'disabled' : ''}}>Update Order Status</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
