<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Show the login form for staff.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Ensure this view exists
    }

    /**
     * Handle the login request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the staff_id and password
        $request->validate([
            'staff_id' => 'required|numeric',  // Ensure staff_id is numeric
            'password' => 'required|min:8',
        ]);

        // Attempt to log the user in using the staff_id and password
        if (Auth::attempt(['staff_id' => $request->staff_id, 'password' => $request->password])) {
            // Redirect the user to the intended page or dashboard
            return redirect()->intended($this->redirectTo);
        }

        // If authentication fails, redirect back with an error
        throw ValidationException::withMessages([
            'staff_id' => ['These credentials do not match our records.'],
        ]);
    }

    /**
     * Handle the logout request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user

        // Invalidate the session and regenerate the session ID to protect against session fixation attacks
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect the user to the login page
        return redirect()->route('staff.login');
    }
}
