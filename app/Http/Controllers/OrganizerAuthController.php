<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OrganizerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('organizers.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('organizer')->attempt($credentials)) {
            return redirect()->intended(route('organizer.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('organizer')->logout();
        return redirect()->route('organizer.login');
    }
}
