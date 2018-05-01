<?php

namespace App\Http\Controllers;

use App\Order;
use App\VueTables\EloquentVueTables;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index () {
        return view('orders.index');
    }

    public function json () {
        if(request()->ajax()) {
            $vueTables = new EloquentVueTables;
            $data = $vueTables->get(new Order, ['id', 'user_id', 'total', 'status'], ['orderLines'], true);
            return response()->json($data);
        }
        return abort(401);
    }

    public function jsonDetail ($id) {
        $order = Order::with('orderLines.product')->findOrFail($id);
        return response()->json($order);
    }

    public function show ($orderId) {
        return view('orders.detail', compact( 'orderId'));
    }
}
