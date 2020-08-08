<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\User;
use App\ReservingTime;

class MobileController extends Controller
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
            if ($request->user()->activated === 1) {
                $order = new Order;
                $user = Auth::guard('api')->user();
                $order->user_id = $user->id;
                $order->save();

                return response(['message' => 'Order created successfully.']);
            } else if ($request->user()->activated === 0) {
                return response(['message' => 'Failed. User must be activated to be able to order.']);
            } else {
                response(['message' => 'Failed. Something went wrong. Try again later.']);
            }
        } else {
            return response(['message' => 'You must be a student to make an order.']);
        }
    }

    public function cancelOrder(Request $request)
    {
        $user = Auth::guard('api')->user();
        $order = Order::where('user_id', $user->id)
            ->whereDate('created_at', now()->today())->first();
        
        if ($order != null) {
            $order->delete();
            return response(['message' => 'Order removed successfully.']);
        } else {
            return response(['message' => "Failed. Order doesn't exist."]);
        }
    }

    public function orderDone(Request $request)
    {
        $user = Auth::guard('api')->user();
        $order = Order::where('user_id', $user->id)
            ->whereDate('created_at', now()->today()->subDay())->first();

        if ($order && !($order->open === 0)) {
            $order->update(['open' => 0]);
            return response(['message' => 'Order is Done.']);
        } else if ($order && $order->open === 0) {
            return response(['message' => 'Failed. Order already closed.']);
        } else {
            return response(['message' => 'Failed. Cannot find such order.']);
        }
    }
}
