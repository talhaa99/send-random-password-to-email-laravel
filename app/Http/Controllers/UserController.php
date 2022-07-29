<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\PasswordToUserEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    function create()
    {
        return view('create-user');
    }

    function store(Request $request)
    {
        $request->validate(array(
            'name' => ['required'],
            'email' => ['email', 'unique:users,email'],
        ));

        $password = Str::random(16);

        $request['password'] = Hash::make($password);
        $user = User::create($request->all());

        $user->notify(new PasswordToUserEmail($password));

        return redirect()->back();
    }
}
