<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException as ValidationValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy()
    {
        Auth::logout();
        
        Request()->session()->invalidate();
        Request()->session()->regenerateToken();

        return redirect('/');
    }
}
