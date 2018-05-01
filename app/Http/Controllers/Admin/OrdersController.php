<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\VueTables\EloquentVueTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function index () {
        return view('admin.orders.index');
    }

    public function json () {
        if(request()->ajax()) {
            $vueTables = new EloquentVueTables;
            $data = $vueTables->get(new Order, ['id', 'user_id', 'total', 'status'], ['orderLines']);
            return response()->json($data);
        }
        abort(401);
    }

    public function jsonDetail ($id) {
        $order = Order::with('orderLines.product')->findOrFail($id);
        return response()->json($order);
    }

    public function show ($orderId) {
        return view('admin.orders.detail', compact( 'orderId'));
    }
}
