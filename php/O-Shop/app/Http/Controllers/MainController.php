<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;


class MainController extends Controller
{
    public function index(){

        DB::connection()->enableQueryLog();

        $product = Product::all();

        return view('welcome')->with([
            'products' => $product,
        ]);
    }
}
