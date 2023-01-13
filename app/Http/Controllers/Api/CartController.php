<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Item;
use App\Models\DetailCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required|numeric',
            'qty' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $cart = Cart::where([
            'user_id' => auth()->guard('api')->id(),
            'status' => 0
        ])->first();

        if(!$cart){
            $cart = Cart::create([
                'user_id' => auth()->guard('api')->id(),
                'total' => 0,
                'status' => 0
            ]);
        }

        $item = Item::where('id', $request->item_id)->first();
        $netAmount = $request->qty * $item->unit_price;

        $cartDetail = DetailCart::where([
            'cart_id' => $cart->id,
            'item_id' => $request->item_id
        ])->first();

        if($cartDetail){
            $cartDetail = DetailCart::where([
                'cart_id' => $cart->id,
                'item_id' => $item->id,
            ])->update([
                'qty' => $cartDetail->qty + $request->qty,
                'net_amount' => $cartDetail->net_amount + $netAmount
            ]);
        }
        else{
            $cartDetail = DetailCart::create([
                'cart_id' => $cart->id,
                'item_id' => $item->id,
                'qty' => $request->qty,
                'unit_price' => $item->unit_price,
                'net_amount' => $netAmount
            ]);
        }

        $updateTotal = Cart::where([
            'user_id' => auth()->guard('api')->id(),
            'status' => 0
        ])->update([
            'total' => $cart->total + $netAmount
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Successfully add item to cart'
        ], 200);
    }

    public function show()
    {
        $cart = Cart::with('detail_cart')->where([
            'user_id' => auth()->guard('api')->id(),
            'status' => 0
        ])->first();

        return response()->json([
            'success' => true,
            'data' => $cart
        ], 200);
    }
}
