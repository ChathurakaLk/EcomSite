<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            $products = Product::paginate(10);
        }else{
            $products = Product::where('seller_id', '=', Auth::id())->paginate(10); //show only seller to his own iteams
        }
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $categories =Category::all()->pluck('name', 'id');
        return view('product.product-create', compact('product', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();

        $product -> seller_id   = Auth::id();
        $product -> category_id = $request-> category_id;
        $product -> name        = $request-> name;
        $product -> description = $request-> description;
        $product -> price       = $request-> price;
        $product -> qty         = $request-> qty;
        $product -> image       = $request-> image;
        $product -> save();
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        if($product->seller_id === Auth::id()){
            return view('product.show', compact('product'));
        }else{
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if($product->seller_id === Auth::id()){
            return view('product.edit', compact('product'));
        }else{
            abort(403);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if($product->seller_id === Auth::id()){
            $product->update($request->validated());
            return redirect()->route('product.index')->with('success', 'Product updated successfully');
        }else{
            abort(403);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if($product->seller_id === Auth::id()){
            $product->delete();
            return redirect()->route('product.index')->with('success', 'Product deleted successfully');
        }else{
            abort(403);
        }
    }
}
