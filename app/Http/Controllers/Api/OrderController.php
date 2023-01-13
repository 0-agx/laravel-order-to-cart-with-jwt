<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function all(){
        return response()->json([
            'success' => true,
            'data' => Order::with('details')->get()  
        ], 200);
    }

    public function by_id(Request $request){
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $orders = Order::with('details')->where([
            'id' => $request->order_id,
        ])->get();

        return response()->json([
            'success' => true,
            'data' => $orders  
        ], 200);
    }
}
