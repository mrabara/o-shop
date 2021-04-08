@extends('layouts.app')
@section('content')
    <h1 class="text-info text-center">List of Products</h1>

    <a class="btn btn-link btn-success text-decoration-none text-light mb-5" href="{{route('products.create')}}">Add Product</a>

    @empty ($products)
        <div class="alert alert-warning">
            The table is empty
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light text-center">
                    <th>Id</th>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </thead>
                <tbody class="text-center">
                    @foreach ($products as $product)
                        <tr>

                            <td>{{$product->id}}</td>
                            <td class="w-25">{{$product->name}}</td>
                            <td class="w-25">{{$product->description}}</td>
                            <td>Php{{number_format($product->price, 2)}}</td>
                            <td>{{$product->stock}}</td>
                            <td>{{$product->status}}</td>
                            <td>
                                <a class="btn btn-link" href="{{route('products.show', ['product' => $product->id])}}">View Details</a>
                                <a class="btn btn-link" href="{{route('products.edit', ['product' => $product->id])}}"><i class="fas fa-pencil-alt text-success"></i></a>
                                <form class="d-inline" action="{{route('products.destroy', ['product' => $product->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn"><i class="fas fa-trash-alt text-danger"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
