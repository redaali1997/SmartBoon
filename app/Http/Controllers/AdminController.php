<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Students
    public function students()
    {
        $active_students = User::where('activated', true)->where('role', 'student')->paginate(20);
        $inactive_students = User::where('activated', false)->where('role', 'student')->paginate(20);
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
        $user->update([
            'name' => $request->username,
            'email' => $request->email,
            'boon_number' => $request->boon_number,
            'room_number' => $request->room_number
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

    // Add User
    public function addUser()
    {
        return view('admin.add-user');
    }

    public function storeUser(AddUserRequest $request, Faker $faker)
    {
        // dd($request->all());
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
            'code' => Str::random(6)
        ]);

        session()->flash('success', 'The user has been created.');

        if ($user->role === 'student') {
            return redirect()->route('admin.students');
        } else {
            return redirect()->route('admin.moderators');
        }
    }
}
