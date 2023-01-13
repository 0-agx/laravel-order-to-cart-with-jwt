<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if(!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials!'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'access_token' => $token   
        ], 200);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'address' => 'required',
            'user_group_id' => 'required|numeric|min:1|max:2',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'user_group_id' => $request->user_group_id,
            'email_verified_at' => now(),
            'password' => bcrypt($request->password)
        ]);

        if($user) {
            return response()->json([
                'success' => true,
                'user' => $user,  
            ], 201);
        }

        return response()->json([
            'success' => false,
        ], 409);
    }

    public function logout() {
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());
        auth()->guard('api')->logout();

        if($removeToken) {
            return response()->json([
                'success' => true,
                'message' => 'User successfully signed out',  
            ], 200);
        }
    }
    
    public function refresh() {
        $token = auth()->guard('api')->refresh();

        if($token) {
            return response()->json([
                'success' => true,
                'access_token' => $token,  
            ], 200);
        };
    }
}
