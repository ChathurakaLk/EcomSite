<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Product;
use App\trait\testTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    use testTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Session::forget('cart');
        $categories = category::orderBy('created_at', 'desc')->limit(3)->get();
        $products = Product::orderBy('created_at', 'desc')->limit(8)->get();
        return view('Shop.index', compact('categories', 'products'));
    }
    public function ChangeLang($lang)
    {
        Session::put(['lang' => $lang]);
        if($lang == 'si'){
            $language='Sinhala';
        }else{
            $language='English';
        }


        return redirect()->back()->with('success', 'Language chang to '.$language);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
