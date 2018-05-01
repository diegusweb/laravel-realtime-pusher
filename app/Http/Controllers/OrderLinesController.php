<?php

namespace App\Http\Controllers;

use App\OrderLine;
use DB;
use Illuminate\Http\Request;

class OrderLinesController extends Controller
{
    public function updateStatus ($id) {
        $success = true;
        $order = null;
        try {
            DB::beginTransaction();
            $orderLine = OrderLine::findOrFail($id);
            $status = request('status');
            $orderLine->status = $status;
            $orderLine->save();

            $allOrderLines = OrderLine::where('order_id', request('orderId'))
                ->where('status', '!=', Order::FINISHED)->get();

            $order = Order::with('orderLines.product')->find(\request('orderId'));
            if ($allOrderLines->count() === 0) {
                $order->status = Order::FINISHED;
            } else {
                $order->status = Order::PROCESSING;
            }
            $order->save();

        } catch (\Exception $exception) {
            DB::rollBack();
            $success = $exception->getMessage();
        }

        if($success === true) {
            DB::commit();
            broadcast(new ProcessingOrder($order));
            return response()->json(['res' => 'success'], 200);
        }
        return response()->json(['res' => $success], 400);
    }
}
