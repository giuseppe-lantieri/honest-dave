<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    //

    public function register()
    {
        return view("register");
    }

    public function store()
    {
        $validated = request()->validate(
            [
                'name' => 'required|min:3|max:20',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed'
            ]
        );

        User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]
        );

        return redirect()->route("home")->with('success', 'user created');
    }

    public function login()
    {
        return view("login");
    }

    public function autheticate()
    {
        $validated = request()->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        if (auth()->attempt($validated)) {
            request()->session()->regenerate();

            return redirect()->route('home');
        }
        return redirect()->route("register");
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route("login");
    }
}