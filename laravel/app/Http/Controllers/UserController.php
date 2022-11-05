<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile(User $User)
    {
        if(!isset($User->id)){
            return view('admin.user.profile');
        }else{
            return view('admin.user.profile')
                ->with('User', $User);
        }
    }

    public function users()
    {
        return view('admin.user.listOfUsers')
            ->with('users', User::all())
            ;
    }

    public function showCreateForm(){
        return view('admin.user.createForm');
    }

    public function createUser(Request $request){
        $validateFields = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (User::where('email', $validateFields['email'])->exists()){
            return redirect()
                ->route('admin.users.create')
                ->withErrors([
                    'email' => 'Такой адрес электронной почты уже зарегистрирован'
                ]);
        }

        $user = User::create($validateFields);

        return redirect()->route('admin.users');
    }

    public function delete(User $User){
        $User->delete();
        return redirect()->route('admin.users');
    }

    public function showEditForm(User $User){
        return view('admin.user.editForm')
            ->with('user', $User);
    }

    public function editUser(Request $request, User $User){
        $validateFields = $request->validate([
           'name' => 'required',
           'email' => 'required|email',
        ]);

        $User->update($validateFields);

        return redirect()->route('admin.users.profile', $User->id);
    }
}
