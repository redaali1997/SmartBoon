<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\ReservingTime;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reserved = null;
        $available = null;
        $activated = null;
        $reservingTime = ReservingTime::first();
        $order = auth()->user()->orders()->whereDate('created_at', now()->today()->format('Y-m-d'))->first();

        // $start = (int) $reservingTime->start >= 12 ? (int) $reservingTime->start - 12 : (int) $reservingTime->start;
        // $end = (int) $reservingTime->end >= 12 ? (int) $reservingTime->end - 12 : (int) $reservingTime->end;
        if (now()->addHours(2)->format('H:i:s') >= $reservingTime->start && now()->addHours(2)->format('H:i:s') < $reservingTime->end) {
            $available = true;
        } else {
            $available = false;
        }

        if (auth()->user()->activated) {
            $activated = 1;
        } else {
            $activated = 0;
        }

        if ($order) {
            // return view('student.create');
            $reserved = 1;
        } else {
            // return view('student.cancel');
            $reserved = 0;
        }

        if ($order->open) {
            $notDone = 1;
        } else {
            $notDone = 0;
        }

        return view('student.student', [
            'order' => $order,
            'reserved' => $reserved,
            'available' => $available,
            'reservingTime' => $reservingTime,
            'activated' => $activated,
            'notDone' => $notDone
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;
        $order->user_id = auth()->user()->id;
        $order->save();

        return redirect('/student')->with('success', 'Reservation RECORDED');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $user = User::find($id);
        // return view('student.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back();
    }
}
