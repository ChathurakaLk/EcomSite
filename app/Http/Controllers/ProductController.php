<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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

        $path=null;
        if($request->file('image')){
            $path = $request->file('image')->store('products');
        }
        $product -> image       = $path;
        $product -> save();
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($product)
    {
        $productId = Crypt::decrypt($product);
        $product = Product::find($productId );
            if($product->seller_id == Auth::id() || Auth::user()->hasRole('admin')){
                return view('product.show', compact('product'));
            }else{
                abort(403);
            }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($product)
    {
         $productId = Crypt::decrypt($product);
         $product = Product::find($productId );
            if($product->seller_id == Auth::id() || Auth::user()->hasRole('admin')){
                return view('product.edit', compact('product'));
            }else{
                abort(403);
            }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $product)
    {
         $productId = Crypt::decrypt($product);
         $product = Product::find($productId );
            if($product->seller_id == Auth::id() || Auth::user()->hasRole('admin')){
                $product->update($request->validated());
                return redirect()->route('product.index')->with('success', 'Product updated successfully');
            }else{
                abort(403);
            }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product)
    {
            $productId = Crypt::decrypt($product);
            $product = Product::find($productId );
            if($product->seller_id == Auth::id() || Auth::user()->hasRole('admin')){
                $product->delete();
                if(isset($product->image)){
                    Storage::delete($product->image);
                }
                return redirect()->route('product.index')->with('success', 'Product deleted successfully');
            }else{
                abort(403);
            }
    }

    //export products
    public function export()
    {
        return Excel::download(new ProductExport, 'Products.xlsx');
    }
}
