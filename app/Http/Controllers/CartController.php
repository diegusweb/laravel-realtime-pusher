<?php

namespace App\Http\Controllers;

use App\Events\UserCart;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        if(! request()->ajax()){
            abort(401, 'access denid');
        }
        return response()->json(session('cart'));
    }

    public function add(){
        if(! request()->ajax()){
            abort(401, 'access denid');
        }

        $cart = session('cart');

        $productId = request('productId');

        if(!$cart->contains('id', $productId)){
            $product = Product::find($productId);
            $product->setAttribute('qty',1);
            $cart->push($product);
        }else{
            $cart->map(function ($product) use ($productId) {
               if($product->id === $productId){
                    $product->qty += 1;
               }
            });
        }

        session()->save();
        broadcast(new UserCart($cart));
    }
}
