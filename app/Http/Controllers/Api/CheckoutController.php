<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Expedition;
use App\Models\DetailOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|numeric',
            'expedition_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $expedition = Expedition::find($request->expedition_id);

        $cart = Cart::with('details.item.store')->with('user')->where([
            'id' => $request->cart_id
        ])->first();

        $order = Order::create([
            'cart_id' => $cart->id,
            'customer_name' => $cart->user->name,
            'shipping_address' => $cart->user->address,
            'expedition' => $expedition->description,
            'order_amount' => $cart->total,
            'shipping_cost' => $expedition->price,
            'net_amount' => $cart->total + $expedition->price,
            'status' => 'unpaid',
        ]);

        foreach($cart->details as $detail){
            $detailOrder = DetailOrder::create([
                'order_id' => $order->id,
                'detail_cart_id' => $detail->id,
                'item_description' => $detail->item->description,
                'unit_price' => $detail->unit_price,
                'order_qty' => $detail->qty,
                'amount' => $detail->net_amount,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully place order!'
        ], 200);
    }
}
