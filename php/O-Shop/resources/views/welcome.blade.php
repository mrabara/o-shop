@extends('layouts.app')
@section('content')
    <h1>Welcome to O-Shop</h1>
        @empty ($products)
            <div class="alert alert-warning">
                The table is empty
            </div>
        @else
                <div class="row">

                    @foreach ($products as $product)
                        <div class="col-3">
                            @include('components.product-main')
                        </div>
                    @endforeach

                </div>
        @endif
@endsection

