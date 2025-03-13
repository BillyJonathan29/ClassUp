<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class AuthenticationController extends Controller
{
    public function index()
    {
        return view('authentication.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid atau salah',
            'password.required' => 'Password wajib diisi'
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }


        return back()->withErrors([
            'email' => 'Email atau password salah'
        ])->onlyInput('email');
    }


    public function user()
    {
        return view('authentication.user', [
            'title' => 'User',
            'breadcrumbs' => [
                [
                    'title' => 'User',
                    'link' => route('user')
                ]
            ]
        ]);
    }
}
