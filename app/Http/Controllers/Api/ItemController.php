<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function all(){
        return response()->json([
            'success' => true,
            'data' => Item::with(['item_category', 'store'])->get()  
        ], 200);
    }

    public function by_category(Request $request){
        $validator = Validator::make($request->all(), [
            'item_category_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $items = Item::with('item_category')->where([
            'item_category_id' => $request->item_category_id,
        ])->first();

        return response()->json([
            'success' => true,
            'data' => $items  
        ], 200);
    }
}
