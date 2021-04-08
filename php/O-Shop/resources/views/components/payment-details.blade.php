<div class="col-2"><img src="{{asset($product->images->first()->path)}}" width="75" height="75" class="rounded img-thumbnail"/></div>
<div class="col-3">{{$product->name}}</div>
<div class="col-3">Php{{number_format($product->price, 2)}}</div>
<div class="col-2">{{$product->pivot->quantity}}</div>
<div class="col-2">Php{{number_format($product->total, 2)}}</div>



