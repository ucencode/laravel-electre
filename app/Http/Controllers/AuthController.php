<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function storeUser(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed']
        ], [], [
            'name' => 'Nama',
            'email' => 'Email',
            'password' => 'Kata Sandi'
        ]);

        // Store the user
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['email_verified_at'] = now();
        $user = User::create($validatedData);
        // Sign the user in
        Auth::login($user);
        // Redirect to dashboard
        return redirect()->route('dashboard')->with('success', 'Anda berhasil mendaftar! Selamat datang di aplikasi.');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // Validate the form data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ], [], [
            'email' => 'Email',
            'password' => 'Kata Sandi'
        ]);
        // Attempt to log the user in
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // Redirect to dashboard
            return redirect()->intended(route('dashboard'))->with('success', 'Anda berhasil masuk! Selamat datang.');
        }
        // Redirect to the login page
        return redirect()->route('login')->withErrors([
            'Email atau kata sandi salah.'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil keluar! Sampai jumpa lagi.');
    }
}
