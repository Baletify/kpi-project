<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Authentication;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class AuthController extends Controller
{
    public function login()
    {
        flash()->info('Silahkan melakukan pergantian password anda di halaman login. Maksimal tanggal 25 April 2025');
        return view('login-page');
    }

    public function authMe(Request $request)
    {

        // Validate the request data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials) && Auth::user()->is_active == 1) {
            // Authentication passed, regenerate session
            $request->session()->regenerate();
            flash()->info('Silahkan melakukan pergantian password anda di halaman login. Maksimal tanggal 25 April 2025');
            flash()->success('Selamat Datang Di Aplikasi KPI!');
            // Redirect to the intended page or dashboard

            return redirect()->intended('dashboard');
        }

        flash()->error('The provided credentials do not match our records.');

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        flash()->success('Successfully logged out');
        return redirect('/login');
    }
}
