<?php

namespace App\Http\Controllers\Admin;

use App\Promotion;
use App\VueTables\EloquentVueTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromotionsController extends Controller
{
    public function index(){
        return view('admin.promotions');
    }

    public function json(){
        if(\request()->ajax()){
            $vueTables =  new EloquentVueTables();
            $data = $vueTables->get(new Promotion(), ['id','price','product_id'], ['product']);
            return response()->json($data);
        }

        abort(401);
    }
}
