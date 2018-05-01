<?php

namespace App\Http\Controllers\Admin;

use App\Events\PromotionAdded;
use App\Events\PromotionDeleted;
use App\Http\Requests\PromotionRequest;
use App\Promotion;
use App\VueTables\EloquentVueTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromotionsController extends Controller
{
    public function index(){
        return view('admin.promotions.index');
    }

    public function json(){
        if(\request()->ajax()){
            $vueTables =  new EloquentVueTables();
            $data = $vueTables->get(new Promotion(), ['id','price','product_id'], ['product']);
            return response()->json($data);
        }

        abort(401);
    }

    public function create(){
        $btnText = 'Crear promocion';
        $route = route('admin.promotions_store');
        return view('admin.promotions.create', compact('btnText', 'route'));
    }

    public function store(PromotionRequest $promotionRequest){
        $promotion = Promotion::create($promotionRequest->input());
        broadcast(new PromotionAdded($promotion))->toOthers();
        return back()->with('message', ['success', __('Promocion dada de alta correctamnee')]);
    }

    public function delete(Promotion $promotion){
        if(\request()->ajax()){
            try{
                broadcast(new PromotionDeleted($promotion->product_id))->toOthers();
                $promotion->delete();
                return response()->json(['res' => 'success']);
            }catch (\Exception $exception){
                return response()->json(['res' => $exception->getMessage()], 400);
            }
        }
        abort(400);
    }
}
