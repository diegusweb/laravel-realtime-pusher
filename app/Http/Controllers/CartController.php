<?php

namespace App\Http\Controllers;

use App\Events\NewOrder;
use App\Events\UserCart;
use App\Order;
use App\OrderLine;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use PhpParser\ErrorHandler\Collecting;

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

    public function process()
    {
        if ( ! request()->ajax()) {
            abort(401, 'Acceso denegado');
        }
        $cart = session('cart');
        $success = true;
        $order = null;

        try {
            \DB::beginTransaction();
            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => $cart->sum(function ($product) {
                    return $product->price * $product->qty;
                })
            ]);

            $orderLines = [];
            $cart->map(function ($product) use (&$orderLines, $order) {
                $orderLines[] = [
                    "order_id" => $order->id,
                    "product_id" => $product->id,
                    "product_price" => $product->price,
                    "qty" => $product->qty
                ];
            });
            OrderLine::insert($orderLines);

        } catch (\Exception $exception) {
            \DB::rollBack();
            $success = $exception->getMessage();
        }

        if ($success === true) {
            \DB::commit();
            session()->put('cart', new Collection);
            broadcast(new UserCart(session('cart')));
            broadcast(new NewOrder($order))->toOthers();
        }
        return response()->json($success);
    }
}
