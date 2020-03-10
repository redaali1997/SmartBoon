<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;

class MobilController extends Controller {
    
    public function login(Request $request) {
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required'
        ]);

        if(!Auth::attempt($login)) {
            return response(['message' => 'Invalid login credentials.']);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        return response(['user' => Auth::user(), 'access_token' => $accessToken]);
    }

    public function order(Request $request) {
        
        $order = new Order;
        $user = Auth::guard('api')->user();
        $order->user_id = $user->id();
        $order->open = $request->open;
        $order ->save();
        $accessToken = $order->createToken('authToken')->accessToken;
        
        return response(['order' => Auth::order(), 'access_token' => $accessToken]);
    }
}
