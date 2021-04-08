<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{

    public $cartService;


    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart = $this->cartService->getFromCookie();


        if(! isset($cart) || $cart->products->isEmpty()){
            return redirect()
            ->back()
            ->withErrors('Your cart is empty.');
        }

        return view('orders.create')->with([
            'cart' => $cart,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       return DB::transaction(function() use($request){
                $user = $request->user();

                $order = $user->orders()->create([
                    'status' => 'pending',
                ]);

                $cart = $this->cartService->getFromCookie();

                $cartProductsQuantity = $cart
                                        ->products
                                        ->mapWithKeys(function ($product){
                                            $quantity = $product->pivot->quantity;
                                            if($product->stock < $quantity){
                                                throw ValidationException::withMessages([
                                                    'cart' => "Stock is less than the quantity you required for item {$product->name}",
                                                ]);
                                            }
                                            $product->decrement('stock', $quantity);
                                            $el[$product->id] = ['quantity' => $quantity];

                                            return $el;
                                        });

                $order->products()->attach($cartProductsQuantity->toArray());

                return redirect()->route('orders.payments.create', ['order' => $order->id]);
            }, 5);

    }


}
