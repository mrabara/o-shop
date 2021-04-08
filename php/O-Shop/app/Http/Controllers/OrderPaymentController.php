<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function create(Order $order)
    {
        $cart = $this->cartService->getFromCookie();

        return view('payments.create', ['order' => $order, 'cart' => $cart]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {

        return DB::transaction(function() use($order){
            $this->cartService->getFromCookie()->products()->detach();

            $order->payment()->create([
                'amount' => $order->total,
                'paid_at' => now(),
            ]);

            $order->status = 'paid';
            $order->save();

            return redirect()
                    ->route('main')
                    ->withSuccess("Thank you! We have received your payment.");
        });
    }


}
