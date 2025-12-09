<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

Class UserController extends Controller
{
    public function create()
    {
        return view('Auth.register');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
           'name' => ['required', 'string', 'max:255'],
           'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
           'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'active' => 1, // Set default active status to true
        ]);

        return redirect()->route('school-classes.index')->with('success', 'Registration successful');
    }
}


