<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;


class ManageOrderController extends Controller
{
    public function index(){

        $orders = Order::all();

        return view('components.order-admin', ['orders' => $orders]);
    }


    public function update(Order $order){

        if($order->status == 'pending'){
            return redirect()
                    ->route('orders.index')
                    ->withErrors("Order #{$order->id} has not been paid yet.");
        }

        if($order->status == 'paid'){
            $order->status = 'shipped';
            $order->save();

            return redirect()
                ->route('orders.index')
                ->withSuccess("Order #{$order->id} was shipped.");
        }


    }

}
