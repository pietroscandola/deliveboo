<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function sendOrder(Request $request)
    {
        $data = $request->all();

        $order = Order::create($data);
        $order->products()->attach($request->products_ids);

        return response()->json($data);
    }
}
