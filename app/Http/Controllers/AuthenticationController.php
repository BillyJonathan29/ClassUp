<?php

namespace App\Http\Controllers;

// use Illuminate\Http\RedirectResponse;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid atau salah',
            'password.required' => 'Password wajib diisi'
        ]);

        // dd($credentials);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }


        return back()->withErrors([
            'email' => 'Email atau password salah'
        ])->onlyInput('email');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil logout');
    }


    public function profile()
    {
        $user = auth()->user();
        return view('setting.profile', [
            'title'  => 'setting',
            'user' => $user,
            'breadcrumbs' => [
                [
                    'title' => 'profile',
                    'link' => route('setting.profile')
                ]
            ]
        ]);
    }
}
