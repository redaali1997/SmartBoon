<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Students
    public function students()
    {
        $active_students = User::where('activated', true)->where('role', 'student')->get();
        $inactive_students = User::where('activated', false)->where('role', 'student')->get();
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

    public function update(User $user)
    {
        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'boon_number' => request('boon-number')
        ]);

        return redirect()->back();
    }

    public function delete(User $user)
    {
        if ($user->role === 'student') {
            $user->delete();
            return redirect()->route('admin.students');
        } else {
            $user->delete();
            return redirect()->route('admin.moderators');
        }
    }
}
