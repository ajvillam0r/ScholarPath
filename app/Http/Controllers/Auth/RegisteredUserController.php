<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('auth.register'); // Assuming your registration form is located at resources/views/auth/register.blade.php
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate input fields
        $request->validate([
            'staff_id' => 'required|string|max:8|unique:users,staff_id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
        ]);

        // Create the user
        $user = User::create([
            'staff_id' => $request->input('staff_id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), // Hash the password
        ]);

        // Fire the Registered event
        event(new Registered($user));

        // Log in the user after registration (optional)
        Auth::login($user);

        // Redirect to the registration page with a success message
        return redirect()->route('register')->with('success', 'Registration successful! Please login.');
    }
}
