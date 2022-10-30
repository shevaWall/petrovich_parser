<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        if (Auth::check())
            return redirect()->route('admin.');

        return view('admin.login.registrationForm');
    }

    public function registration(Request $request)
    {
        if (Auth::check())
            return redirect()->route('admin.');

        $validateFields = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (User::where('email', $validateFields['email'])->exists()){
            return redirect()
                ->route('admin.registration')
                ->withErrors([
                    'email' => 'Такой пользователь уже существует'
                ]);
        }

        $user = User::create($validateFields);

        if ($user) {
            Auth::login($user);
            return redirect()->route('admin.');
        }

        return redirect()->route('admin.registration')
            ->withErrors([
                'formError' => 'Произошла ошибка при сохранении пользователя'
            ]);
    }
}
