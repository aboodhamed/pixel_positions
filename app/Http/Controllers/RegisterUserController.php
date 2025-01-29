<?php

 namespace App\Http\Controllers;

 use App\Models\User;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Validation\Rules\File;
 use Illuminate\Validation\Rules\Password;

class RegisterUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $userAttributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);

        $employerAttributes = $request->validate([
            'employer' => ['required'],
            'logo' => ['required', 'file', 'mimes:jpg,png,gif', 'max:2048'],
        ]);

        $user = User::create($userAttributes);

        $logoPath = $request->logo->store('logos');

        $user->employer()->create([
            'employer' => $employerAttributes['employer'],
            'logo' => $logoPath,
        ]);

        Auth::login($user);

        return redirect('/login');
    }
}