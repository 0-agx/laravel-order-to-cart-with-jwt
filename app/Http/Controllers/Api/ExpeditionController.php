<?php

namespace App\Http\Controllers\Api;

use App\Models\Expedition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpeditionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => Expedition::get()  
        ], 200);
    }
}
