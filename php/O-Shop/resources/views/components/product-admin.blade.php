{{-- <h1>{{$product->name}}</h1>
<img src="{{asset($product->images->first())}}" width="150" height="150"/>
<p>{{$product->description}}</p>
<p>{{$product->price}}</p>
<p>{{$product->stock}}</p>
<p>{{$product->status}}</p> --}}
<div class="card">
    <div id="carousel{{ $product->id }}" class="carousel slide carousel-fade">
        <div class="carousel-inner">
            @foreach ($product->images as $image)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img class="d-block w-100 card-img-top" src="{{ asset($image->path) }}" height="500">
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carousel{{ $product->id }}" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>

        <a class="carousel-control-next" href="#carousel{{ $product->id }}" role="button" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
    <div class="card-body">
        <h4 class="text-right"><strong>Php{{number_format($product->price, 2) }}</strong></h4>
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text">{{ $product->description }}</p>
        <p class="card-text"><strong>{{ $product->stock }} left</strong></p>

        @if (isset($cart))
            <p class="card-text">
                {{ $product->pivot->quantity }} in your cart
                <strong>(Php{{ number_format($product->total, 2) }})</strong>
            </p>

            <form
                class="d-inline"
                method="POST"
                action="{{ route('products.carts.destroy', ['product' => $product->id, 'cart' => $cart->id]) }}"
            >
                @csrf
                @method('DELETE')
                <button class="btn btn-warning" type="submit">Remove From Cart</button>
            </form>
        @else
            <form
                class="d-inline"
                method="POST"
                action="{{ route('products.carts.store', ['product' => $product->id]) }}"
            >
                @csrf
                <button class="btn btn-success" type="submit">Add to Cart</button>
            </form>
        @endif
    </div>
</div>
