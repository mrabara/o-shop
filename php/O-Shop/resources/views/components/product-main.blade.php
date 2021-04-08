<div class="card mt-3 h-100">
    <div id="carousel{{$product->id}}" class="carousel slide carousel-fade">
        <div class="carousel-inner">
            @foreach ($product->images as $image)
                <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                    <img src="{{asset($image->path)}}" height="200" class="card-img-top w-100 d-block p-1"/>
                </div>
            @endforeach
        </div>
        <a  class="carousel-control-prev"
            href="#carousel{{$product->id}}"
            role="button"
            data-slide="prev"
        >
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a  class="carousel-control-next"
            href="#carousel{{$product->id}}"
            role="button"
            data-slide="next"
        >
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
    <div class="card-body d-flex flex-column">
        <h4 class="text-right">Php{{number_format($product->price, 2)}}</h4>
        <h5 class="card-title text-center"><strong>{{$product->name}}</strong></h5>
        <p class="card-text">{{$product->description}}</p>
        @if (isset($cart))

            <form   action="{{route('products.carts.destroy', ['product' => $product->id, 'cart' => $cart->id])}}"
                method="post"
                class="d-inline mt-auto"
            >
                @csrf
                @method('DELETE')
                <p class="card-text text-right">Item in cart: {{$product->pivot->quantity}} / ({{$product->stock}}) stocks left</p>
                <button type="submit" class="btn btn-danger btn-block">Remove</button>
            </form>
        @else
            <form   action="{{route('products.carts.store', ['product' => $product->id])}}"
                method="post"
                class="d-inline mt-auto"
                >
                @csrf
                <p class="card-text text-right">({{$product->stock}}) stocks left</p>
                <button type="submit" class="btn btn-success btn-block">Add to Cart</button>
            </form>
        @endif
    </div>
</div>

