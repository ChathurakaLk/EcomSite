<?php

namespace App\Http\Controllers;

use App\Events\cartVisitEvent;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Product $product){

        event(new cartVisitEvent("testMsg"));
        
        $cart = (Session::has('cart')) ? Session::get('cart') : [];
        if(isset($cart[$product->id])){
            $cart[$product->id]['qty'] +=1;
        }else{
            $cart [$product->id] = [
                'product' => $product,
                'qty' => 1,
            ];
        }
        Session::put('cart', $cart);
        return redirect()->route('Cart');
    }
    public function cart(){

        $cart = (Session::has('cart')) ? Session::get('cart') : [];
        return view('cart', compact('cart'));
    }
}
