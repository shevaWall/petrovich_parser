<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::check())
            return redirect()->route('admin.index');

        $formFields = $request->only([
            'email', 'password'
        ]);

        if (Auth::attempt($formFields)) {
            $request->session()->regenerate();

            return redirect()->intended('admin.index');
        }

        return back()->withErrors([
            'email' => 'The email do not match our records.'
        ]);
    }

    public function showLoginForm()
    {
        if (Auth::check())
            return redirect()->route('admin.index');

        return view('admin.login.loginForm');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }
}
