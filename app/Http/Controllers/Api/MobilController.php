<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\User;
use App\ReservingTime;

class MobilController extends Controller
{

    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required'
        ]);

        if (!Auth::attempt($login)) {
            return response(['message' => 'Invalid login credentials.']);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        return response(['user' => Auth::user(), 'access_token' => $accessToken]);
    }

    public function userData(Request $request)
    {
        return auth()->user();
    }

    public function reservingTime()
    {
        return ReservingTime::all();
    }

    public function createOrder(Request $request)
    {
        if ($request->user()->role === 'student') {
            $order = new Order;
            $user = Auth::guard('api')->user();
            $order->user_id = $user->id;
            $order->save();

            return response(['message' => 'Order created successfully.']);
        } else {
            return response(['message' => 'You must be a student to make an order.']);
        }
    }

    public function cancelOrder(Request $request)
    {
        $user = Auth::guard('api')->user();
        $order = Order::where('user_id', $user->id)->whereDate('created_at', now()->today());
        $order->delete();
        return response(['message' => 'Order removed successfully.']);
    }
    
}
