<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        return view('admin.userProfile');
    }

    public function users()
    {
        return view('admin.user.userList')
            ->with('users', User::all())
            ;
    }
}
