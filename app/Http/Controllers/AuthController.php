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
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if the user is active
            if ($user->is_active != 1) {
                Auth::logout();
                flash()->error('Your account is inactive. Please contact the administrator.');
                return back()->withErrors(['email' => 'Your account is inactive.'])->onlyInput('email');
            }

            // Check if the user needs to reset their password
            // if (!$user->last_password_reset_at || $user->last_password_reset_at->lt(now()->subMonths(3))) {
            //     Auth::logout(); // Log the user out to prevent access
            //     flash()->info('You are required to reset your password.');
            //     return redirect()->route('reset-password');
            // }
            // Authentication passed, regenerate session
            $request->session()->regenerate();
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
