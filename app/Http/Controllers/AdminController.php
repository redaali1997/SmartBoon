<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\ReservingTimeRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Imports\UsersImport;
use App\Order;
use App\ReservingTime;
use App\User;
use Illuminate\Http\Request;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    // Students
    public function students()
    {
        $search = request()->query('search');
        if ($search) {
            $active_students = User::where('boon_number', 'LIKE', "%{$search}%")->where('activated', true)->paginate(20);
            $inactive_students = User::where('boon_number', 'LIKE', "%{$search}%")->where('activated', false)->paginate(20);
        } else {
            $active_students = User::where('activated', true)->where('role', 'student')->paginate(20);
            $inactive_students = User::where('activated', false)->where('role', 'student')->paginate(20);
        }

        return view('admin.students.students', [
            'actives' => $active_students,
            'inactives' => $inactive_students,
        ]);
    }

    // Moderatos
    public function moderators()
    {
        $moderators = User::where('role', 'moderator')->get();
        return view('admin.moderators.moderators', compact('moderators'));
    }

    // Editing Users
    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        // dd($request->all());
        $activated = null;
        if ($request->has('activated')) {
            $activated = 1;
        } else {
            $activated = 0;
        }

        $user->update([
            'name' => $request->username,
            'email' => $request->email,
            'boon_number' => $request->boon_number,
            'room_number' => $request->room_number,
            'activated' => $activated
        ]);

        session()->flash('success', 'The user has been updated.');

        return redirect()->back();
    }

    public function delete(User $user)
    {
        if ($user->role === 'student') {
            $user->delete();
            session()->flash('success', 'The user has been deleted.');
            return redirect()->route('admin.students');
        } else {
            $user->delete();
            session()->flash('success', 'The user has been deleted.');
            return redirect()->route('admin.moderators');
        }
    }

    public function activate(User $user)
    {
        $user->update([
            'activated' => 1
        ]);
        return redirect()->back();
    }

    // Add User
    public function addUser()
    {
        return view('admin.add-user');
    }

    public function storeUser(AddUserRequest $request, Faker $faker)
    {
        $activated = null;
        if ($request->has('activated')) {
            $activated = 1;
        } else {
            $activated = 0;
        }

        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'room_number' => $request->room_number,
            'role' => $request->role,
            'password' => Hash::make(Str::random(10)),
            'activated' => $activated,
            'boon_number' => $faker->unique()->numberBetween(1000, 10000),
        ]);

        session()->flash('success', 'The user has been created.');

        if ($user->role === 'student') {
            return redirect()->route('admin.students');
        } else {
            return redirect()->route('admin.moderators');
        }
    }


    // Import and Export Users
    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new UsersImport, request()->file('file'));

        return back();
    }

    // Orders
    public function showOrders()
    {
        $date = request()->query('date');
        $search = request()->query('search');
        if ($date && !$search) {
            $orders = Order::whereDate('created_at', $date)->paginate(50);
        } elseif ($search && !$date) {
            $user = User::where('boon_number', $search)->first();
            if ($user) {
                $orders = Order::whereDate('created_at', now()->today()->format('Y-m-d'))->where('user_id', $user->id)->get();
            } else {
                $orders = null;
            }
        } elseif ($date && $search) {
            $user = User::where('boon_number', $search)->first();
            if ($user) {
                $orders = Order::whereDate('created_at', $date)->where('user_id', $user->id)->get();
            } else {
                $orders = null;
            }
        } else {
            $orders = Order::whereDate('created_at', now()->today()->format('Y-m-d'))->paginate(50);
        }
        $time = ReservingTime::first();
        return view('orders', [
            'orders' => $orders,
            'time' => $time
        ]);
    }

    public function updateTime(ReservingTime $reservingTime)
    {
        $reservingTime->update([
            'start' => request('start'),
            'end' => request('end')
        ]);
        return redirect()->back();
    }

    public function createTime(ReservingTimeRequest $request)
    {
        ReservingTime::create([
            'start' => $request->start,
            'end' => $request->end
        ]);
        return redirect()->back();
    }

    public function closeOrder(Order $order)
    {
        $order->update([
            'open' => 0
        ]);
        return redirect()->back();
    }
}
