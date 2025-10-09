<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Redirect based on user role
            if ($user->hasRole('admin') || $user->hasRole('admin_bkbn')) {
                return redirect()->intended('/admin/dashboard')->with('success', 'Selamat datang, Admin!');
            }
            
            return redirect()->intended('/dashboard')->with('success', 'Login berhasil!');
        }

        throw ValidationException::withMessages([
            'email' => ['Email atau password tidak valid.'],
        ]);
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Anda telah logout.');
    }

    /**
     * Show dashboard based on user role
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            return view('admin.dashboard', compact('user'));
        }
        
        return view('dashboard', compact('user'));
    }
}
