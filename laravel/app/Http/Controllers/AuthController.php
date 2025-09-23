<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'E-mail megadása kötelező.',
            'email.email' => 'Érvényes e-mail címet adjon meg.',
            'password.required' => 'Jelszó megadása kötelező.',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('status', 'Sikeres bejelentkezés.');
        }

        // Legacy: accept plaintext passwords and rehash on first login
        $user = User::where('email', $request->input('email'))->first();
        if ($user && ($user->password === $request->input('password'))) {
            // Rehash to bcrypt
            $user->password = Hash::make($request->input('password'));
            $user->save();

            Auth::login($user, $remember);
            $request->session()->regenerate();
            return redirect()->intended('/')->with('status', 'Sikeres bejelentkezés.');
        }

        return back()->withErrors([
            'email' => 'Hibás e-mail vagy jelszó.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('user', 'email')],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'name.required' => 'Név megadása kötelező.',
            'email.required' => 'E-mail megadása kötelező.',
            'email.email' => 'Érvényes e-mail címet adjon meg.',
            'email.unique' => 'Ezzel az e-mail címmel már regisztráltak.',
            'password.required' => 'Jelszó megadása kötelező.',
            'password.confirmed' => 'A jelszók nem egyeznek.',
            'password.min' => 'A jelszó legalább :min karakter legyen.',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        return redirect('/')->with('status', 'Sikeres regisztráció.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('status', 'Sikeres kijelentkezés.');
    }
}


