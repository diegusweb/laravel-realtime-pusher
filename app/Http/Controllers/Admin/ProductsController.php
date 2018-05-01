<?php

namespace App\Http\Controllers\Admin;

use App\Events\ProductAdded;
use App\Events\ProductDeleted;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\VueTables\EloquentVueTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function index () {
        return view('admin.products.index');
    }

    public function json () {
        if(request()->ajax()) {
            $vueTables = new EloquentVueTables;
            $data = $vueTables->get(new Product, ['id', 'name', 'price', 'image']);
            return response()->json($data);
        }
        abort(401);
    }

    public function create () {
        $btnText = 'Crear producto';
        $route = route('admin.products_store');
        return view('admin.products.create', compact('btnText', 'route'));
    }

    public function store (ProductRequest $productRequest) {
        $productRequest->file('image')->store('products');
        $image = $productRequest->file('image')->hashName();
        $productRequest->merge(['image' => $image]);
        $product = Product::create($productRequest->input());
        broadcast(new ProductAdded($product))->toOthers();
        return back()->with('message', ['success', __('Producto dado de alta correctamente')]);
    }

    public function delete (Product $product) {
        if (\request()->ajax()) {
            try {
                $promotion = $product->promotion;
                if ($promotion) {
                    broadcast(new PromotionDeleted($product->id))->toOthers();
                }
                $product->promotion()->delete();
                \Storage::delete('products/' . $product->image);
                broadcast(new ProductDeleted($product))->toOthers();
                $product->delete();
                return response()->json(['res' => 'success']);
            } catch (\Exception $exception) {
                return response()->json(['res' => $exception->getMessage()], 400);
            }
        }
        abort(401);
    }
}
