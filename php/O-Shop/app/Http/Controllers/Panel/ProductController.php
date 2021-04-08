<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;
use App\Models\PanelProduct;
use App\Scopes\AvailableProduct;
use Session;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function index(){

        $products = PanelProduct::without('images')->get();

        return view('products.index', ['products' => $products] );
    }

    public function create(){

        return view('products.create');
    }

    public function store(ProductRequest $request){


        $product = PanelProduct::create($request->validated());

        foreach($request->images as $image){
            $product->images()->create([
                'path' => 'images/' . $image->store('products', 'images'),
            ]);
        }

        return redirect()
        ->route('products.show', ['product' => $product])
        ->withSuccess('Item added.');

    }

    public function show(PanelProduct $product){

        return view('products.show', ['product' => $product] );
    }

    public function edit(PanelProduct $product){

        // $product = Product::findOrFail($product);
        return view('products.edit', ['product' => $product]);
    }

    public function update(ProductRequest $request, PanelProduct $product){

    //    $product = Product::findOrFail($product);

        $product->update($request->validated());

        if ($request->hasFile('images')) {
            foreach ($product->images as $image) {
                $path = storage_path("app/public/{$image->path}");

                File::delete($path);

                $image->delete();
            }

            foreach ($request->images as $image) {
                $product->images()->create([
                    'path' => 'images/' . $image->store('products', 'images'),
                ]);
            }
        }

       return   redirect()
                ->route('products.show', ['product' => $product])
                ->withSuccess('Item edited.');;
    }

    public function destroy(PanelProduct $product){

        // $product = Product::findOrFail($product);

        $product->delete();

        return  redirect()
                ->route('products.index')
                ->withSuccess('Item deleted.');
    }

}
