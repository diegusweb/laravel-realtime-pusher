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

    public function decrement()
    {
        if(! request()->ajax()){
            abort(401, 'access denid');
        }

        $cart = session('cart');
        $productId = request('productId');

        $cart->map(function ($product) use ($productId){
            if($product->id === $productId){
                $product->qty -= 1;
            }
        });

        session()->save();

        $filtered = $cart->reject(function ($product){
           return $product->qty < 1;
        })->flatten();  //alidar un array

        session()->put('cart', $filtered);
        broadcast(new UserCart($filtered));

    }

    public function remove($productId){
        if(! request()->ajax()){
            abort(401, 'access denid');
        }

        $cart = session('cart');

        $filtered = $cart->reject(function ($product) use ($productId){
            return (int) $product->id === (int) $productId;
        })->flatten();  //alidar un array

        session()->put('cart', $filtered);
        broadcast(new UserCart($filtered));

    }
}
