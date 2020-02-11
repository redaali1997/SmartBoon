<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users() {
        $active_students = User::where('activated', true)->where('role', 'student')->get();
        $inactive_students = User::where('activated', false)->where('role', 'student')->get();
        $moderators = User::where('role', 'moderator')->get();
        return view('admin.users', [
            'actives' => $active_students,
            'inactives' => $inactive_students,
            'moderators' => $moderators
        ]);
    }
}
